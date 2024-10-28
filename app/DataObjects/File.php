<?php

declare (strict_types=1);

namespace App\DataObjects;

class File
{
    public function __construct(
        public readonly int $id,
        public readonly int $usuarioId,
        public readonly string $name,
        public readonly string $rute,
        public readonly string $fileType
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            id: (int) $data['id'],
            usuarioId: (int) $data['usuario_id'],
            name: $data['name'],
            rute: $data['rute'],
            fileType: $data['file_type']
        );
    }
}
