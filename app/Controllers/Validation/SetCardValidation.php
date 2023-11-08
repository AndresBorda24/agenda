<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Models\Pago;

class SetCardValidation extends Request
{
    public function check(array $data): void
    {
        try {
            $this->validate($data, $this->insertRules());
        } catch(\Exception $e) {
            throw $e;
        }
    }

    private function insertRules(): array
    {
        return [
            "serial" => sprintf("required|min:6|unique:%s,%s",
                Pago::TABLE,
                "tarjeta"
            )
        ];
    }
}
