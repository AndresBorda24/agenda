<?php
declare(strict_types = 1);

namespace App\DataObjects;

class PlanDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $nombre,
        public readonly int $vigencia,
        public readonly string $beneficios,
        public readonly int $valor,
        public readonly int $status
    ) {}

    public static function fromArray(array $data): static
    {
        return new static(
            id: (int) $data['id'],
            nombre: $data['nombre'],
            vigencia: (int) $data['vigencia'],
            beneficios: $data['beneficios'],
            valor: (int) $data['valor'],
            status: (int) $data['status']
        );
    }
}
