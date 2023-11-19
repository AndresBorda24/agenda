<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Models\Pago;
use App\Models\Tarjeta;
use App\Enums\EstadosTarjeta;
use Rakit\Validation\Validator;
use App\Controllers\Validation\Rules\UniqueRule;

class SetCardValidation extends Request
{
    public function __construct(
        private UniqueRule $uniqueRule,
        protected Validator $validator,
        public readonly Tarjeta $tarjeta
    ) {
        parent::__construct($uniqueRule, $validator);
    }


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
        $that = $this;

        return [
            "serial" => [
                "required",
                sprintf("unique:%s,%s", Pago::TABLE, "tarjeta"),
                function($val) use($that) {
                    $tarjeta = $that->tarjeta->find($val, "tarj_consecutivo");

                    if ($tarjeta === null) return "Tarjeta no encontrada.";

                    if ($tarjeta->estado == EstadosTarjeta::ACTIVO)
                        return "Esta tarjeta ya ha sido activada.";
                }
            ]
        ];
    }
}
