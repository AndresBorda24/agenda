<?php
declare(strict_types = 1);

namespace App\DataObjects;

class UserInfo
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $eps,
        public readonly string $ape1,
        public readonly ?string $ape2,

        public readonly string $nom1,
        public readonly ?string $nom2,
        public readonly string $clave,
        public readonly string $email,

        public readonly string $ciudad,
        public readonly string $telefono,
        public readonly string $direccion,

        public readonly string $fech_nac,
        public readonly string $documento,
        public readonly bool $intranet
    ) {}
}
