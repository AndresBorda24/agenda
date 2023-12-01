<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Config;
use Medoo\Medoo;
use App\Models\Plan;
use App\Models\Pago;
use App\Models\Usuario;
use App\DataObjects\CreatePagoInfo;
use App\DataObjects\UpdatePagoInfo;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\Validation\CreateUserValidation;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Validation\Exceptions\FormValidationException;

use function App\ddh;
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
    public function createPago(Request $request, Response $response, int $userId): Response
    {
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
                $pagoId = $this->pago->create(new CreatePagoInfo(
                    userId: $userId,
                    planId: (int) $data["plan"],
                    status: \App\Enums\MpStatus::APROVADO->value,
                    envio:  false,
                    soporte: $soporteName,
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
}
