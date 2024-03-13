<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Models\Usuario;
use App\Models\Beneficiario;

class BeneficiarioValidation extends Request
{
    /**
     * Valida que los datos que se envian en el request sean los necesarios para
     * realizar un insert correctamente.
     *
     * @throws App\Controllers\Validation\Exceptions\FormValidationException
    */
    public function check(array $data): void
    {
        try {
            $this->validate($data, $this->insertRules($data));
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws App\Controllers\Validation\Exceptions\FormValidationException
    */
    public function checkUpdate(array $data): void
    {
        $this->validate($data, $this->updateRules());
    }

    /**
     * Estas son las reglas de validacion para la creacion de un nuevo
     * beneficiario.
    */
    private function insertRules(): array
    {
        $tipoDoc = array_map(
            fn($c) => $c->name, \App\Enums\TipoDocumentos::cases()
        );
        $sexo = array_map(
            fn($c) => $c->name, \App\Enums\Sexo::cases()
        );

        $usuarios = $this->validator->__invoke("unique")->setParameters([
            "table"  => Usuario::TABLE, 
            "column" => "num_histo"
        ]);

        return [
            "ape1" => 'required',
            "ape2" => 'nullable',
            "nom1" => 'required',
            "nom2" => 'nullable',
            "sexo" => 'required:in'.implode(",", $sexo),
            "fecha_nac"  => 'required|date',
            "parentesco" => 'required',
            "tipo_doc"   => 'required:in'.implode(",", $tipoDoc),
            "documento"  => [
                "required", 
                "digits_between:6,15",
                "unique:". Beneficiario::TABLE . ",documento",
                function ($value) use($usuarios) { 
                    if (! $usuarios->check($value)) {
                        return "El documento ya le pertenece a un usuario...";
                    }

                    return true;
                },
            ],
        ];
    }

    /**
     * Estas son las reglas de validacion para la actualizacion de un beneficiario.
    */
    private function updateRules(): array
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
            "documento"  => [ "required", "digits_between:6,15" ],
        ];
    }
}
