<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

class Beneficiario
{
    public const TABLE = "beneficiarios";

    public function __construct(
        public readonly Medoo $db
    ) {}

    public function create(array $data): int
    {
        try {
            $this->db->create(self::TABLE, [
                "titular_id" => $data["titular_id"],
                "ape1" => mb_strtoupper($data["ape1"]),
                "ape2" => $data["ape2"]
                    ? mb_strtoupper($data["ape2"])
                    : null,
                "nom1" => mb_strtoupper($data["nom1"]),
                "nom2" => $data["nom2"]
                    ? mb_strtoupper($data["nom2"])
                    : null,
                "sexo" => $data["sexo"],
                "fech_nac" => $data["fech_nac"],
                "parentesco" => mb_strtoupper($data["parentesco"]),
                "tipo_doc" => $data["tipo_doc"],
                "documento" => $data["documento"],
            ]);

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
