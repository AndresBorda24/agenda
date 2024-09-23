<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use Slim\App;
use App\Models\Pago;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseJSON;

class PagoController
{
    public function __construct(
        public readonly App $app,
        public readonly Pago $pago
    ) {}

    public function remove(Response $response, int $id): Response
    {
        try {
           return responseJSON($response, $this
                ->pago
                ->remove($id));
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
