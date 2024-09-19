<?php

declare(strict_types=1);

namespace App\Contracts;

/**
 * Interfaz para la pasarela de pagos...🤏
*/
interface PaymentGatewayInterface
{
    /** Obtiene la ruta para que el usuario continue con el pago. */
    public function getPaymentUrl(int $userId, int $planId): string;

    /** Determina que un pago tenga un estado en especifico. */
    public function validatePayment(int $id, $state): bool;

    public function getPaymentInfo(int $id): array;

    public function processNotification(array $data): array;
}
