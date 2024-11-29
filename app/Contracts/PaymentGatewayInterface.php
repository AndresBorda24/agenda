<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Enums\OrderType;

/**
 * Interfaz para la pasarela de pagos...🤏
*/
interface PaymentGatewayInterface
{
    /** Obtiene la ruta para que el usuario continue con el pago. */
    public function getPaymentUrl(int $userId, OrderType $type, PaymentItemsInterface $data): string;

    /** Determina que un pago tenga un estado en especifico. */
    public function validatePayment(int $id, $state): bool;

    public function getPaymentInfo(int $id): PaymentInfoInterface;

    /** Determina que la informacion recibida en la notificacion sea valida */
    public function validateNotification(array $data): mixed;
}
