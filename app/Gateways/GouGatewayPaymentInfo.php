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
    ) {}

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
        if ($this->planInfo !== null) return $this->planInfo;

        $data = array_filter(
            $this->payment->request()->fields(),
            fn($i) => $i->keyword() === 'plan_id'
        );

        $planNotFoudnException = new \RuntimeException(
            "No se pudo encontrar la informacion del plan."
        );

        if (! $planValuePair = reset($data)) throw $planNotFoudnException;
        if (! $plan = $this->plan->find($planValuePair->value())) throw $planNotFoudnException;

        $this->planInfo = $plan;
        return $this->planInfo;
    }
}
