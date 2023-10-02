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
            )
        ];
    }
}
