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

        dd($order, $payment->getMessage());
        return $response;
    }
}
