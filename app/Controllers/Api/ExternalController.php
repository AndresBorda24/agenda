<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Config;
use Medoo\Medoo;
use App\Models\Plan;
use App\Models\Pago;
use App\Models\Usuario;
use UltraMsg\WhatsAppApi;
use App\DataObjects\CreatePagoInfo;
use App\DataObjects\UpdatePagoInfo;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\Validation\CreateUserValidation;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Validation\Exceptions\FormValidationException;
use App\Enums\OrderType;
use App\Enums\TipoBusquedaFidelizado;
use App\Models\Order;
use avadim\FastExcelWriter\Excel;
use DateTimeImmutable;

use function App\responseJSON;

class ExternalController
{
    public function __construct(
        private Medoo $db,
        private Plan $plan,
        private Pago $pago,
        private Order $order,
        private Config $config,
        private Usuario $usuario
    ){}

    /** Obtiene todas las especialidades con citas disponibles */
    public function getPlanes(Response $response): Response
    {
        try {
            return responseJSON(
                $response,
                $this->plan->getAll(true)
            );
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }

    /** Revisa que los datos sean validos */
    public function createUser(
        Request $request,
        Response $response,
        CreateUserValidation $validate
    ): Response {
        try {
            $data = $request->getParsedBody();
            $data["ciudad"] = "Ibagué";

            $validate->checkExternal($data);

            $userId = $this->usuario->create($data);

            return responseJSON($response, $this->usuario->find($userId));
        } catch(\Exception|FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }

    /** Crea un pago y lo relaciona con el usuario */
    public function createPago(
        Request $request,
        Response $response,
        WhatsAppApi $whatsapp,
        int $userId
    ): Response {
        $data = $request->getParsedBody();
        /** @var \Psr\Http\Message\UploadedFileInterface | null */
        $soporte = @$request->getUploadedFiles()["soporte"];

        $soporteName = null;
        if ($soporte !== null) {
            $soporteName = sprintf("%s.%s",
                $userId."-".time(),
                pathinfo($soporte->getClientFilename(), PATHINFO_EXTENSION)
            );
            $soporte->moveTo($this->config->get("soportes")."/$soporteName");
        }

        /** @var \Exception|null */
        $error = null;
        $this->db->action(function() use($userId, $data, $soporteName, &$error) {
            try {
                $plan = $this->plan->find((int) $data["plan"]);
                $pagoId = $data["id"];

                $pago = (bool) $pagoId
                    ? $this->pago->find((int) $pagoId)
                    : null;

                if ($pago === null || $pago['detail'] !== Pago::TYPE_MICROSITIO_GOU) {
                    $pagoId = $this->pago->create(new CreatePagoInfo(
                        userId: $userId,
                        envio:  false,
                        planId: $plan->id,
                        soporte: $soporteName,
                        valorPagado: $plan->valor,
                        status: \App\Enums\MpStatus::APROVADO->value,
                        quien: (int) $data["quien"]
                    ));
                }

                $this->pago->updateInfo((int) $pagoId, new UpdatePagoInfo(
                    id: "PAGO-PRESENCIAL-$pagoId",
                    type: $data["medioPago"],
                    start: date("Y-m-d"),
                    planId: $plan->id,
                    soporte: $soporteName,
                    valorPagado: $plan->valor,
                    detail: $data["referencia"],
                    status: \App\Enums\MpStatus::APROVADO->value
                ));
            } catch(\Exception $e) {
                $error = $e;
                return false;
            }
        });

        if ($error !== null) {
            return responseJSON($response, [
                "error"  => $error->getMessage()
            ], 422);
        }

        $user = $this->usuario->basic($userId);
        $whatsapp->sendChatMessage(3209353216, "Nuevo Fidelizado");
        if ($this->config->get("app.env", "dev") == "prod") {
            $whatsapp->sendChatMessage($user["telefono"], sprintf(
                <<<EOF
                ¡Bienvenido al Programa de Fidelización Asotrauma!🌟

                No olvides registrar a tus beneficiarios desde nuestra página: %s.

                Si tu usuario fue creado *durante el proceso de pago* recuerda que tu usuario y contraseña son tu documento de identidad.

                Gracias por ser parte de nuestra familia y por tu continuo apoyo. ¡Estamos aquí para cuidarte! 🏥💙✌
                EOF,
                $this->config->get("app.url")
            ), 3);
        }

        return responseJSON($response, true);
    }

    /** Busca la información de un Usuario en conjunto con su plan */
    public function fetch(Response $response, string $doc): Response
    {
        try {
            $user = $this->usuario->find($doc, "num_histo");

            if ($user !== null && $user->hasPago()) {
                $data = json_decode(json_encode($user), true);

                $data["pago"]["valid"] = $user->pago->isValid();
                $data["pago"]["pendiente"] = $user->pago->isPendiente();

                $user = $data;
            }

            return responseJSON($response, $user);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Obtiene el listado de pagos.
    */
    public function getPagosList(Request $request, Response $response): Response
    {
        try {
            @[
                "desde" => $desde,
                "hasta" => $hasta
            ] = $request->getQueryParams() + [
                "desde" => date("Y-m-d", strtotime("-1 month")),
                "hasta" => date("Y-m-d")
            ];

            return responseJSON($response, [
                "data"  => $this->pago->fullList($desde, $hasta),
                "rango" => [$desde, $hasta]
            ]);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Retorna el soporte que se adjunto con un pago.
    */
    public function showSoporte(Response $response, string $file): Response
    {
        $fullRoute = $this->config->get("soportes") . "/$file";

        if (! file_exists($fullRoute))
            return responseJSON($response, "No se encontró el archivo", 404);

        $f = fopen($fullRoute, 'rb');

        return $response
            ->withHeader('Content-Type', mime_content_type($fullRoute))
            ->withHeader('Content-Disposition', 'inline; filename='.$file)
            ->withAddedHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->withHeader('Cache-Control', 'post-check=0, pre-check=0')
            ->withHeader('Pragma', 'no-cache')
            ->withBody((new \Slim\Psr7\Stream($f)));
    }

    /**
     * Establece como registrado (o no registrado) el pago que corresponda a
     * $pagoId
    */
    public function setRegistradoVal(Request $request, Response $response, int $pagoId): Response
    {
        $reg = $request->getParsedBody()["registrado"];
        return responseJSON($response, $this->pago->setRegistrado($pagoId, $reg));
    }

    /**
     * Genera y remorna el listado de los pagos en excel. Las fechas aplican como
     * en la generacion del listado.
    */
    public function getExcelPagos(Request $request, Response $response): Response
    {
        try {
            @[
                "desde" => $desde,
                "hasta" => $hasta
            ] = $request->getQueryParams() + [
                "desde" => date("Y-m-d", strtotime("-1 month")),
                "hasta" => date("Y-m-d")
            ];

            $excel = Excel::create(["Pagos $desde - $hasta"]);
            $sheet = $excel->sheet();

            $sheet->writeRow([
                "Identificador", "Registrado", "Tipo", "Valor", "Fecha de Pago",
                "Estado", "Detalle", "Quien Documento", "Quien Nombre", "Quien Area",
                "Cliente Documento", "Cliente Nombre", "Cliente Telefono", "Cliente Correo"
            ]);

            foreach ($this->pago->fullList($desde, $hasta) as $pago) {
                $sheet->writeRow([
                    $pago["id"],
                    $pago["registrado"],
                    $pago["type"],
                    $pago["valor_pagado"],
                    $pago["created_at"],
                    $pago["status"],
                    $pago["detail"],
                    $pago["quien_documento"],
                    $pago["quien_nombre"],
                    $pago["quien_area"],
                    $pago["cliente_documento"],
                    $pago["cliente_nombre"],
                    $pago["cliente_telefono"],
                    $pago["cliente_email"],
                ]);
            }

            $excel->save("excel.xlsx");
            $f = fopen("excel.xlsx", 'rb');

            $response = $response
                ->withHeader('Content-Type', mime_content_type("excel.xlsx"))
                ->withHeader('Content-Disposition', 'inline; filename='."pagos-$desde-$hasta.xlsx")
                ->withAddedHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                ->withHeader('Cache-Control', 'post-check=0, pre-check=0')
                ->withHeader('Pragma', 'no-cache')
                ->withBody((new \Slim\Psr7\Stream($f)));

            unlink("excel.xlsx");
            return $response;
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Busca informacion de un fidelizado si existe
    */
    public function searchFidelizado(Response $response, string $cc, string $tp): Response
    {
        $type = TipoBusquedaFidelizado::tryFrom($tp);
        if ($type === null) throw new \Exception("Search Type unknown.");

        return responseJSON(
            $response,
            $this->usuario->searchFidelizado($type, $cc)
        );
    }

    public function searchOrder(Response $response, int $orderId): Response
    {
        return responseJSON(
            $response,
            (new Order($this->pago->db))->getOrderInfo($orderId)
        );
    }

    /** Obtiene el listado de ordenes.  */
    public function getOrdersList(Request $request, Response $response, int $orderType): Response
    {
        try {
            @[
                "desde" => $desde,
                "hasta" => $hasta
            ] = $request->getQueryParams() + [
                "desde" => date("Y-m-d", strtotime("-1 month")),
                "hasta" => date("Y-m-d")
            ];

            $type = OrderType::from($orderType);
            $desde = new DateTimeImmutable($desde);
            $hasta = new DateTimeImmutable($hasta);

            return responseJSON($response, [
                "data"  => $this->order->getOrdersFullList($desde, $hasta, $type),
                "rango" => [$desde, $hasta]
            ]);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
            ], 422);
        }
    }


}
