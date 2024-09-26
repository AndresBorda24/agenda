<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Abstracts\AbstractPago;
use App\DataObjects\OrderInfo;

/**
 * @property ?\App\Abstracts\AbstractPago $pago
 * @property \App\DataObjects\UserInfo $info
*/
interface UserInterface
{
    public function id(): string|int;
    public function clave(): string;

    /**
     * Retorna el nombre completo del usuario.
     * @param bool $apFirst determina si debe mostrar primero los apellidos o
     * no.
    */
    public function fullName(bool $apFirst = true): string;

    /**
     * Determina si el usuario logeado tiene un plan.
    */
    public function hasPago(): bool;

    /**
     * @return int Devuelve la edad caculada del paciente.
    */
    public function edad(): ?int;

    /**
     * Determina si el usuario es el titular del plan, es decir, quien
     * realizo la compra.
    */
    public function isTitular(): bool;

    /**
     * Determina si el usuario ya esta registrado en la base de datos de
     * usuarios de intranet
    */
    public function isFromIntranet(): bool;

    /**
     * Obtiene la informacion del pago.
    */
    public function getPago(): ?AbstractPago;

    /**
     * Obtiene la informacion de la última orden registrada por el usuario.
     */
    public function getOrder(): ?OrderInfo;
}
