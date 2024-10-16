<?php

declare(strict_types=1);

namespace App\Controllers;

use App\DataObjects\GatewayReturnData;
use App\Services\HandleGatewayResponse;
use App\Views;
use Psr\Http\Message\ResponseInterface as Response;

class GatewayController
{
    public function __construct(
        private Views $view,
        private HandleGatewayResponse $handler,
    ) { }

    public function returnView(Response $response, string $data): Response
    {
        $data = GatewayReturnData::fromArray(json_decode(base64_decode($data), true));
        [$order, $payment] = $this->handler->fromReturn($data);

        $this->view->setLayout('layouts/base.php');
        return $this->view->render($response, 'gateway/return-in-site.php', [
            "order"   => $order,
            "payment" => $payment,
            "_TITLE"  => 'Compra Finalizada',
            "_ASSETS" => 'profile/index.js'
        ]);
    }
}
