<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

use function App\uppercase;

class Paciente
{
    public CONST TABLE = "usuarios";

    public function __construct(
        private Medoo $db
    ) {}

    /**
     * Registra un nuevo paciente (usuario) en la base de datos
    */
    public function create(array $data): int
    {
        try {
            $this->db->insert(static::TABLE, [
                "eps"  => uppercase($data["eps"]),
                "ape1" => uppercase($data["ape1"]),
                "ape2" => uppercase($data["ape2"]),
                "nom1" => uppercase($data["nom1"]),
                "nom2" => uppercase($data["nom2"]),
                "clave"  => password_hash(trim($data["clave"]), PASSWORD_BCRYPT),
                "email"  => trim($data["email"]),
                "ciudad" => uppercase($data["ciudad"]),
                "telefono"  => trim($data["telefono"]),
                "direccion" => uppercase($data["direccion"]),
                "num_histo" => trim($data["num_histo"]),
                "fech_nac"  => trim($data["num_histo"]),

                // Valores por defecto
                "activo" => 1,
                "medico" => "ASO",
            ]);

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
