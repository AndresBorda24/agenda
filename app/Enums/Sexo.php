<?php
declare(strict_types=1);

namespace App\Enums;

enum Sexo: string
{
    case MASCULINO = "MA";
    case FEMENINO  = "FE";

    public function human():string
    {
        return match($this) {
            static::MASCULINO => "Masculino",
            static::FEMENINO => "Femenino",
            default => ""
        };
    }
}
