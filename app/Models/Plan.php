<?php
declare(strict_types=1);

namespace App\Models;

use App\Config;
use App\DataObjects\PlanDTO;
use Medoo\Medoo;

class Plan
{
    public CONST TABLE = "planes";

    public function __construct(
        private Medoo $db,
        private Config $config
    ) {}

    /**
     * Busca un plan por su iD
    */
    public function find(string|int $id, string $field = "id"): ?PlanDTO
    {
        try {
            $_ = $this->db->get(static::TABLE, [
                "id [Int]",
                "nombre",
                "vigencia [Int]",
                "beneficios",
                "valor [Int]",
                "status [Int]"
            ], [
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
    public function getAll( $colaborador = false ): array
    {
        try {
            $data = [];
            $where = [
                "status" => true,
                "ORDER" => [
                    "valor" => "ASC"
                ]
            ];

            if (! $colaborador ) {
                $where["id[!]"] = $this->config->get('plan_colaborador_id');
            }

            $this->db->select("planes", "*", $where, function($plan) use (&$data) {
                $plan["valor_formatted"] = number_format(
                    (int) $plan["valor"],
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
