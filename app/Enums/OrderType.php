<?php

declare(strict_types=1);

namespace App\Enums;

use App\GatewaysResponseHandlers\CertificadoNoAtencionHandler;
use App\GatewaysResponseHandlers\FidelizacionHandler;

enum OrderType: int
{
    case FIDELIZACION = 1;
    case CRT_ATENCION = 2;

    /**
     * @return string Nombre de la clase encargada de manejar las respuestas de
     * la pasarela.
     */
    public function getHandler(): string
    {
        return match ($this) {
            self::FIDELIZACION => FidelizacionHandler::class,
            self::CRT_ATENCION => CertificadoNoAtencionHandler::class
        };
    }

    /** @return OrderType[] Array con todos los tipos de Orden que son archivos */
    public static function fileTypes(): array
    {
        return [ self::CRT_ATENCION ];
    }
}
