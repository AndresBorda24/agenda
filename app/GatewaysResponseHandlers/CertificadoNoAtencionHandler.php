<?php

declare (strict_types = 1);

namespace App\GatewaysResponseHandlers;

use App\Contracts\GatewayResponseHandler;
use App\Contracts\PaymentGatewayInterface;
use App\DataObjects\GatewayReturnData;
use App\DataObjects\OrderInfo;
use App\Enums\MpStatus;
use App\Models\Order;
use App\Models\Pago;
use App\Models\Usuario;
use App\Services\MessageService;
use Psr\Log\LoggerInterface;

class CertificadoNoAtencionHandler implements GatewayResponseHandler
{
    public function __construct(
        private Pago $pago,
        private Order $order,
        private Usuario $usuario,
        public readonly MessageService $messageService,
        private PaymentGatewayInterface $gateway,
        private LoggerInterface $logger
    ) {}

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
                    $order = $this->order->setSave($order);
                }

                if ($order->status === MpStatus::APROVADO) {
                    $this->notify($order);

                    // Realizar la peticion por el PDF y el envio del correo
                    $this->generateCertificado($order);
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

    private function generateCertificado(OrderInfo $order): bool
    {
        return true;
    }
}
