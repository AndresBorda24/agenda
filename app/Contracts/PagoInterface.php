<?php
declare(strict_types=1);

namespace App\Contracts;

interface PagoInterface
{
    /**
     * Esta funcion determina si el usuario tiene un plan en estado pendiente
     * ya sea por completar la compra o desembolsar el dinero.
    */
    public function isPendiente(): bool;

    /**
     * Determina si el usuario logeado tiene un plan.
    */
    public function hasPlan(): bool;

    /**
     * Determina si la vigencia del plan es valida
    */
    public function isPlanValid(): bool;
}
