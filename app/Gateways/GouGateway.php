<?php

declare(strict_types=1);

namespace App\Gateways;

use App\Config;
use App\Contracts\PaymentGatewayInterface;
use App\Contracts\PaymentInfoInterface;
use App\Contracts\PaymentItemsInterface;
use App\DataObjects\OrderInfo;
use App\Models\Order;
use Dnetix\Redirection\PlacetoPay;
use App\Enums\MpStatus;
use App\Enums\OrderType;
use App\Gateways\GouGatewayPaymentInfo;
use App\Models\Plan;
use App\Models\Usuario;
use Slim\Factory\ServerRequestCreatorFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

class GouGateway implements PaymentGatewayInterface
{
    public readonly PlacetoPay $placeToPay;
    private Request $request;

    public function __construct(
        public readonly App $app,
        public readonly Plan $plan,
        public readonly Order $order,
        public readonly Usuario $usuario,
        public readonly Config $config
    ) {
        $this->placeToPay = new PlacetoPay([
            "login" => $this->config->get("pasarela.login"),
            "tranKey" => $this->config->get("pasarela.key"),
            "baseUrl" => $this->config->get("pasarela.api"),
            "timeout" => 10,
        ]);
        $this->request = ServerRequestCreatorFactory::create()->createServerRequestFromGlobals();
    }

    public function getPaymentUrl(int $userId, OrderType $type, PaymentItemsInterface $data): string
    {
        $order = $this->order->create(OrderInfo::createBasic($userId, $type));
        $sessionData = $this->getSessionData($data, $order);
        $response = $this->placeToPay->request($sessionData);

        if ($response->isSuccessful()) {
            $newOrder = $this->order->update(
                new OrderInfo(
                    id: $order->id,
                    userId: $order->userId,
                    type: $type,
                    orderId: $response->requestId(),
                    processUrl: $response->processUrl(),
                    status: MpStatus::PENDIENTE,
                    expiresAt: $sessionData["expiration"],
                    data: json_encode(
                        $data->getData(),
                        JSON_HEX_TAG |
                        JSON_HEX_AMP |
                        JSON_HEX_QUOT |
                        JSON_HEX_APOS |
                        JSON_THROW_ON_ERROR
                    )
                )
            );

            return $newOrder->processUrl;
        }

        throw new \RuntimeException(
            "No se ha podido continuar con el proceso: " .
                $response->status()->message()
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

    public function validateNotification(array $data): int
    {
        $requiredFields = ["status", "requestId", "reference", "signature"];

        foreach ($requiredFields as $requiredField) {
            if (!array_key_exists($requiredField, $data)) {
                throw new \RuntimeException(
                    "Missing required field: $requiredField"
                );
            }
        }

        $this->checkNotificationSignature($data);

        return (int) $data['reference'];
    }

    /**
     * Valida que la notificación sea de un origen valido.
     *
     * @param array $notyData Array con los datos que llegan desde la noftificacion
     *  parte del banco
     * @throws \Exception En cado de no concondar el signature
     */
    private function checkNotificationSignature(array $notyData): void
    {
        $reqId  = $notyData["requestId"];
        $status = $notyData["status"]["status"];
        $fecha  = $notyData["status"]["date"];
        $secret = $this->config->get("pasarela.key");
        $signature = $notyData["signature"];

        $sha = sha1($reqId.$status.$fecha.$secret);

        if ($sha !== $signature) {
            throw new \RuntimeException(
                "Notification Validation Error: Invalid signature"
            );
        }
    }

    private function getSessionData(PaymentItemsInterface $data, OrderInfo $orderInfo): array
    {
        [$ip, $userAgent, $returnUrl] = $this->getNeededData($orderInfo->id);
        $userInfo = $this->usuario->basic($orderInfo->userId);

        return [
            "locale" => "es_CO",
            "payment" => [
                "reference" => $orderInfo->id,
                "description" => $data->getDescription(),
                "amount" => [
                    "currency" => $data->getAmount()->currency,
                    "total" => $data->getAmount()->value,
                ],
            ],
            "buyer" => [
                "document" => $userInfo['num_histo'],
                "documentType" => "CC",
                "name" => $userInfo['nom1'],
                "surname" => $userInfo['ape1'],
                "email" => $userInfo['email'],
                "mobile" => "+57".$userInfo['telefono'],
                "address" => [
                    "country" => "Colombia",
                    "city" => $userInfo['ciudad'],
                    "street" => $userInfo['direccion'],
                    "phone" => "+57".$userInfo['telefono'],
                ]
            ],
            "fields" => $data->getFields(),
            "expiration" => date("c", strtotime("+30 min")),
            "returnUrl" => $returnUrl,
            "notificationUrl" => "https://intranet.asotrauma.com.co/atest/",
            "ipAddress" => $ip,
            "userAgent" => $userAgent,
        ];
    }

    /**
     * Obtiene la direccion IP y el user agent basado en la solicitud hecha por
     * el usuario.
     */
    private function getNeededData($reference): array
    {
        $server = $this->request->getServerParams();
        $userAgent = $server["HTTP_USER_AGENT"];

        // Obteniendo rutas para notificacion y retorno
        $routeParser = $this->app->getRouteCollector()->getRouteParser();
        $returnUrl = sprintf(
            "%s%s",
            substr($this->config->get("app.url"), 0, -1),
            $routeParser->urlFor("gateway.returnUrl", [
                "data" => base64_encode(json_encode(["ref" => $reference])),
            ])
        );

        // Cortesia de CHATGPT
        $ip = match (true) {
            !empty($server["HTTP_CLIENT_IP"]) => $server["HTTP_CLIENT_IP"],
            !empty($server["HTTP_X_FORWARDED_FOR"]) => explode(
                ",",
                $server["HTTP_X_FORWARDED_FOR"]
            )[0],
            !empty($server["REMOTE_ADDR"]) => $server["REMOTE_ADDR"],
            default => "",
        };

        return [$ip, $userAgent, $returnUrl];
    }
}
