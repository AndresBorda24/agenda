<?php

declare (strict_types=1);

namespace App\Models;

use App\Contracts\PaymentInfoInterface;
use App\DataObjects\OrderInfo;
use App\DataObjects\OrderItem;
use App\DataObjects\PlanDTO;
use App\Enums\MpStatus;
use App\Enums\OrderType;
use Medoo\Medoo;

use function PHPSTORM_META\map;

class Order
{
    public const TABLE = "orders";
    public const VISTA = "vista_orders_usuario";

    public function __construct(
        public readonly Medoo $db
    ) {
    }

    public function create(OrderInfo $data): ?OrderInfo
    {
        $this->db->insert(self::TABLE, [
            'order_id' => $data->orderId,
            'user_id' => $data->userId,
            'status' => $data->status->value,
            'type' => $data->type->value,
            'process_url' => $data->processUrl,
        ]);

        return $this->get(['id' => $this->db->id()]);
    }

    public function update(OrderInfo $data): ?OrderInfo
    {
        $this->db->update(self::TABLE, [
            'order_id' => $data->orderId,
            'status' => $data->status->value,
            'data' => $data->data,
            'type' => $data->type->value,
            'saved' => $data->saved,
            'process_url' => $data->processUrl,
            'expires_at' => $data->expiresAt,
        ], ['id' => $data->id]);

        return $this->get(['id' => $data->id]);
    }

    public function updateFromGatewayResponse(OrderInfo $order, PaymentInfoInterface $data)
    {
        $this->db->update(self::TABLE, [
            'status' => $data->getState()->value
        ], ['id' => $order->id]);

        return $this->get(['id' => $order->id]);
    }

    /**
     * Obtiene la informacion de una orden registrada segun los criterios
     * suministrados.
     */
    public function get(array $where): ?OrderInfo
    {
        $data = $this->db->get(self::TABLE, '*', $where);

        return ($data === null)
        ? null
        : OrderInfo::fromArray($data);
    }

    public function setPagoId(OrderInfo $order, int $pagoId): bool
    {
        $this->db->update(self::TABLE, [
            'pago_id' => $pagoId,
        ], ['id' => $order->id]);

        return true;
    }

    /**
     * Busca la última orden realizada por un usuario y retorna la informacion
     * si el estado es pendiente.
     */
    public function getLastest(int $userId, OrderType $type): ?OrderInfo
    {
        $data = $this->db->get(self::VISTA, '*', [
            "user_id" => $userId,
            "type" => $type->value,
        ]);

        return ($data === null) ? null : OrderInfo::fromArray($data);
    }

    /**
     * Retorna un array con todas las ordenes pendientes por estado final.
     * @return OrderInfo[]
     */
    public function getPendientes(): array
    {
        $data = [];

        $this->db->select(self::TABLE, '*', [
            'status' => MpStatus::PENDIENTE->value,
        ], function (array $reg) use (&$data) {
            $data[] = OrderInfo::fromArray($reg);
        });

        return $data;
    }

    /** Establece la propiedad `saved` a true */
    public function setSave(OrderInfo $order): bool
    {
        $this->db->update(self::TABLE, [
            'saved' => true,
        ], ['id' => $order->id]);
        return true;
    }

    /**
     * Relaciona un archivo con una orden al establecer la propidad file_id
     */
    public function setFileId(OrderInfo $order, int $fileId): bool
    {
        $this->db->update(self::TABLE, [
            'file_id' => $fileId,
        ], ['id' => $order->id]);
        return true;
    }

    public function getOrderFiles(int $userId): array
    {
        $data = [];
        $this->db->select(self::TABLE." (O)", [
            '[>]'.Files::TABLE.' (F)' => ["file_id" => "id"],
            '[>]'.OrderItems::TABLE.' (I)' => "type"
        ], [
            "O.id", "O.created_at", "I.name", "F.name (file_name)",
            "F.id (file_id)", "O.status"
        ], [
            "O.user_id" => $userId,
            "O.status" => [MpStatus::APROVADO->value, MpStatus::PENDIENTE->value],
            "O.type" => array_map(fn ($t) => $t->value, OrderType::fileTypes()),
            "ORDER" => ["O.id" => "DESC"]
        ], function ($i) use (&$data) {
            $data[] = [
                "id" => (int) $i["id"],
                "created_at" => $i["created_at"],
                "name" => $i["name"],
                "file_id" => $i["file_id"],
                "status" => MpStatus::from($i["status"])->publicName(),
                "status_raw" => $i["status"]
            ];
        });

        return $data;
    }

    /**
     * Obtiene todas las ordenes que un usuario ha realizado que se encuentre
     * en cualquiera de los tres estados: Aprobado, Rechazado o Pendiente.
     * @return array<int, array{
     *  id: number,
     *  created_at: string,
     *  updated_at: string,
     *  file_id: number|null,
     *  type: OrderType,
     *  data: PlanDto | OrderItem,
     *  status: MpStatus,
     *  status_raw: number | string
     * }>
     */
    public function getUserOrders(int $userId): array
    {
        $data = [];

        $this->db->select(self::TABLE." (O)", [
            '[>]'.Files::TABLE.' (F)' => ["file_id" => "id"],
        ], [
            "O.id", "F.name (file_name)", "O.type",
            "F.id (file_id)", "O.status", "O.data", "O.created_at", "O.updated_at"
        ], [
            "O.user_id" => $userId,
            "O.status" => [
                MpStatus::APROVADO->value,
                MpStatus::PENDIENTE->value,
                MpStatus::RECHAZADO->value
            ],
            "ORDER" => ["O.id" => "DESC"]
        ], function ($i) use (&$data) {
            $type = OrderType::from((int) $i['type']);
            $dataDecoded = json_decode($i["data"], true);
            $item = match($type) {
                OrderType::FIDELIZACION => PlanDTO::fromArray($dataDecoded),
                OrderType::CRT_ATENCION => OrderItem::fromArray($dataDecoded),
                default => null
            };

            $data[] = [
                "id" => (int) $i["id"],
                "created_at" => $i["created_at"],
                "updated_at" => $i["updated_at"],
                "file_id" => $i["file_id"],
                "type" => $type,
                "data" => $item,
                "status" => MpStatus::from($i["status"]),
                "status_raw" => $i["status"]
            ];
        });

        return $data;
    }

    public function getOrderInfo(int $orderId): ?array
    {
        $order = $this->db->get(self::TABLE.' (O)', [
            '[>]'.Usuario::TABLE.' (U)' => ["user_id" => "id"]
        ], [
            'O.id', 'O.order_id', 'O.status', 'O.saved', 'O.type',
            'O.created_at', 'O.expires_at', 'O.updated_at', 'O.data',
            'documento' => $this->db::raw('<num_histo>'),
            'U.tipo_documento',
            'nombre' => $this->db::raw("CONCAT_WS(' ', <nom1>,<nom2>,<ape1>,<ape2>)"),
            'U.direccion', 'U.telefono', 'U.email'
        ], ["O.id" => $orderId]);

        if ($order === null) return null;

        $order['type'] = OrderType::tryFrom($order['type'])?->name;
        $order['data'] = json_decode($order['data'], true);

        return $order;
    }
}
