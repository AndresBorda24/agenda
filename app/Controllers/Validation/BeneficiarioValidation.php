<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Models\Beneficiario;
use Rakit\Validation\Validator;
use App\Controllers\Validation\Rules\UniqueRule;
use App\Controllers\Validation\Exceptions\FormValidationException;
use App\Models\Usuario;

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
        $sexo = array_map(
            fn($c) => $c->name, \App\Enums\Sexo::cases()
        );
        return [
            "ape1" => 'required',
            "ape2" => 'nullable',
            "nom1" => 'required',
            "nom2" => 'nullable',
            "sexo" => 'required:in'.implode(",", $sexo),
            "fecha_nac"  => 'required|date',
            "parentesco" => 'required',
            "tipo_doc"   => 'required:in'.implode(",", $tipoDoc),
            "documento"  => sprintf(
                // Notece el usuo doble de unique
                "required|digits_between:6,15|unique:%s,%s|unique:%s,%s",
                Beneficiario::TABLE, 'documento',
                Usuario::TABLE, "num_histo"
            ),
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
            "digits_between" => "Debe tener una longitud entre :min y :max. Y ser un numero.",
            "min" => "Debe tener una longitud mayor.",
            "date" => "Fecha no valida.",
            "same" => "El valor no coincide.",
            "unique" => ":value, ya está registrado como beneficiario o titular"
        ]);

        return $validator;
    }
}
