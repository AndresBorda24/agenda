<?php

declare (strict_types=1);

namespace App\Models;

use App\DataObjects\File;
use Medoo\Medoo;

class Files
{
    public const TABLE = "files";

    public function __construct(
        public readonly Medoo $db
    ) {
    }

    public function create(File $data): File
    {
        $this->db->insert(self::TABLE, [
            "usuario_id" => $data->usuarioId,
            "name" => $data->name,
            "rute" => $data->rute,
            "file_type" => $data->fileType,
        ]);

        return $this->find(['id' => $this->db->id()]);
    }

    public function find(array $where): ?File
    {
        $data = $this->db->get(self::TABLE, '*', $where);
        return $data
            ? File::fromArray($data)
            : null;
    }
}
