<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PaymentGatewayInterface;
use App\DataObjects\GatewayReturnData;
use App\Enums\MpStatus;
use App\Models\Order;
use App\Models\Pago;
use App\Views;

class HandleGatewayResponse
{
    public function __construct(
        private Pago $pago,
        private Views $view,
        private Order $order,
        private PaymentGatewayInterface $gateway
    ) { }

    /**
     * @return array{
     *     0: \App\DataObjects\OrderInfo,
     *     1: \App\Contracts\PaymentInfoInterface,
     * }
     */
    public function fromReturn(GatewayReturnData $data): array
    {
        $order   = $this->order->get(['id' => $data->ref]);
        $payment = $this->gateway->getPaymentInfo((int) $order->orderId);

        if ($order->pagoId === null) {
            $this->pago->db->action(function() use($payment, &$order) {
                $order = $this->order->updateFromGatewayResponse($order, $payment);
                if ($order->status === MpStatus::APROVADO) {
                    // Creamos el pago
                    $pagoId = $this->pago->createFromOrder(
                        $order,
                        \App\DataObjects\PlanDTO::fromArray(json_decode($order->data, true))
                    );

                    // Lo asociamos a la orden
                    $this->order->setPagoId($order, $pagoId);
                }
            });
        }

        return [$order, $payment];
    }
}
