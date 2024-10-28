<?php

declare(strict_types=1);

namespace App\OrderItems;

use App\Contracts\PaymentItemsInterface;
use App\DataObjects\Amount;
use App\DataObjects\OrderItem;

class GeneralItems implements PaymentItemsInterface
{
    public function __construct(public readonly OrderItem $item) { }

    /**
     * @return string Pequeña descripción de la compra. En algunas pasarelas se
     * usa como titulo.
    */
    public function getDescription(): string
    {
        return $this->item->name;
    }

    /**
     * @return Amount Información sobre la cantidad total del pago y sobre la
     * moneda utilizada
    */
    public function getAmount(): Amount
    {
        return new Amount('COP', $this->item->price);
    }

    /**
     * @return array Informacion adicional del pago. Aquí pueden ir listados
     * todos los items del pago.
     */
    public function getFields(): array
    {
        return [
            [
                "keyword" => "item_id",
                "value" => $this->item->id,
                "displayOn" => "none",
            ],
            [
                "keyword" => "Item",
                "value" => $this->item->name,
                "displayOn" => "always"
            ]
        ];
    }

    /**
     * @return array Información general del pago. La idea es almacenar esta
     * info en la base de datos.
     */
    public function getData(): array
    {
        return (array) $this->item;
    }
}
