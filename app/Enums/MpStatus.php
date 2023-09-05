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
    case REEMBOLSO  = "refunded";
    case EN_PROCESO = "in_process";
    case EN_MEDIACION = "in_mediation";
    case CHARGED_BACK = "charged_back";
    case NULO = "null";
}
