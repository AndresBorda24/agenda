<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Pago;
use App\DataObjects\UpdatePagoInfo;

class UpdatePagoService
{
    public function __construct(
        public readonly Pago $pago,
        public readonly MercadoPagoService $mp,
    ) {}

    /**
     * Actualiza la info de un pago.
    */
    public function update(int $pagoId, string $mpPayId)
    {
        try {
            // 1. Encontar el pago
            $mpPayment = $this->mp->getPayment($mpPayId);
            if (! $mpPayment) {
                throw new \Exception("Mp Payment Not Found");
            }

            // 2. Obtener los datos necesarios
            $data = new UpdatePagoInfo(
                id: $mpPayId,
                type: $mpPayment->payment_type_id,
                start: $mpPayment->date_approved,
                status: $mpPayment->status,
                detail: $mpPayment->status_detail,
            );

            // 3. Actualizar la informacion del pago
            $this->pago->updateInfo($pagoId, $data);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
