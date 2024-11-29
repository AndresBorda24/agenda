<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Contracts\UserInterface;
use App\Models\Pago;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

use function App\responseJSON;

class PagoController
{
    public function __construct(
        public readonly App $app,
        public readonly Pago $pago
    ) {}

    public function remove(Response $response, int $id, UserInterface $user): Response
    {
        try {
            $pago = $this->pago->find($id);

            if ($pago !== null && $pago['usuario_id'] == $user->id()) {
                $this->pago->remove($id);
            }

            return responseJSON($response, true);
       } catch (\Exception $e) {
            return responseJSON($response, [
                "message" => $e->getMessage()
           ], 422);
       }
    }

    public function nomina(Response $response, int $id): Response
    {
        try {
           return responseJSON($response, $this
                ->pago
                ->nomina($id));
        } catch (\Exception $e) {
            return responseJSON($response, [
                "message" => $e->getMessage()
           ], 422);
        }
    }
}
