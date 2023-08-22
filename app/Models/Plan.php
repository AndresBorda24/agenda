<?php
declare(strict_types=1);

namespace App\Models;

use App\DataObjects\PlanDTO;
use Medoo\Medoo;

class Plan
{
    public CONST TABLE = "planes";

    public function __construct(
        private Medoo $db
    ) {}

    /**
     * Busca un plan por su iD
    */
    public function find(string|int $id, string $field = "id"): ?PlanDTO
    {
        try {
            $_ = $this->db->get(static::TABLE, "*", [
                $field => $id,
                "status" => 1
            ]);

            if (! $_) return null;
            return new PlanDTO(... $_);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene todos los planes.
    */
    public function getAll(): array
    {
        try {
            $data = [];
            $this->db->select("planes", "*", [
                "status" => true,
                "ORDER" => [
                    "valor" => "ASC"
                ]
            ], function($plan) use (&$data) {
                $plan["valor_formatted"] = number_format(
                    $plan["valor"],
                    thousands_separator: '.'
                );

                array_push($data, $plan);
            });

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
