<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa los posibles estados que pueda devolver Mercado Pago al momento
 * de realizar una compra.
*/
enum MpStatus: string
{
    case PENDIENTE = "pending";
    case RECHAZADO = "rejected";
    case APROVADO  = "approved";
}
