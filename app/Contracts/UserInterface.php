<?php
declare(strict_types=1);

namespace App\Contracts;

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
     * Retorna datos mas generales dependiendo de $key
    */
    public function getData(string $key, mixed $default = null): mixed;

    /**
     * @return int Devuelve la edad caculada del paciente.
    */
    public function edad(): ?int;

    /**
     * Determina si el usuario logeado tiene un plan.
     *
     * @param bool $strict Tener en cuenta si esta pendiente o no.
    */
    public function hasPlan(bool $strict = false): bool;

    /**
     * Determina si el usuario es el titular del plan, es decir, quien
     * realizo la compra.
    */
    public function isTitular(): bool;
}
