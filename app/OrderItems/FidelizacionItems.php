<?php

declare(strict_types=1);

namespace App\OrderItems;

use App\Contracts\PaymentItemsInterface;
use App\DataObjects\Amount;
use App\DataObjects\PlanDTO;

class FidelizacionItems implements PaymentItemsInterface
{
    public function __construct(public readonly PlanDTO $plan) { }

    /**
     * @return string Pequeña descripción de la compra. En algunas pasarelas se
     * usa como titulo.
    */
    public function getDescription(): string
    {
        return "Plan: ". $this->plan->nombre;
    }

    /**
     * @return Amount Información sobre la cantidad total del pago y sobre la
     * moneda utilizada
    */
    public function getAmount(): Amount
    {
        return new Amount('COP', $this->plan->valor);
    }

    /**
     * @return array Informacion adicional del pago. Aquí pueden ir listados
     * todos los items del pago.
     */
    public function getFields(): array
    {
        return [
            [
                "keyword" => "plan_id",
                "value" => $this->plan->id,
                "displayOn" => "none",
            ],
            [
                "keyword" => "Plan",
                "value" => $this->plan->nombre,
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
        return (array) $this->plan;
    }
}
