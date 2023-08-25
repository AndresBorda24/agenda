<?php
declare(strict_types=1);

namespace App\Models;

use App\Contracts\UserInterface;
use App\User;
use Medoo\Medoo;

use function App\uppercase;

class Usuario
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
                "fech_nac"  => trim($data["fech_nac"]),

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
     * Busca un usuario por su iD
    */
    public function find(string|int $id, string $field = "id"): ?UserInterface
    {
        try {
            $_ = $this->db->get(static::TABLE, [
                "id", "eps", "ape1", "ape2",
                "nom1", "nom2", "clave", "email",
                "ciudad", "telefono", "direccion",
                "fech_nac", "num_histo (documento)",
            ], [
                "AND" => [
                    $field => $id,
                    "activo" => 1
                ]
            ]);

            if (! $_) return null;

            return new User($_["id"], $_);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Revisa si el valor de un campo ya ha sido tomado.
    */
    public function checkUnique(string $field, $val): bool
    {
        try {
            $total = $this->db->count(static::TABLE, [
                "$field" => $val
            ]);

            return $total === 0;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
