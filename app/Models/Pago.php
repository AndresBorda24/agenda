<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;
use App\DataObjects\CreatePagoInfo;
use App\DataObjects\UpdatePagoInfo;

class Pago
{
    public const TABLE = "pagos";
    public const VIEW = "vista_pagos_usuario";
    public const ASO_NOMINA = "ASO_NOMINA";
    public const ASO_PENDIENTE = "ASO_PENDIENTE";
    public const PLAN_DAYS_PLAZO = 2;

    public function __construct(
        public readonly Medoo $db
    ) {}

    /**
     * Guarda el registro de un pago en la base de datos.
     *
     * @return int|bool El id en caso que se realice la insercion o FALSE en
     *                  caso contrario.
    */
    public function create(CreatePagoInfo $data): int
    {
        try {
            $this->db->insert(self::TABLE, [
                "status" => $data->status,
                "plan_id" => $data->planId,
                "usuario_id" => $data->userId,
                "envio" => $data->envio,
                "soporte" => $data->soporte,
                "valor_pagado" => $data->valorPagado,
                "quien" => $data->quien
            ], 'id');

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualiza la informacion de un pago.
     * @throws \Exception En caso de que no se encuentre el pago con el id
     *                    suministrado.
    */
    public function updateInfo(int $id, UpdatePagoInfo $data): bool
    {
        try {
            if (! $this->db->has(self::TABLE, [ "id" => $id])) {
                throw new \Exception("Local Pay not found.");
            }

            $this->db->update(self::TABLE, [
                "type" => $data->type,
                "quien" => $data->quien ?? Medoo::raw("<quien>"),
                "status" => $data->status,
                "detail" => $data->detail,
                "soporte" => $data->soporte ?? Medoo::raw("<soporte>"),
                "payment_id" => $data->id,
                "created_at" => $data->start
            ], [ "id" => $id ]);

            return true;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Establece temporalmente el ID de la preferencia generada por Mercado Pago
     * hasta que se complete el pago. Esto con la finalidad de retomar la compra.
     *
     * @return int El numero de filas afectadas en el Update
    */
    public function setPrefId(int $id, string $prefId): int
    {
        try {
            $_ = $this->db->update(self::TABLE, [
                "payment_id" => $prefId
            ], [ "id" => $id ]);

            return $_->rowCount();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Encuentra la informacion del ultimo pago realizado por un usuario junto
     * con informacion sobre el plan
     *
     * @return ?\App\Pago Nulo Si el usuario no tiene alguna
     *          orden registrada. De otra manera la informacion del pago.
    */
    public function get(int $userId): ?\App\Pago
    {
        try {
            $info = $this->db->get(self::VIEW. " (PG)", [
                "[>]".Plan::TABLE." (P)" => ["plan_id" => "id"]
            ], [
                "PG.id", "PG.usuario_id", "PG.plan_id",
                "PG.type", "PG.created_at", "PG.tarjeta", "PG.envio [Bool]",
                "PG.payment_id", "PG.status", "PG.detail",
                // Informacion del plan asociado a la orden
                "P.nombre", "P.vigencia", "P.beneficios",
                "P.valor", "P.status (active)"
            ], [ "usuario_id" => $userId ]);

            if (! $info) return null;

            $class = new \ReflectionClass(\App\Pago::class);
            return $class->newInstanceArgs($info);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Encuentra la informacion de referente a un pago. No retorna datos de
     * ninguna otra tabla, dicho de otra manera, no hay JOINS.
     *
     * @param mixed $value Valor a buscar
     * @param string $field Campo por el que se realiza la busqueda.
    */
    public function find(mixed $value, string $field = "id"): ?array
    {
        try {
            return $this->db->get(self::TABLE, "*", [
                "$field" => $value
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Relaciona el serial de una tarjeta con un pago.
     *
     * @param int $id ID del pago
     * @param string $serial Serial de la Tarjeta.
    */
    public function setCard(int $id, string $serial): bool
    {
        try {
            $this->db->update(self::TABLE, [
                "tarjeta" => $serial
            ], [ "id" => $id ]);

            return true;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Elimina el registro de un pago.
    */
    public function remove(int $id): int
    {
        try {
            $_ = $this->db->delete(self::TABLE, [
                "id" => $id
            ]);
            return $_->rowCount();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualiza el estado de un pago para el pago con nomina
     * @return int El numero de filas afectadas.
    */
    public function nomina(int $id): int
    {
        try {
            $_ = $this->db->update(self::TABLE, [
                "type" => "nomina",
                "status" => self::ASO_NOMINA,
                "created_at" => null,
                "payment_id" => null
            ], [ "id" => $id ]);
            return $_->rowCount();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene la lista completa de los pagos. Utilizado principalmente para
     * cargar una grilla.
    */
    public function fullList(string $desde, string $hasta): array
    {
        try {
            $query = $this->db->pdo->prepare(sprintf("
                SELECT
                    PG.id, PG.usuario_id, PG.plan_id, PG.soporte,
                    PG.type, DATE(PG.created_at) AS created_at, PG.payment_id,
                    PG.status, PG.detail, PG.quien, U.usuario_documento AS quien_documento,
                    AR.area_servicio_nombre as quien_area, CONCAT_WS(' ',
                        U.usuario_apellido1,
                        U.usuario_nombre1
                    ) AS quien_nombre, PG.valor_pagado, PG.registrado,
                    -- Informacion del cliente:
                    US.telefono AS cliente_telefono, US.num_histo as cliente_documento,
                    US.direccion as cliente_direccion, US.email as cliente_email,
                    CONCAT_WS(' ',
                        US.ape1,
                        US.nom1
                    ) AS cliente_nombre
                FROM %s AS PG
                LEFT JOIN asotraum_calidad.usuario AS U
                    ON U.usuario_id = PG.quien
                LEFT JOIN asotraum_calidad.area_servicio AS AR
                    ON U.area_servicio_id = AR.area_servicio_id
                LEFT JOIN usuarios as US
                    ON US.id = PG.usuario_id
                WHERE
                    PG.status = :status AND
                    PG.created_at BETWEEN :desde AND :hasta
            ", self::TABLE));

            $query->execute([
                ":status" => \App\Enums\MpStatus::APROVADO->value,
                ":desde" => $desde,
                ":hasta" => $hasta
            ]);

            $data = [];
            while($d = $query->fetch(\PDO::FETCH_ASSOC)) {
                $d["registrado"] = (bool) $d["registrado"];
                $d["valor_pagado"] = number_format(
                    (int) $d["valor_pagado"],
                    thousands_separator: '.'
                );
                $data[] = $d;
            }

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Establece el valor del campo registrado.
    */
    public function setRegistrado(int|string $id, bool $registrado): bool
    {
        try {
            $this->db->update(self::TABLE, [
                "registrado" => $registrado
            ], [ "id" => $id ]);

            return true;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
