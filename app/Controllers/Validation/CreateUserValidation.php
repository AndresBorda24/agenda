<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Models\Usuario;

class CreateUserValidation extends Request
{
    public function check(array $data): void
    {
        try {
            $this->validate($data, $this->insertRules());
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function checkExternal(array $data): void
    {
        try {
            $this->validate($data, $this->externalRules());
        } catch(\Exception $e) {
            throw $e;
        }
    }

    private function insertRules(): array
    {
        return [
            // "eps" => 'required',
            "ape1" => 'required',
            "ape2" => 'nullable',
            "nom1" => 'required',
            "nom2" => 'nullable',
            "clave" => 'required|min:8',
            "ciudad" => 'required|min:3',
            "fech_nac" => 'required|date',
            "direccion" => 'required',
            "clave_confirm" => 'required|same:clave',
            "email" => sprintf(
                "required|email|unique:%s,%s",
                Usuario::TABLE, "email"
            ),
            "telefono" => sprintf(
                "required|digits:10|unique:%s,%s",
                Usuario::TABLE, "telefono"
            ),
            "num_histo" => sprintf(
                "required|digits_between:6,15|unique:%s,%s",
                Usuario::TABLE, "num_histo"
            )
        ];
    }

    private function externalRules(): array
    {
        return [
            "ape1" => 'required',
            "ape2" => 'nullable',
            "nom1" => 'required',
            "nom2" => 'nullable',
            "clave" => 'required|min:8',
            "ciudad" => 'required|min:3',
            "fech_nac" => 'required|date',
            "direccion" => 'required',
            "email" => sprintf(
                "required|email|unique:%s,%s",
                Usuario::TABLE, "email"
            ),
            "telefono" => sprintf(
                "required|digits:10|unique:%s,%s",
                Usuario::TABLE, "telefono"
            ),
            "num_histo" => sprintf(
                "required|digits_between:6,15|unique:%s,%s",
                Usuario::TABLE, "num_histo"
            )
        ];
    }
}
