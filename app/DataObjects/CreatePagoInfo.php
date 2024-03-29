<?php
declare(strict_types=1);

namespace App\DataObjects;

class CreatePagoInfo
{
    public function __construct(
        public readonly int $userId,
        public readonly int $planId,
        public readonly bool $envio,
        public readonly string $status,
        public readonly int $valorPagado,
        public readonly ?int $quien = null,
        public readonly ?string $soporte = null
    ) {}
}
