<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Models\Plan;
use App\Contracts\UserInterface;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseJSON;

class PlanesController
{
    public function __construct(
        private Plan $plan
    ){}

    /** Obtiene todas las especialidades con citas disponibles */
    public function getAvailable(Response $response, ?UserInterface $user = null): Response
    {
        try {
            return responseJSON(
                $response,
                $this->plan->getAll($user?->isFromIntranet() ?? false)
            );
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }
}
