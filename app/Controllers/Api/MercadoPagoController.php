<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Enums\MpStatus;
use App\Services\MercadoPagoService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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

    public function setPaymentStatus(Response $response, string $id, string $status): Response
    {
        try {
            $status = MpStatus::from($status);

            return responseJSON(
                $response,
                $this->mercadoPagoService->setPaymentStatus($id, $status)
            );
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error" => $e->getMessage()
            ], 422);
        }
    }
}
