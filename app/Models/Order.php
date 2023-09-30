<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

class Order
{
    public const TABLE = "orders";
    public const VISTA = "vista_orders_usuario";

    public function __construct(
        public readonly Medoo $db
    ) {}

    /**
     * Encuentra la informacion de una orden (entiendase pago o  compra) junto
     * con la informacion del plan.
     *
     * @return null Si el usuario no tiene alguna orden registrada.
     * @return array Informacion de la orden.
    */
    public function find(int $userId): ?array
    {
        try {
            return $this->db->get(self::VISTA." (O)", [
                "[>]".Plan::TABLE." (P)" => ["plan_id" => "id"]
            ], [
                "O.id", "O.usuario_id", "O.plan_id", "O.order_id",
                "O.paid [Bool]", "O.status", "O.started_at", "O.expires_at",
                "O.canceled [Bool]",
                // Informacion del plan asociado a la orden
                "P.nombre", "P.vigencia", "P.beneficios",
                "P.valor", "P.status (active)"
            ], [ "usuario_id" => $userId ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
