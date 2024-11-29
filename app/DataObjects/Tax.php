<?php

declare(strict_types=1);

namespace App\DataObjects;

class Tax
{
    public function __construct(
        public readonly string $kind,
        public readonly float $value
    ) { }
}
