<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\GatewayResponseHandler;
use App\DataObjects\GatewayReturnData;
use App\DataObjects\OrderInfo;
use App\User;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class GetOrderHandlerService
{
    public function __construct(
        public readonly LoggerInterface $logger,
        public readonly ContainerInterface $container
    ) { }

    public function get(
        ?OrderInfo $order,
        ?User $user = null,
        ?GatewayReturnData $responseData = null
    ): GatewayResponseHandler {
        try {
            $basicException = new \RuntimeException('Error en la referencia.');

            if ($order === null) {
                $this->logger->error('Error en la referencia: {ref} User: {user}', [
                    'ref' => $responseData?->ref,
                    'user' => $user?->id()
                ]);
                throw $basicException;
            }

            $handlerClass = $order->type->getHandler();
            $handler = $this->container->get($handlerClass);

            if (! $handler instanceof GatewayResponseHandler) {
                $this->logger->error(
                    'Handler no permitido. Ref: {ref} Handler: {handler} User: {user}',
                    [
                        'ref' => $order->id,
                        'handler' =>  $handlerClass,
                        'user' => $user?->id()
                    ]
                );
                throw $basicException;
            }

            return $handler;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw $basicException;
        }
    }
}
