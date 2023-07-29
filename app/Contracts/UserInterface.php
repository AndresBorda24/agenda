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
}
