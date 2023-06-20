<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

use function App\uppercase;

class Paciente
{
    public CONST TABLE = "pacientes";

    /** Campos requeridos para realizar inserts o updates */
    private array $required = [
        "num_histo",
        "ape1",
        "ape2",
        "nom1",
        "nom2",
        "ciudad",
        "direccion",
        "telefono",
        "email",
        "eps"
    ];

    public function __construct(
        private Medoo $db
    ) {}

    /**
     * Registra un nuevo paciente (usuario) en la base de datos
    */
    public function create(array $data): int
    {
        try {
            $this->checkRequired($data);
            $this->db->insert(static::TABLE, [
                "eps"  => uppercase($data["eps"]),
                "ape1" => uppercase($data["ape1"]),
                "ape2" => uppercase($data["ape2"]),
                "nom1" => uppercase($data["nom1"]),
                "nom2" => uppercase($data["nom2"]),
                "email"  => trim($data["email"]),
                "ciudad" => uppercase($data["ciudad"]),
                "telefono"  => trim($data["telefono"]),
                "direccion" => uppercase($data["direccion"]),
                "num_histo" => trim($data["num_histo"]),

                // Valores por defecto
                "activo" => 1,
                "medico" => "ASO",
            ]);

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Revisa que todos los campos requeridos esten en el array de
     * data que se pasa a funciones como create o update
    */
    private function checkRequired(array $data): void
    {
        foreach($this->required as $required) {
            if(! array_key_exists($required, $data)) {
                throw new \Exception("Missing required: $required");
            }
        }
    }
}
