<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\MpStatus;
use Medoo\Medoo;

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
            $this->db->insert(self::TABLE, [
                "id" => $data["id"],
                "status" => $status->value,
                "usuario_id" => $data["usuario_id"]
            ], 'id');

            return true;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
