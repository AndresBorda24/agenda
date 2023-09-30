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
     * Retorna informacion sobre el plan.
     *
     * @param string $key Llave para buscar en la info del plan.
     *
     * @return mixed Si $key existe en la info del plan la retorna, de otro
     * modo sera null.
    */
    public function plan(string $key): mixed;

    /**
     * Determina si el usuario logeado tiene un plan.
    */
    public function hasPlan(): bool;


    /**
     * Determina si la vigencia del plan es valida
    */
    public function isPlanValid(): bool;

    /**
     * Retorna datos mas generales dependiendo de $key
    */
    public function getData(string $key, mixed $default = null): mixed;

    /**
     * @return int Devuelve la edad caculada del paciente.
    */
    public function edad(): ?int;


    /**
     * Determina si el usuario es el titular del plan, es decir, quien
     * realizo la compra.
    */
    public function isTitular(): bool;
}
