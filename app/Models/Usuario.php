<?php
declare(strict_types=1);

namespace App\Models;

// use App\CalidadDb;
use App\User;
use Medoo\Medoo;
use App\Contracts\UserInterface;
use App\DataObjects\UserInfo;
use App\Enums\TipoBusquedaFidelizado;

use function App\uppercase;

class Usuario
{
    public CONST TABLE = "usuarios";
    public const FIDELIZADOS = "vista_fidelizados";

    public function __construct(
        private Medoo $db,
        public readonly Calidad $calidad
    ) {}

    /**
     * Registra un nuevo paciente (usuario) en la base de datos
    */
    public function create(array $data): int
    {
        try {
            $this->db->insert(static::TABLE, [
                // "eps"  => uppercase($data["eps"]),
                "ape1" => uppercase($data["ape1"]),
                "ape2" => uppercase(@$data["ape2"]),
                "nom1" => uppercase($data["nom1"]),
                "nom2" => uppercase(@$data["nom2"]),
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
                "ape2" => uppercase(@$data["ape2"]),
                "nom1" => uppercase($data["nom1"]),
                "nom2" => uppercase(@$data["nom2"]),
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
            $userInfo = $this->get($id, $field);
            if (! $userInfo) return null;

            $pagoInfo = (new Pago($this->db))
                ->get((int) $userInfo->id);

            $order = (new Order($this->db))
                ->getLastest((int) $id);

            return new User($userInfo, $pagoInfo, $order);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Busca un usuario por el campo deseado.
     * @param string|int $id El valor del campo a buscar.
     * @param string $field El campo por el cual buscar.
    */
    public function get(string|int $id, string $field = "id"): ?UserInfo
    {
        try {
            $userInfo = $this->db->get(static::TABLE." (U)", [
                "U.id [int]", "U.eps", "U.ape1", "U.ape2",
                "U.nom1", "U.nom2", "U.clave", "U.email",
                "U.ciudad", "U.telefono", "U.direccion",
                "U.fech_nac", "U.num_histo (documento)"
            ], [
                "AND" => [
                    "U.$field" => $id,
                    "U.activo" => 1
                ]
            ]);

            if (! $userInfo) return null;

            $userInfo["intranet"] = $this
                ->calidad
                ->userExistsByDoc($userInfo["documento"]);

            $class = new \ReflectionClass(\App\DataObjects\UserInfo::class);
            return $class->newInstanceArgs($userInfo);
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

    /**
     * Busca la informacion de un usuario fidelizado.
     *
     * @return array Informacion del usuario
    */
    public function searchFidelizado(TipoBusquedaFidelizado $type, string $cc): ?array
    {
        try {
           return match ($type) {
               TipoBusquedaFidelizado::CC => $this->searchFidelizadoByCC($cc),
               TipoBusquedaFidelizado::TARJETA => $this->searchFidelizadoByCard($cc),
               default => null,
           };
        } catch(\Exception $e) {
            throw $e;
        }
    }


    /**
     * Busca la informacion de un usuario fidelizado dependiendo de su tarjeta.
     * Se realiza una busqueda tanto de usuarios como de beneficiarios.
    */
    public function searchFidelizadoByCard(string $card): ?array
    {
        try {
            $titular = $this->getTitular(['tarjeta' => $card]);

            if ($titular !== null) {
                return [
                    "type" => "T",
                    "data" => $titular,
                    "beneficiarios" => (new Beneficiario($this->db))
                        ->all((int) $titular["id"])
                ];
            }

            return null;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Busca la informacion de un usuario fidelizado dependiendo de su documento.
     * Se realiza una busqueda tanto de usuarios como de beneficiarios.
    */
    public function searchFidelizadoByCC(string $cc): ?array
    {
        try {
            $titular = $this->getTitular(["documento" => $cc]);
            if ($titular !== null) {
                return [
                    "type" => "T",
                    "data" => $titular,
                    "beneficiarios" => (new Beneficiario($this->db))
                        ->all((int) $titular["id"])
                ];
            }

            $beneficiario = $this->getBeneficiariosFidelizados([ "B.documento" => $cc ], true);
            if ($beneficiario === null) return null;

            return [
                "type" => "B",
                "data" => $beneficiario,
                "titular" => $this->getTitular([ "id" => $beneficiario["titular_id"] ])
            ];
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene la informacion de un titular fidelizado.
     * @param array $where Condición de busqueda.
     * @param string|array $fields Campos a traer.
    */
    public function getTitular(array $where, string|array $fields = '*'): ?array
    {
        return $this->db->get(self::FIDELIZADOS, $fields, $where);
    }

    /**
     * Obtiene el listado de todos los beneficiarios de un usuario fidelizado.
     * Para hacer referencia a las tablas: B: Beeficiarios, F: Fidelizado
     *
     * @param array $where Condicion de busqueda.
     * @param bool $single Determina si se trae el listado o simplemente un
     *                     beneficiario.
    */
    public function getBeneficiariosFidelizados(array $where, bool $single = false): ?array
    {
        $action = $single ? 'get' : 'select';

        return $this->db->{$action}(Beneficiario::TABLE." (B)", [
            "[>]".self::FIDELIZADOS." (F)" => ["titular_id" => "id"]
        ], [
            "nombre" => Medoo::raw(
                "CONCAT_WS(' ', <nom1>, <nom2>, <ape1>, <ape2>)"
            ), "B.id", "B.documento", "parentesco", "titular_id"
        ], $where);
    }
}
