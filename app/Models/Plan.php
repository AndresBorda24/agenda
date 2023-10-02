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

            /* Esto, quiza, no esta hecho de la mejor manera. La idea seria
            tener un campo en la tabla de planes que sea: "colaborador" o
            "exclusive", de tipo bool (tiny int 1) para hacer el filtro. Sin
            embargo, se comete el "error" de dar por sentado que el plan de
            colaboradores es el de id 3. Bueno, mucho texto pero realmente
            poca necesidad */
            if (! $colaborador ) $where["id[<]"] = 3;

            $this->db->select("planes", "*", $where, function($plan) use (&$data) {
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
