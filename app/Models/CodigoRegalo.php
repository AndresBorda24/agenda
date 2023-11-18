<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;
use App\DataObjects\CodigoRegaloInfo;

class CodigoRegalo
{
    public const TABLE = "codigos_regalo";

    public function __construct(
        public readonly Medoo $db
    ) {}

    /**
     * Checa si la el codigo existe y si ya ha sido usado.
     * @param $code Codigo de Regalo.
    */
    public function isValid(string|int $code): bool
    {
        try {
            $used = $this->db->get(self::TABLE, "used [Bool]", [
                "code" => $code
            ]);

            if ($used === null) return false;

            return $used;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Marca como usado el codigo de regalo.
    */
    public function setUsed(string|int $code): void
    {
        try {
            $this->db->update(
                self::TABLE,
                ["used" => true],
                ["code" => $code]
            );
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Enncuentra la informacion de un codigo de regalo
     *
     * @param $value El valor que se desea comprara
     * @param $field El campo por el que se quiere buscar
    */
    public function find(string|int $value, string $field = "id"): ?CodigoRegaloInfo
    {
        try {
            $code = $this->db->get(self::TABLE, [
                "id [Int]",
                "code",
                "plan_id [Int]",
                "used [Bool]"
            ], [ "$field" => $value ]);

            if ($code === null) return null;

            $class = new \ReflectionClass(CodigoRegaloInfo::class);
            return $class->newInstanceArgs($code);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
