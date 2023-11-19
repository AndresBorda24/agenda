<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;
use App\Enums\EstadosTarjeta;
use App\DataObjects\TarjetaInfo;

class Tarjeta
{
    public const TABLE = "tarjetas";

    public function __construct(
        public readonly Medoo $db
    ) {}

    /**
     * Encuentra la informacion de una tarjeta, si existe.
    */
    public function find(string|int $value, string $field = "id"): ?TarjetaInfo
    {
        try {
            $t = $this->db->get(self::TABLE, [
                "tarj_id (id) [Int]",
                "tarj_consecutivo (consecutivo)",
                "tarj_estado (estado)",
                "tarj_activacion (fecha_activacion)"
            ], [ "$field" => $value ]);

            if ($t === null) return null;
            $t["estado"] = EstadosTarjeta::tryFrom($t["estado"]);

            $class = new \ReflectionClass(TarjetaInfo::class);
            return $class->newInstanceArgs($t);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Establece el estado de la tarjeta a activo. De esta forma se valida que
     * ya ha sido utilizada.
     *
     * @param string $serial Dice serial, pero es el consecutivo de la tarjeta
    */
    public function setUsed(string $serial): void
    {
        try {
            $this->db->update(self::TABLE, [
                "tarj_estado" => EstadosTarjeta::ACTIVO->value,
                "tarj_activacion" => Medoo::raw("NOW()")
            ], ["tarj_consecutivo" => $serial ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
