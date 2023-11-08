<?php
declare(strict_types=1);

namespace App;

use App\DataObjects\UserInfo;
use App\Abstracts\AbstractPago;
use App\Contracts\UserInterface;

class User implements UserInterface
{
    public function __construct(
        public readonly UserInfo $info,
        public readonly ?AbstractPago $pago
    ) {}

    public function id(): string|int
    {
        return $this->info->id;
    }

    public function clave(): string
    {
        return  $this->info->clave;
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
                $this->info->nom2,
                $this->info->nom1,
                $this->info->ape2,
                $this->info->ape1,
            ]);
        }

        return implode(" ", [
            $this->info->ape1,
            $this->info->ape2,
            $this->info->nom1,
            $this->info->nom2,
        ]);
    }

    /**
     * @return int Devuelve la edad caculada del paciente.
    */
    public function edad(): ?int
    {
        $a = new \DateTimeImmutable($this->info->fech_nac);
        $edad = $a->diff(new \DateTimeImmutable);

        return $edad->y;
    }

    public function isTitular(): bool
    {
        return $this->info->id === $this->pago?->usuario_id;
    }

    public function isFromIntranet(): bool
    {
        return $this->info->intranet;
    }

    public function hasPago(): bool
    {
        return $this->pago !== null;
    }

    public function getPago(): ?AbstractPago
    {
        return $this->pago;
    }
}
