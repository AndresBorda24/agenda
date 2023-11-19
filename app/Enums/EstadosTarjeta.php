<?php
declare(strict_types=1);

namespace App\Enums;

enum EstadosTarjeta: string
{
    case ACTIVO = "A";
    case INACTIVO = "I";
}
