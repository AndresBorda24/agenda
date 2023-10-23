<?php
declare(strict_types=1);

namespace App;

use App\Abstracts\AbstractPago;
use App\Contracts\PagoInterface;

class Pago extends AbstractPago implements PagoInterface
{
    public function __construct(
        public readonly int $id,
        public readonly int $usuario_id,
        public readonly int $plan_id,
        public readonly string $payment_id,
        public readonly string $status,
        public readonly ?string $detail,
        public readonly ?string $type,
        public readonly string $created_at,
        // Informacion del plan asociado a la orden
        public readonly string $nombre,
        public readonly int $vigencia,
        public readonly string $beneficios,
        public readonly int $valor,
        public readonly int $active
    ) {}


    /**
     * Esta funcion determina si el usuario tiene un plan en estado pendiente
     * ya sea por completar la compra o desembolsar el dinero.
    */
    public function isPendiente(): bool
    {
        /*
        $mpPendiente = match($this->plan("status")) {
            MpStatus::EN_PROCESO->value,
            MpStatus::PENDIENTE->value,
            MpStatus::AUTORIZADO->value => true,
            default => false
        };

        $_ = $this->plan("status") === Pago::ASO_PENDIENTE;

        return $mpPendiente || $_;
        */



        return true;
    }

    /**
     * Determina si el usuario logeado tiene un plan.
    */
    public function hasPlan(): bool
    {
        return true;
    }

    /**
     * Determina si la vigencia del plan es valida
    */
    public function isPlanValid(): bool
    {
        return true;
    }
}
