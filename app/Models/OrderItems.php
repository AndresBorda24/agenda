<?php

declare(strict_types=1);

namespace App\Models;

use App\DataObjects\OrderItem;
use Medoo\Medoo;

class OrderItems
{
    public const TABLE = 'order_items';

    public function __construct(public readonly Medoo $db) {}

    /** @return OrderItem[] */
    public function getAll(): array
    {
        $items = [];
        $this->db->select(self::TABLE, "*", function($item) use(&$items) {
            $i = OrderItem::fromArray($item);
            array_push($items, $i);
        });

        return $items;
    }

    public function find(array $where): ?OrderItem
    {
        $data = $this->db->get(self::TABLE, '*', $where);

        return $data
            ? OrderItem::fromArray($data)
            : null;
    }
}
