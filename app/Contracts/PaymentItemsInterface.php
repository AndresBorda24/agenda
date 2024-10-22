<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DataObjects\Amount;

interface PaymentItemsInterface
{
    /**
     * @return string Pequeña descripción de la compra. En algunas pasarelas se
     * usa como titulo.
    */
    public function getDescription(): string;

    /**
     * @return Amount Información sobre la cantidad total del pago y sobre la
     * moneda utilizada
    */
    public function getAmount(): Amount;

    /**
     * @return array Informacion adicional del pago. Aquí pueden ir listados
     * todos los items del pago.
     */
    public function getFields(): array;

    /**
     * @return array Información general del pago. La idea es almacenar esta
     * info en la base de datos.
     */
    public function getData(): array;
}
