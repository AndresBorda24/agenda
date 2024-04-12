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

        /**
         * Si los campos se dejan en null se pondrá el valor que tiene actualmente
         * el registro
         */
        public readonly ?string $start    = null,
        public readonly ?int $userId      = null,
        public readonly ?int $planId      = null,
        public readonly ?bool $envio      = null,
        public readonly ?string $type     = null,
        public readonly ?string $status   = null,
        public readonly ?string $detail   = null,
        public readonly ?int $valorPagado = null,
        public readonly ?string $soporte  = null,
        public readonly ?int $quien       = null
    ) {}
}
