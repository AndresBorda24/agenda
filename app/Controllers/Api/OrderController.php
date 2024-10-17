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

    public function notificationWebhook(Response $response, Request $request): Response
    {
        $body = $request->getParsedBody();
        @['requestId' => $req, 'reference' => $ref] = $body;

        if (! $req || !$ref) {
            return responseJSON($response, [
                "error" => "Required fields are missing."
            ], 422);
        }

        // $payment = $this->gateway->getPaymentUrl();

    }


    public function test(Response $response): Response
    {
        $processUrl = $this->gateway->getPaymentUrl(5, 2);

        return responseJSON($response, [ "data" => $processUrl ]);
    }
}
