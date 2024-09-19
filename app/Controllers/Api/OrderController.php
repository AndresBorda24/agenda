<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Contracts\PaymentGatewayInterface;
use App\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function App\responseJSON;

class OrderController
{
    public function __construct(
        private PaymentGatewayInterface $gateway
    ) { }

    public function createOrder(Response $response, User $user, int $planId): Response
    {
        $processUrl = $this->gateway->getPaymentUrl($user->id(), $planId);
        return responseJSON($response, [
            "url" => $processUrl
        ]);
    }
}
