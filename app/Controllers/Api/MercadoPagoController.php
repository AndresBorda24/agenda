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
            $m = \MercadoPago\MerchantOrder::find_by_id($pago->order->id);
            return responseJSON($response, [
                "pago" => $pago?->toArray(),
                "merch" => $m?->toArray()
            ]);
        }

        return responseJSON($response, false);
    }

    public function getMerch(Response $response, string $id): Response
    {
        $m = \MercadoPago\MerchantOrder::find_by_id($id);

        // if ($pago !== null) {
        //     return responseJSON($response, [
        //         "pago" => $pago?->toArray(),
        //         "merch" => $m?->toArray()
        //     ]);
        // }

        return responseJSON($response, $m?->toArray());
    }

    public function getPref(Response $response, string $id): Response
    {
        $pre = \MercadoPago\Preference::find_by_id($id);
        return responseJSON($response, $pre?->toArray());
    }

}
