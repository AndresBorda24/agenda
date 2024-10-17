<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\PaymentGatewayInterface;
use App\DataObjects\GatewayReturnData;
use App\Models\Order;
use App\Services\HandleGatewayResponse;
use App\User;
use App\Views;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use function App\responseJSON;

class GatewayController
{
    public function __construct(
        private Views $view,
        private Order $order,
        private PaymentGatewayInterface $gateway,
        private HandleGatewayResponse $handler
    ) { }

    public function returnView(Response $response, User $user, string $data): Response
    {
        try {
            $data = GatewayReturnData::fromArray(json_decode(base64_decode($data), true));
            [$order, $payment] = $this->handler->fromReturn($data);

            if ($order?->userId !== $user->id()) {
                return $response
                    ->withHeader('Location', $this->view->link('home'))
                    ->withStatus(302);
            }
        } catch (\Exception $e) {
            $error = $e;
            [$order, $payment] = [null, null];
        }


        $this->view->setLayout('layouts/base.php');
        return $this->view->render($response, 'gateway/return-in-site.php', [
            "order"   => $order,
            "payment" => $payment,
            "error"   => @$error,
            "_TITLE"  => 'Compra Finalizada',
            "_ASSETS" => 'profile/index.js'
        ]);
    }

    public function notificationWebhook(Response $response, Request $request): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $ref  = $this->gateway->validateNotification($body);
            $this->handler->fromReturn(new GatewayReturnData($ref));

            return responseJSON($response, [
                "success" => true
            ]);
        } catch (\Exception $e) {
            return responseJSON($response, [
                "success" => false,
                "error" => $e->getMessage()
            ], 422);
        }
    }

    public function checkPendientes(Response $response): Response
    {
        $orders = $this->order->getPendientes();

        $data = [];
        foreach ($orders as $order) {
            try {
                [$order] = $this->handler->fromReturn(new GatewayReturnData($order->id));
                $data[] = [
                    $order?->id,
                    $order?->status
                ];
            } catch (\Exception $e) {
                $this->handler->messageService->sendMessage(
                    3209353216,
                    'Error en check pendientes: '.$e->getMessage()
                );
            }
        }


        return responseJSON($response, [ "orders" => $data ]);
    }
}
