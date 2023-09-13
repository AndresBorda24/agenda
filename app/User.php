<?php
declare(strict_types=1);

namespace App;

use App\Contracts\UserInterface;

class User implements UserInterface
{
    public function __construct(
        private readonly string|int $id,
        private readonly array  $data,
    ) {}

    public function id(): string|int
    {
        return $this->id;
    }

    public function clave(): string
    {
        if (!$c = $this->getData("clave")) {
            throw new \Exception("Error fetching user info...");
        }

        return $c;
    }

    /**
     * Retorna el nombre completo del usuario.
     * @param bool $apFirst determina si debe mostrar primero los apellidos o
     * no.
    */
    public function fullName(bool $apFirst = true): string
    {
        if (! $apFirst) {
            return implode(" ", [
                $this->getData("nom2", ""),
                $this->getData("nom1", ""),
                $this->getData("ape2", ""),
                $this->getData("ape1", ""),
            ]);
        }

        return implode(" ", [
            $this->getData("ape1", ""),
            $this->getData("ape2", ""),
            $this->getData("nom1", ""),
            $this->getData("nom2", ""),
        ]);
    }

    /**
     * Retorna datos mas generales dependiendo de $key
    */
    public function getData(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[ $key ];
        }

        return $default;
    }

    /**
     * @return int Devuelve la edad caculada del paciente.
    */
    public function edad(): ?int
    {
        if (! $_ = $this->getData("fech_nac")) return null;

        $a = new \DateTimeImmutable($_);
        $edad = $a->diff(new \DateTimeImmutable);

        return (int) $edad->format('%y');
    }

    public function hasPlan(bool $strict = false): bool
    {
        $hasPlan = $this->getData("pago_id") !== null;

        return $strict
        ? $hasPlan
            && ($this->getData("pago_status") == \App\Enums\MpStatus::APROVADO->value)
        : $hasPlan;
    }

    public function isTitular(): bool
    {
        return $this->id() == $this->getData("titular");
    }
}
