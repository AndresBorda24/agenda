<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa los posibles estados que pueda devolver Mercado Pago al momento
 * de realizar una compra.
*/
enum MpStatus: string
{
    case APROVADO   = "approved";
    case PENDIENTE  = "pending";
    case RECHAZADO  = "rejected";
    case CANCELADO  = "cancelled";
    case AUTORIZADO = "authorized";
    case REEMBOLSO  = "refunded";
    case EN_PROCESO = "in_process";
    case EN_MEDIACION = "in_mediation";
    case CHARGED_BACK = "charged_back";
    case NULO = "null";

    public function publicName(): string
    {
        return match($this) {
            self::APROVADO => "Compra Aprobada",
            self::AUTORIZADO => "Compra Autorizada",
            self::PENDIENTE => "Compra Pendiente",
            self::CANCELADO => "Compra Cancelada",
            self::REEMBOLSO => "Reembolso",
            self::EN_PROCESO => "Compra en Proceso",
            self::EN_MEDIACION => "Compra en Mediacion",
            self::EN_MEDIACION, self::NULO, self::RECHAZADO => "Compra Rechazada",
            default => "Compra Terminada"
        };
    }
}
