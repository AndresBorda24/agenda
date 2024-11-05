<?php

declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\OrderType;

class OrderItem
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $desc,
        public readonly float  $price,
        public readonly OrderType $type,
        public readonly bool $active,
        public readonly ?string $icon = null
    ) { }

    public static function fromArray(array $data): static
    {
        return new static(
            id: $data['id'],
            name: $data['name'],
            desc: $data['desc'],
            price: (float) $data['price'],
            type: OrderType::from((int) $data['type']),
            icon: $data['icon'],
            active: ($data['active'] == 1)
        );
    }
}
