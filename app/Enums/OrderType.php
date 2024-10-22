<?php

declare(strict_types=1);

namespace App\Enums;

use App\GatewaysResponseHandlers\FidelizacionHandler;

enum OrderType: int
{
    case FIDELIZACION = 1;
    case CERT_NO_ATENCION = 2;

    /**
     * @return string Nombre de la clase encargada de manejar las respuestas de
     * la pasarela.
     */
    public function getHandler(): string
    {
        return match ($this) {
            self::FIDELIZACION => FidelizacionHandler::class,
            self::CERT_NO_ATENCION => FidelizacionHandler::class
        };
    }
}
