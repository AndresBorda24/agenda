<?php

declare(strict_types=1);

namespace App\DataObjects;

class Amount
{
    public function __construct (
        public readonly string $currency,
        public readonly float $value
    ) { }
}
