<?php
declare(strict_types=1);

namespace App\DataObjects;

class CodigoRegaloInfo
{
    public function __construct(
        public readonly int $id,
        public readonly string|int $code,
        public readonly int $plan_id,
        public readonly bool $used
    ) {}
}
