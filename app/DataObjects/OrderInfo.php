<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\MpStatus;

final class OrderInfo
{
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
        public readonly string $orderId,
        public readonly MpStatus $status,
        public readonly string $processUrl,
        public readonly ?int $pagoId = null,
        public readonly string $createdAt = '',
        public readonly string $updatedAt = '',
        public readonly ?string $expiresAt = null,
        public readonly ?string $data = null
    ) { }

    public static function fromArray(array $data)
    {
        return new static(
            id: $data['id'],
            userId: $data['user_id'],
            orderId: $data['order_id'],
            pagoId: @$data['pago_id'],
            status: MpStatus::from(mb_strtolower($data['status'])),
            processUrl: $data['process_url'],
            createdAt: $data['created_at'],
            expiresAt: $data['expires_at'],
            updatedAt: $data['updated_at'],
            data: $data['data']
        );
    }

    /** Retorna la version más simple posible para el objeto.  */
    public static function createBasic(int $userId)
    {
        return new static(
            id: 0,
            userId: $userId,
            orderId: '',
            processUrl: '',
            status: MpStatus::PENDIENTE
        );
    }
}
