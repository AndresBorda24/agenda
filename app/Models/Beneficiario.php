<?php
declare(strict_types=1);

namespace App\Models;

use App\DataObjects\Beneficiario as DataObjectsBeneficiario;
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
            $this->db->insert(self::TABLE, [
                "titular_id" => $data["titular_id"],
                "ape1" => mb_strtoupper($data["ape1"]),
                "ape2" => @$data["ape2"]
                    ? mb_strtoupper($data["ape2"])
                    : null,
                "nom1" => mb_strtoupper($data["nom1"]),
                "nom2" => @$data["nom2"]
                    ? mb_strtoupper($data["nom2"])
                    : null,
                "sexo" => $data["sexo"],
                "fecha_nac" => $data["fecha_nac"],
                "parentesco" => mb_strtoupper($data["parentesco"]),
                "tipo_doc" => $data["tipo_doc"],
                "documento" => $data["documento"],
            ]);

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function update(int $id, DataObjectsBeneficiario $data)
    {
        $this->db->update(self::TABLE, [
            "ape1" => mb_strtoupper($data->ape1),
            "ape2" => $data->ape2
                ? mb_strtoupper($data->ape2)
                : null,
            "nom1" => mb_strtoupper($data->nom1),
            "nom2" => $data->nom2
                ? mb_strtoupper($data->nom2)
                : null,
            "tipo_doc" => $data->tipo_doc->value,
            "parentesco" => mb_strtoupper($data->parentesco)
        ], [ "id" => $id ]);
       
        return true;
    }

    /**
     * Selecciona todos los los beneficiarios para un titular.
    */
    public function all(int $titular): array
    {
        try {
            return $this->db->select(self::TABLE, [
                "nom1", "nom2", "ape1", "ape2", "id", "documento", 
                "tipo_doc", "parentesco", "sexo", "fecha_nac"
            ], [
                "titular_id" => $titular
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Encuentra datos sobre un beneficiario junto con datos importantes del 
     * titular. 
     * 
     * @param string $field Representa el campo por el que se desea buscar el 
     *                      beneficiario. Debe ir precedido de B.
     */
    public function find(int $documento, string $field = "documento"): ?array
    {
        return $this->db->get(self::TABLE." (B)", [
            "[>]".Usuario::TABLE." (T)" => ["titular_id" => "id"]
        ], [
            "B.nom1", "B.nom2", "B.ape1", "B.ape2", "B.documento", "B.tipo_doc", 
            "B.sexo", "T.email", "T.telefono", "T.ciudad", "T.eps", "B.titular_id",
            "T.direccion"
        ], [
            "$field" => $documento
        ]);
    }
}
