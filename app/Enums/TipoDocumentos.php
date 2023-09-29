<?php
declare(strict_types=1);

namespace App\Enums;

enum TipoDocumentos: string
{
    case CEDULA = "CC";
    case TARJETA_I = "TI";
    case EXTRANJERO = "CE";

    /**
     * Retorna un valor "Humano" para cada uno de los casos.
    */
    public function human(): string {
        return match ($this) {
            static::CEDULA => "Cédula",
            static::TARJETA_I => "Tarjeta de identidad",
            static::EXTRANJERO => "Cédula de extranjería",
            default => ""
        };
    }
}

