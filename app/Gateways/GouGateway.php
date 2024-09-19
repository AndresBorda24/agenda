<?php

declare(strict_types=1);

namespace App\Gateways;

use App\Config;
use App\Contracts\PaymentGatewayInterface;
use App\Contracts\PaymentInfoInterface;
use App\Models\Order;
use Dnetix\Redirection\PlacetoPay;
use App\Enums\MpStatus;
use App\Gateways\GouGatewayPaymentInfo;
use App\Models\Plan;
use Slim\Factory\ServerRequestCreatorFactory;
use Psr\Http\Message\ServerRequestInterface as Request;

class GouGateway implements PaymentGatewayInterface
{
    public readonly PlacetoPay $placeToPay;
    private Request $request;

    public function __construct(
        public readonly Plan $plan,
        public readonly Order $order,
        public readonly Config $config
    ) {
        $this->placeToPay = new PlacetoPay([
            'login'   => $this->config->get('pasarela.login'),
            'tranKey' => $this->config->get('pasarela.key'),
            'baseUrl' => $this->config->get('pasarela.api'),
            'timeout' => 10
        ]);
        $this->request = ServerRequestCreatorFactory::create()
            ->createServerRequestFromGlobals();
    }

    public function getPaymentUrl(int $userId, int $planId): string
    {
        $order = $this->order->create(\App\DataObjects\OrderInfo::createBasic($userId));
        $sessionData = $this->getSessionData($planId, $order->id);
        $response    = $this->placeToPay->request($sessionData);

        if ($response->isSuccessful()) {
            $newOrder = $this->order->update(new \App\DataObjects\OrderInfo(
                id: $order->id,
                userId: $order->userId,
                orderId: $response->requestId(),
                processUrl: $response->processUrl(),
                status: MpStatus::PENDIENTE,
                data: json_encode($this->plan->find($planId))
            ));

            return $newOrder->processUrl;
        }

        throw new \RuntimeException(
            "No se ha podido continuar con el proceso: "
            . $response->status()->message()
        );
    }

    public function validatePayment(int $id, $state): bool
    {
        return true;
    }

    public function getPaymentInfo(int $id): PaymentInfoInterface
    {
        $payment = $this->placeToPay->query($id);
        return new GouGatewayPaymentInfo($this->plan, $payment);
    }

    public function processNotification(array $data): array
    {
        return [];
    }

    private function getSessionData(int $planId, $reference): array
    {
        if (!$plan = $this->plan->find($planId)) throw new \RuntimeException(
            "Imposible recuperar la información del plan."
        );

        [$ip, $userAgent] = $this->getNeededData();
        return [
            'locale' => 'es_CO',
            'payment' => [
                'reference' => $reference,
                'description' => 'Plan: '. $plan->nombre,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $plan->valor,
                ],
            ],
            'fields' => [
                [
                    "keyword" => "plan_id",
                    "value" => $planId,
                    "displayOn" => "none"
                ]
            ],
            'expiration' => date('c', strtotime('+30 min')),
            'returnUrl' => 'https://fidelizacion.asotrauma.com.co',
            'notificationUrl' => 'https://fidelizacion.asotrauma.com.co',
            'ipAddress' => $ip,
            'userAgent' => $userAgent
        ];
    }

    /**
     * Obtiene la direccion IP y el user agent basado en la solicitud hecha por
     * el usuario.
    */
    private function getNeededData(): array
    {
        // Cortesia de CHATGPT
        $server    = $this->request->getServerParams();
        $userAgent = $server['HTTP_USER_AGENT'];
        $ip = match(true) {
            !empty($server['HTTP_CLIENT_IP']) => $server['HTTP_CLIENT_IP'],
            !empty($server['HTTP_X_FORWARDED_FOR']) =>
                explode(',', $server['HTTP_X_FORWARDED_FOR'])[0],
            !empty($server['REMOTE_ADDR']) => $server['REMOTE_ADDR'],
            default => ''
        };

        return [$ip, $userAgent];
    }
}
