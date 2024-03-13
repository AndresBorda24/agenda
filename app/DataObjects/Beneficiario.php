<?php 
declare(strict_types=1);

namespace App\DataObjects;

use App\Enums\Sexo;
use App\Enums\TipoDocumentos;

class Beneficiario {
    public function __construct(
        public readonly string $nom1,
        public readonly string $ape1,
        public readonly Sexo $sexo,
        public readonly string $fecha_nac,
        public readonly string $parentesco,
        public readonly TipoDocumentos $tipo_doc,
        public readonly int|string $documento,
        // Valores por defecto
        public readonly ?string $nom2 = null,
        public readonly ?string $ape2 = null,
        public readonly int|string|null $id = null,
    ) {}
}