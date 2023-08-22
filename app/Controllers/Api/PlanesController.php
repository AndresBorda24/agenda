<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use function App\responseJSON;

use App\Models\Plan;
use App\Services\MercadoPagoService;
use Psr\Http\Message\ResponseInterface as Response;

class PlanesController
{
    public function __construct(
        private Plan $plan
    ){}

    /** Obtiene todas las especialidades con citas disponibles */
    public function getAvailable(Response $response): Response
    {
        try {
            return responseJSON($response, $this->plan->getAll());
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }

    /**
     * Antes de continuar con el pago se debe crear una "Preferencia".
    */
    public function createPreference(
        Response $response,
        MercadoPagoService $mp,
        int $planId
    ): Response {
        try {
            $plan = $this->plan->find($planId);
            $preferenceId = $mp->genPreference($plan);

            return responseJSON($response, [
                "id" => $preferenceId
            ]);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }
}
