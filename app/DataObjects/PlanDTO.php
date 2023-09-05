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
}
