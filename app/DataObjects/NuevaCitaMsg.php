<?php

declare (strict_types=1);

namespace App\DataObjects;

final class NuevaCitaMsg
{
    public function __construct(
        public readonly string $especialidad,
        public readonly string $fecha,
        public readonly string $hora,
        public readonly string $documento,
        public readonly string $nombre
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            especialidad: $data['especialidad'],
            fecha: $data['fecha'],
            hora: $data['hora'],
            documento: $data['documento'],
            nombre: $data['nombre']
        );
    }
}
