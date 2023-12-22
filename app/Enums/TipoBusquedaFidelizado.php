<?php
declare(strict_types=1);

namespace App\Enums;

enum TipoBusquedaFidelizado: string
{
    case CC = "cc";
    case TARJETA = "tarjeta";
}
