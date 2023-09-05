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
    public function store(array $data, MpStatus $status): int|bool
    {
        try {
            // Si ya hay un pago con ese id (solo por si acaso)
            if ($this->db->has(self::TABLE, [ "payment_id" => $data["payment_id"] ])) {
                return $this->update($data, $status);
            }

            $_ = $this->db->insert(self::TABLE, [
                "status" => $status->value,
                "plan_id" => $data["plan_id"],
                "usuario_id" => $data["usuario_id"],
                "expires_at" =>  $data["expires_at"],
                "payment_id" => $data["payment_id"],
            ], 'id');

            return $_ ? (int) $this->db->id() : false;
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
                "status" => $status->value,
                "plan_id" => $data["plan_id"],
                "usuario_id" => $data["usuario_id"],
                "expires_at" =>  $data["expires_at"]
            ],  [ "payment_id" => $data["payment_id"] ]);

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
