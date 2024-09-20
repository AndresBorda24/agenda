<?php
declare(strict_types=1);

namespace App\Models;

use App\Contracts\PaymentInfoInterface;
use App\DataObjects\OrderInfo;
use Medoo\Medoo;

class Order
{
    public const TABLE = "orders";
    public const VISTA = "vista_orders_usuario";

    public function __construct(
        public readonly Medoo $db
    ) {}

    public function create(OrderInfo $data): ?OrderInfo
    {
        $this->db->insert(self::TABLE, [
            'order_id' => $data->orderId,
            'user_id'  => $data->userId,
            'status'   => $data->status->value,
            'process_url' => $data->processUrl
        ]);

        return $this->get(['id' => $this->db->id()]);
    }

    public function update(OrderInfo $data): ?OrderInfo
    {
        $this->db->update(self::TABLE, [
            'order_id' => $data->orderId,
            'status'   => $data->status->value,
            'data'     => $data->data,
            'process_url' => $data->processUrl,
            'expires_at'  => $data->expiresAt
        ], ['id' => $data->id]);

        return $this->get(['id' => $data->id]);
    }

    public function updateFromGatewayResponse(OrderInfo $order, PaymentInfoInterface $data)
    {
        $this->db->update(self::TABLE, [
            'status'   => $data->getState()->value,
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
            'pago_id' => $pagoId
        ], ['id' => $order->id]);

        return true;
    }
}
