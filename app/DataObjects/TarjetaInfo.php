<?php
declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\EstadosTarjeta;

class TarjetaInfo
{
    public function __construct(
        public readonly int $id,
        public readonly string $consecutivo,
        public readonly EstadosTarjeta $estado,
        public readonly ?string $fecha_activacion
    ) {}
}
