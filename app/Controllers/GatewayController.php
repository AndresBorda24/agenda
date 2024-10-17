<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\PaymentGatewayInterface;
use App\DataObjects\GatewayReturnData;
use App\Services\HandleGatewayResponse;
use App\Views;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use function App\responseJSON;

class GatewayController
{
    public function __construct(
        private Views $view,
        private PaymentGatewayInterface $gateway,
        private HandleGatewayResponse $handler
    ) { }

    public function returnView(Response $response, string $data): Response
    {
        try {
            $data = GatewayReturnData::fromArray(json_decode(base64_decode($data), true));
            [$order, $payment] = $this->handler->fromReturn($data);
            $this->handler->notify($order);
        } catch (\Exception $e) {
            $error = $e;
            [$order, $payment] = [null, null];
        }

        $this->view->setLayout('layouts/base.php');
        return $this->view->render($response, 'gateway/return-in-site.php', [
            "order"   => $order,
            "payment" => $payment,
            "error"   => $error,
            "_TITLE"  => 'Compra Finalizada',
            "_ASSETS" => 'profile/index.js'
        ]);
    }

    public function notificationWebhook(Response $response, Request $request): Response
    {
        $body = $request->getParsedBody();
        $ref  = $this->gateway->validateNotification($body);
        [$order] = $this->handler->fromReturn(new GatewayReturnData($ref));
        $this->handler->notify($order);

        return responseJSON($response, [
            "status" => "success"
        ]);
    }
}
