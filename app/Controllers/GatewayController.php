<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\PaymentGatewayInterface;
use App\DataObjects\GatewayReturnData;
use App\Models\Order;
use App\User;
use App\Views;
use App\Services\GetOrderHandlerService;
use App\Services\MessageService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

use function App\responseJSON;

class GatewayController
{
    public function __construct(
        private Views $view,
        private Order $order,
        private LoggerInterface $logger,
        private ContainerInterface $container,
        private GetOrderHandlerService $getOrderHandlerService,
        private PaymentGatewayInterface $gateway,
        private MessageService $messageService
    ) { }

    public function returnView(Response $response, User $user, string $data): Response
    {
        try {
            $dataArray = json_decode(base64_decode($data), true);
            $data      = GatewayReturnData::fromArray($dataArray);
            $order     = $this->order->get(['id' => $data->ref ]);

            if ($order?->userId !== $user->id()) {
                return $response
                    ->withHeader('Location', $this->view->link('home'))
                    ->withStatus(302);
            }

           $handler = $this->getOrderHandlerService->get($order, $user, $data);
            [$order, $payment] = $handler->fromReturn($data);
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

            $responseData = new GatewayReturnData($ref);
            $order = $this->order->get(['id' => $responseData->ref ]);
            $handler = $this->getOrderHandlerService->get($order);

            $handler->fromReturn($responseData);
            return responseJSON($response, [ "success" => true ]);
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
                $handler = $this->getOrderHandlerService->get($order);
                [$order] = $handler->fromReturn(new GatewayReturnData($order->id));
                $data[]  = [
                    $order?->id,
                    $order?->status
                ];
            } catch (\Exception $e) {
                $this->messageService->sendMessage(
                    3209353216,
                    'Error en check pendientes: '.$e->getMessage()
                );
            }
        }

        return responseJSON($response, [ "orders" => $data ]);
    }
}
