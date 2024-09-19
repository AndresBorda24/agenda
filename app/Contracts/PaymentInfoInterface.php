<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DataObjects\PlanDTO;
use App\Enums\MpStatus;

interface PaymentInfoInterface
{
    public function getState(): MpStatus;

    public function getMessage(): string;

    public function getPlan(): PlanDTO;
}
