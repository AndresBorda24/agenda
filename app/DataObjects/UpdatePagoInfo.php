<?php
declare(strict_types=1);

namespace App\DataObjects;

class UpdatePagoInfo
{
    public function __construct(
        public readonly string $id,
        public readonly ?string $start,
        public readonly string $status,
        public readonly string $detail,
        public readonly string $type
    ) {}
}
