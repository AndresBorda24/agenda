<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Contracts\PaymentGatewayInterface;
use App\Contracts\UserInterface;
use App\Enums\OrderType;
use App\Models\Plan;
use App\OrderItems\FidelizacionItems;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseJSON;

class OrderController
{
    public function __construct(
        private Plan $plan,
        private PaymentGatewayInterface $gateway
    ) {}

    public function createOrder(
        Response $response,
        UserInterface $user,
        int $planId
    ): Response {
        $processUrl = $this->gateway->getPaymentUrl(
            $user->id(),
            OrderType::FIDELIZACION,
            new FidelizacionItems($this->plan->find($planId))
        );
        return responseJSON($response, [
            "url" => $processUrl,
        ]);
    }

    public function test(Response $response): Response
    {
        $processUrl = $this->gateway->getPaymentUrl(
            5,
            OrderType::FIDELIZACION,
            new FidelizacionItems($this->plan->find(2))
        );

        return responseJSON($response, ["data" => $processUrl]);
    }
}
