<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Models\Beneficiario;
use Rakit\Validation\Validator;
use App\Controllers\Validation\Rules\UniqueRule;
use App\Controllers\Validation\Exceptions\FormValidationException;

class BeneficiarioValidation
{
    public function __construct(
        private UniqueRule $uniqueRule
    ) {}

    /**
     * Valida que los datos que se envian en el request sean los necesarios para
     * realizar un insert correctamente.
     *
     * @throws App\Controllers\Validation\Exceptions\FormValidationException
    */
    public function check(array $data): void
    {
        try {
            $validator = $this->getInstance();
            $validation = $validator->validate($data, $this->insertRules($data));

            if ($validation->fails()) {
                throw new FormValidationException(
                    $validation->errors()->toArray()
                );
            }
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Estas son las reglas de validacion para la creacion de un nuevo
     * beneficiario.
    */
    private function insertRules(array $data): array
    {
        $tipoDoc = array_map(
            fn($c) => $c->name, \App\Enums\TipoDocumentos::cases()
        );
        return [
            "ape1" => 'required',
            "ape2" => 'nullable',
            "nom1" => 'required',
            "nom2" => 'nullable',
            "sexo" => 'required',
            "fecha_nac"  => 'required|date',
            "parentesco" => 'required',
            "tipo_doc"   => 'required:in'.implode(",", $tipoDoc),
            "documento"  => [
                'required',
                'digits_between:6,15',
                sprintf(
                    "unique:%s,%s,%s",
                    Beneficiario::TABLE, 'documento', $data["documento"]
                )
            ],
        ];
    }

    /**
     * Crea una instancia del validator y establece los mensajes.
    */
    private function getInstance(): Validator
    {
        $validator = new Validator;
        $validator->addValidator("unique", $this->uniqueRule);
        $validator->setMessages([
            "required" => "Valor es requerido.",
            "min" => "Debe tener una longitud mayor.",
            "date" => "Fecha no valida.",
            "same" => "El valor no coincide.",
        ]);

        return $validator;
    }
}
