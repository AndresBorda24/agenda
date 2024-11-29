<?php

declare (strict_types=1);

namespace App\GatewaysResponseHandlers;

use App\Config;
use App\Contracts\GatewayResponseHandler;
use App\Contracts\PaymentGatewayInterface;
use App\DataObjects\File;
use App\DataObjects\GatewayReturnData;
use App\DataObjects\OrderInfo;
use App\Enums\MpStatus;
use App\Models\Files;
use App\Models\Order;
use App\Models\Pago;
use App\Models\Usuario;
use App\Services\FileHelperService;
use App\Services\MessageService;
use Psr\Log\LoggerInterface;
use WpOrg\Requests\Requests;

class CertificadoNoAtencionHandler implements GatewayResponseHandler
{
    public function __construct(
        private Pago $pago,
        private Order $order,
        private Files $files,
        private Config $config,
        private Usuario $usuario,
        public readonly MessageService $messageService,
        private PaymentGatewayInterface $gateway,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @return array{
     *     0: \App\DataObjects\OrderInfo,
     *     1: \App\Contracts\PaymentInfoInterface,
     * }
     */
    public function fromReturn(GatewayReturnData $data): array
    {
        $error = null;
        $order = $this->order->get(['id' => $data->ref]);
        $payment = $order ? $this->gateway->getPaymentInfo((int) $order->orderId) : null;

        if (!$order || !$payment) {
            $this->logger->error('Pago o Referencia Invalidos. Order: {order}', [
                'order' => $order?->id ?? 'null',
            ]);
            throw new \RuntimeException("Invalid Reference or Payment");
        }

        if ($order->saved) {
            return [$order, $payment];
        }

        $this->pago->db->action(function () use ($payment, &$order, &$error) {
            try {
                $order = $this->order->updateFromGatewayResponse($order, $payment);
                if (in_array($order->status, [MpStatus::APROVADO, MpStatus::RECHAZADO])) {
                    $this->order->setSave($order);
                }

                if ($order->status === MpStatus::APROVADO) {
                    $this->notify($order);
                    $file = $this->generateCertificado($order);

                    if ($file === false) {
                        $this->notifyError($order);
                    } else {
                        $this->order->setFileId($order, $file->id);
                    }
                }
            } catch (\Exception $e) {
                $this->logger->error(
                    'Ha ocurrido un error al registrar el pago. Orden: {order}',
                    ['order' => $order->id]
                );
                $error = $e;
                return false;
            }
        });

        if ($error !== null) {
            throw $error;
        }

        return [$order, $payment];
    }

    /**
     * Envia una notificacion al usuario indicando que ya hace parte del progama.
     */
    public function notify(OrderInfo $order): void
    {
        $usuario = $this->usuario->basic($order->userId);

        $this->messageService->sendMessage(
            $usuario['telefono'],
            MessageService::msgCertificasdoNoAtencion($usuario['email'])
        );
    }

    /**
     * Obtiene y almacena el certificado.
     */
    private function generateCertificado(OrderInfo $order): bool | File
    {
        $usuario = $this->usuario->basic($order->userId);
        $usuarioNombre = implode(" ", [
            $usuario['nom2'],
            $usuario['nom1'],
            $usuario['ape2'],
            $usuario['ape1'],
        ]);

        $certificadoUrl = sprintf(
            '%s/no-atencion/?%s',
            trim($this->config->get('app.local_url'), '/'),
            http_build_query([
                "id" => $order->id,
                "cc" => $usuario['num_histo'],
                "tel" => $usuario['telefono'],
                "nombre" => trim($usuarioNombre),
                "correo" => trim($usuario['email'])
            ])
        );

        $response = Requests::get($certificadoUrl);

        if (!$response->success) {
            return false;
        }

        if ($response->headers['content-type'] !== "application/pdf") {
            return false;
        }

        return $this->saveFile(
            $order,
            $usuario['num_histo'],
            $usuario['id'],
            $response->body
        );
    }

    /**
     * Guarda el archivo del certificado en el disco y almacena su informacion
     * en la base de datos.
    */
    private function saveFile(OrderInfo $order, $ccUsuario, $usuarioId, $responseBody): File
    {
        $fileName = $ccUsuario."-".$order->id.".pdf";
        $fileRute = implode(DIRECTORY_SEPARATOR, [
            $this->config->get('soportes'),
            $order->type->name
        ]);

        file_put_contents($fileName, $responseBody);
        FileHelperService::move($fileName, implode(DIRECTORY_SEPARATOR, [
            $fileRute,
            $fileName
        ]));

        return $this->files->create(new \App\DataObjects\File(
            id: 0,
            usuarioId: (int) $usuarioId,
            name: $fileName,
            rute: $order->type->name,
            fileType: 'application/pdf'
        ));
    }

    private function notifyError(OrderInfo $order): void
    {
        $this->messageService->sendMessage(
            '3209353216',
            MessageService::msgCertificasdoNoAtencionError($order->id)
        );
    }
}
