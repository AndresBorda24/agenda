<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Contracts\UserInterface;
use App\Models\Plan;
use App\Services\MercadoPagoService;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseJSON;

class PlanesController
{
    public function __construct(
        private Plan $plan
    ){}

    /** Obtiene todas las especialidades con citas disponibles */
    public function getAvailable(Response $response, UserInterface $user): Response
    {
        try {
            return responseJSON(
                $response,
                $this->plan->getAll($user->isFromIntranet())
            );
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
            $plan   = $this->plan->find($planId);
            $prefId = $mp->genPreference($plan);

            if (!$prefId) throw new \Exception("Couldn generate preference");

            return responseJSON($response, [
                "id" => $prefId
            ]);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }
}
