<?php

declare(strict_types=1);

namespace App\DataObjects;

class GatewayReturnData
{
    public function __construct(
        public readonly int $ref
    ) { }

    public static function fromArray(array $data): static
    {
        return new static(
            ref: (int) $data['ref']
        );
    }
}
