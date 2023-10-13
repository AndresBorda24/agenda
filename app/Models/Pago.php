<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;
use App\DataObjects\CreatePagoInfo;
use App\DataObjects\UpdatePagoInfo;

class Pago
{
    public const TABLE = "pagos";

    public function __construct(
        public readonly Medoo $db
    ) {}

    /**
     * Guarda el registro de un pago en la base de datos.
     *
     * @return int|bool El id en caso que se realice la insercion o FALSE en
     *                  caso contrario.
    */
    public function create(CreatePagoInfo $data): int
    {
        try {
            $this->db->insert(self::TABLE, [
                "status" => $data->status,
                "plan_id" => $data->planId,
                "usuario_id" => $data->userId
            ], 'id');

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualiza la informacion de un pago.
     * @throws \Exception En caso de que no se encuentre el pago con el id
     *                    suministrado.
    */
    public function updateInfo(int $id, UpdatePagoInfo $data): bool
    {
        try {
            if (! $this->db->has(self::TABLE, [ "id" => $id])) {
                throw new \Exception("Local Pay not found.");
            }

            $this->db->update(self::TABLE, [
                "type" => $data->type,
                "status" => $data->status,
                "detail" => $data->detail,
                "payment_id" => $data->id,
                "created_at" => $data->start
            ], [ "id" => $id ]);

            return true;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
