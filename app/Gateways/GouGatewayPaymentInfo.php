<?php

declare(strict_types=1);

namespace App\Gateways;

use App\Contracts\PaymentInfoInterface;
use App\DataObjects\PlanDTO;
use App\Enums\MpStatus;
use App\Models\Plan;
use Dnetix\Redirection\Message\RedirectInformation;

class GouGatewayPaymentInfo implements PaymentInfoInterface
{
    private ?PlanDto $planInfo = null;

    public function __construct(
        private Plan $plan,
        private RedirectInformation $payment
    ) {
    }

    public function getState(): MpStatus
    {
        return MpStatus::from(mb_strtolower(
            $this->payment->status()->status()
        ));
    }

    public function getMessage(): string
    {
        return $this->payment->status()->message();
    }

    public function getPlan(): PlanDTO
    {
        if ($this->planInfo !== null) {
            return $this->planInfo;
        }

        $data = array_filter(
            $this->payment->request()->fields(),
            fn ($i) => $i->keyword() === 'plan_id'
        );

        $planNotFoudnException = new \RuntimeException(
            "No se pudo encontrar la informacion del plan."
        );

        if (! $planValuePair = reset($data)) {
            throw $planNotFoudnException;
        }
        if (! $plan = $this->plan->find($planValuePair->value())) {
            throw $planNotFoudnException;
        }

        $this->planInfo = $plan;
        return $this->planInfo;
    }

    public function getAmount(): float
    {
        $total = 0;
        foreach ($this->payment->payment() as $payment) {
            if ($payment->status()->isApproved()) {
                $total += $payment->amount()->to()->total();
            }
        }
        return $total;
    }

    public function getDiscount(): ?float
    {
        $total = 0;
        foreach ($this->payment->payment() as $payment) {
            if ($payment->status()->isApproved()) {
                $discount = $payment->discount()?->amount();

                if ($discount === null) {
                    continue;
                }

                $total += $discount;
            }
        }
        return $total;
    }

    public function getPaymentName(): array
    {
        return array_map(
            fn ($payment) => $payment->paymentMethodName(),
            $this->payment->payment()
        );
    }

    public function isActive(): bool
    {
        // En la pasarela de pagos GOU PC significa que aún está activa la
        // sesión.
        return $this->payment->status()->reason() === 'PC';
    }
}
