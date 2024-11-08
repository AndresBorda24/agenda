<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Contracts\PaymentGatewayInterface;
use App\Contracts\UserInterface;
use App\Enums\MpStatus;
use App\Enums\OrderType;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Plan;
use App\OrderItems\CertificadoNoAtencionItems;
use App\OrderItems\FidelizacionItems;
use App\OrderItems\GeneralItems;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseJSON;

class OrderController
{
    public function __construct(
        private Plan $plan,
        private Order $order,
        private OrderItems $orderItems,
        private PaymentGatewayInterface $gateway
    ) {
    }

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
        if ($item === null) {
            throw new \RuntimeException(
                "Invalid Item Identifier"
            );
        }

        $processUrl = $this->gateway->getPaymentUrl(
            $user->id(),
            $item->type,
            match ($item->type) {
                OrderType::CRT_ATENCION => new CertificadoNoAtencionItems($item),
                default => new GeneralItems($item)
            }
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

    public function userFiles(Response $response, UserInterface $user): Response
    {
        $data = $this->order->getOrderFiles($user->id());
        return responseJSON($response, $data);
    }

    public function checkPendiente(Response $response, int $type, UserInterface $user): Response
    {
        $type = OrderType::from($type);

        $latestOrder = $this->order->get([
            "AND" => [
                "user_id" => $user->id(),
                "type"    => $type->value,
                "status"  => MpStatus::PENDIENTE->value
            ],
            "ORDER" => ["id" => "DESC"]
        ]);

        return responseJSON($response, (bool) $latestOrder);
    }
}
