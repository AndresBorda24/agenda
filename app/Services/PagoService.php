<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Plan;
use App\Models\Usuario;

/**
 * Registra el pago y, en caso que sea un pago exitoso, actualiza la info del
 * usuario.
*/
class PagoService
{
    public function __construct(
        private Usuario $usuario,
        private Plan $plan
    ) {}
}
