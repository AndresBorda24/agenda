<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DataObjects\GatewayReturnData;
use App\DataObjects\OrderInfo;

interface GatewayResponseHandler
{
    /**
     * @return array{
     *     0: \App\DataObjects\OrderInfo,
     *     1: \App\Contracts\PaymentInfoInterface,
     * }
     */
    public function fromReturn(GatewayReturnData $data): array;

    /**
     * Envia una notificacion al usuario indicando que ya hace parte del progama.
     */
    public function notify(OrderInfo $order): void;
}
