<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;
use App\Enums\MpStatus;

class Pago
{
    public const TABLE = "pagos";

    public function __construct(
        public readonly Medoo $db
    ) {}

    /**
     * Guarda el registro de un pago en la base de datos.
    */
    public function store(array $data, MpStatus $status): bool
    {
        try {
            // Si ya hay un pago con ese id (solo por si acaso)
            if ($this->db->has(self::TABLE, [ "id" => $data["id"] ])) {
                return $this->update($data, $status);
            }

            $this->db->insert(self::TABLE, [
                "id" => $data["id"],
                "error" => $data["error"],
                "status" => $status->value,
                "usuario_id" => $data["usuario_id"]
            ], 'id');

            return true;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualiza la informacion de un pago.
    */
    public function update(array $data, MpStatus $status): bool
    {
        try {
            $this->db->update(self::TABLE, [
                "id" => $data["id"],
                "error" => $data["error"],
                "status" => $status->value,
                "usuario_id" => $data["usuario_id"]
            ],  [ "id" => $data["id"] ]);

            return true;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualiza unicamente el estado de un pago.
    */
    public function updateStatus($id, MpStatus $status)
    {
        try {
            $this->db->update(self::TABLE, [
                "status" => $status->value,
            ],  [ "id" => $id ]);

            return true;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
