<?php
declare(strict_types=1);

namespace App\Models;

use App\User;
use Medoo\Medoo;
use App\Contracts\UserInterface;

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
     * @return int Retorna la cantidad de filas afectadas con el update,
     * principalmente 1 aunque puede ser 0
    */
    public function update(array $data, $id): int
    {
        try {
            $_ = $this->db->update(static::TABLE, [
                "eps" => uppercase($data["eps"]),
                "ape1" => uppercase($data["ape1"]),
                "ape2" => uppercase($data["ape2"]),
                "nom1" => uppercase($data["nom1"]),
                "nom2" => uppercase($data["nom2"]),
                "email" => uppercase($data["email"]),
                "ciudad" => uppercase($data["ciudad"]),
                "telefono" => $data["telefono"],
                "fech_nac" => uppercase($data["fech_nac"]),
                "direccion" => uppercase($data["direccion"]),
                "num_histo" => $data["num_histo"]
            ], [ "id" => $id ]);

            return (int) $_->rowCount();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return int Retorna la cantidad de filas afectadas con el update,
     * principalmente 1 aunque puede ser 0
    */
    public function updatePassword(array $data, $id): int
    {
        try {
            $_ = $this->db->update(static::TABLE, [
                "clave" => password_hash(trim($data["new_password"]), PASSWORD_BCRYPT)
            ], [ "id" => $id ]);

            return (int) $_->rowCount();
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
            $_ = $this->db->get(static::TABLE." (U)", [
                "[>]pagos (P)" => ["pago_id" => "id"],
                "[>]planes (N)" => ["P.plan_id" => "id"]
            ], [
                // Informacion del usuario
                "U.id", "U.eps", "U.ape1", "U.ape2",
                "U.nom1", "U.nom2", "U.clave", "U.email",
                "U.ciudad", "U.telefono", "U.direccion",
                "U.fech_nac", "U.num_histo (documento)",
                // Informacion de su pago
                "P.status (pago_status)", "P.id (pago_id)",
                "P.expires_at (pago_expires)", "P.usuario_id (titular)",
                // Info del plan al que esta relacionado
                "N.nombre (plan_nombre)"
            ], [
                "AND" => [
                    "U.$field" => $id,
                    "U.activo" => 1
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
    public function checkUnique(string $field, $val, $default = null): bool
    {
        try {
            $total = $this->db->count(static::TABLE, [
                "AND" => [
                    "$field" => $val,
                    $field."[!]" => $default
                ]
            ]);

            return $total === 0;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualiza la informacion del plan para un usuario.
    */
    public function setPlan(int $id, int $pagoId): bool
    {
        try {
            $_ = $this->db->update(self::TABLE, [
                "pago_id" => $pagoId
            ], [ "id" => $id ]);

            return (bool) $_->rowCount();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Busca un usuario por su iD
    */
    public function basic(string|int $id): ?array
    {
        try {
            $_ = $this->db->get(static::TABLE." (U)", [
                "U.id", "U.eps", "U.ape1", "U.ape2",
                "U.nom1", "U.nom2", "U.email",
                "U.ciudad", "U.telefono", "U.direccion",
                "U.fech_nac", "U.num_histo",
            ], [
                "AND" => [
                    "U.id" => $id,
                    "U.activo" => 1
                ]
            ]);

            return $_ ? $_ : null;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
