<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Services\MercadoPagoService;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseJSON;

class MercadoPagoController
{
    public function __construct(
        public readonly MercadoPagoService $mercadoPagoService
    ) {}

    public function getPayment(Response $response, string $id): Response
    {
        $pago = $this->mercadoPagoService->getPayment($id);

        if ($pago !== null) {
            return responseJSON($response, $pago->toArray());
        }

        return responseJSON($response, false);
    }
}
