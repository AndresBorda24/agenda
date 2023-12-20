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
use avadim\FastExcelWriter\Excel;

use function App\responseJSON;

class ExternalController
{
    public function __construct(
        private Medoo $db,
        private Plan $plan,
        private Pago $pago,
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
                $pagoId = $this->pago->create(new CreatePagoInfo(
                    userId: $userId,
                    envio:  false,
                    planId: $plan->id,
                    soporte: $soporteName,
                    valorPagado: $plan->valor,
                    status: \App\Enums\MpStatus::APROVADO->value,
                    quien: (int) $data["quien"]
                ));

                $this->pago->updateInfo($pagoId, new UpdatePagoInfo(
                    id: "PAGO-PRESENCIAL-$pagoId",
                    type: $data["medioPago"],
                    start: date("Y-m-d"),
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

        if ($this->config->get("app.env", "dev") == "prod") {
            $user = $this->usuario->basic($userId);
            $whatsapp->sendChatMessage($user["telefono"], sprintf(
                "¡Bienvenido al Programa de Fidelización Asotrauma!🌟\n\nNo olvides registrar a tus beneficiarios desde nuestra página: %s. Recuerda que tu usuario y contraseña son tu documento de identidad.\n\nGracias por ser parte de nuestra familia y por tu continuo apoyo. ¡Estamos aquí para cuidarte! 🏥💙✌",
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

}
