<?php
declare(strict_types=1);

namespace App;

use App\Abstracts\AbstractPago;

class Pago extends AbstractPago
{
    public function __construct(
        public readonly int $id,
        public readonly int $usuario_id,
        public readonly int $plan_id,
        public readonly ?string $payment_id,
        public readonly string $status,
        public readonly ?string $detail,
        public readonly ?string $type,
        public readonly ?string $created_at,
        public readonly ?string $tarjeta,
        public readonly bool $envio,
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
        $mpPendiente = match($this->status) {
            \App\Enums\MpStatus::EN_PROCESO->value,
            \App\Enums\MpStatus::PENDIENTE->value,
            \App\Enums\MpStatus::AUTORIZADO->value => true,
            default => false
        };

        $_ = (
            $this->status === \App\Models\Pago::ASO_PENDIENTE ||
            $this->status === \App\Models\Pago::ASO_NOMINA
        );

        return $mpPendiente || $_;
    }

    /**
     * Determina si la vigencia y el estado del plan es valida
    */
    public function isValid(): bool
    {
        if ($this->created_at === null) return false;
        if ($this->isPendiente()) return false;
        if ($this->expireAt() < new \DateTime()) return false;
        if ($this->status !== \App\Enums\MpStatus::APROVADO->value) return false;

        return true;
    }

    public function expireAt(): ?\DateTimeImmutable
    {
        if ($this->created_at === null) return null;

        $created = new \DateTimeImmutable($this->created_at);
        $interval = \DateInterval::createFromDateString($this->vigencia." day");

        return $created->add($interval);
    }
}
