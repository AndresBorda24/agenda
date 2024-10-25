<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Contracts\PaymentGatewayInterface;
use App\Contracts\UserInterface;
use App\Enums\OrderType;
use App\Models\OrderItems;
use App\Models\Plan;
use App\OrderItems\FidelizacionItems;
use App\OrderItems\GeneralItems;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseJSON;

class OrderController
{
    public function __construct(
        private Plan $plan,
        private OrderItems $orderItems,
        private PaymentGatewayInterface $gateway
    ) {}

    /**
     * Crea una orden exclusivamente de tipo Fidelizacion. Si se requiere crear
     * otro tipo de orden utilizar el metodo `newOrder`
     */
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

    public function newOrder(
        Response $response,
        UserInterface $user,
        int $id
    ): Response {
        $item = $this->orderItems->find(['id' => $id]);
        if ($item === null) throw new \RuntimeException(
            "Invalid Item Identifier"
        );

        $processUrl = $this->gateway->getPaymentUrl(
            $user->id(),
            $item->type,
            new GeneralItems($item)
        );

        return responseJSON($response, [
            "url" => $processUrl
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
