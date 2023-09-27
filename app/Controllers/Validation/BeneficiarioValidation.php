<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Models\Beneficiario;
use Rakit\Validation\Validator;
use App\Controllers\Validation\Exceptions\FormValidationException;
use App\Controllers\Validation\Rules\UniqueRule;

class BeneficiarioValidation
{
    public function __construct(
        private UniqueRule $uniqueRule
    ) {}

    public function check(array $data): void
    {
        try {
            $validator  = new Validator;
            $validator->addValidator("unique", $this->uniqueRule);

            $validator->setMessages([
                "required" => "Valor es requerido.",
                "min" => "Debe tener una longitud mayor.",
                "date" => "Fecha no valida.",
                "same" => "El valor no coincide.",
            ]);

            $validation = $validator->validate($data, [
                "ape1" => 'required',
                "ape2" => 'nullable',
                "nom1" => 'required',
                "nom2" => 'nullable',
                "sexo" => 'required',
                "fech_nac"   => 'required|date',
                "parentesco" => 'required',
                "tipo_doc"   => 'required|date',
                "documento"  => [
                    'required',
                    'digits_between:6,15',
                    sprintf(
                        "unique:%s,%s,%s",
                        Beneficiario::TABLE, 'documento', $data["documento"]
                    )
                ],
            ]);

            if ($validation->fails()) {
                throw new FormValidationException(
                    $validation->errors()->toArray()
                );
            }
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
