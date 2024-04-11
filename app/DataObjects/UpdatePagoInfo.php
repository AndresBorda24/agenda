<?php
declare(strict_types=1);

namespace App\DataObjects;

class UpdatePagoInfo
{
    public function __construct(
        /**
         * Representa un id personalizado. Nada referente al id de la BD. Se
         * puede poner el que sea necesario.
        */
        public readonly string $id,
        public readonly ?string $start,
        public readonly string $status,
        public readonly string $detail,
        public readonly string $type,
        public readonly ?string $soporte = null,
        public readonly ?int $quien = null
    ) {}
}
