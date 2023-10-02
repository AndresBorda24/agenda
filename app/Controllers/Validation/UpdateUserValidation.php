<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Auth;
use App\Models\Usuario;
use Rakit\Validation\Validator;
use App\Controllers\Validation\Rules\UniqueRule;

class UpdateUserValidation extends Request
{
    public function __construct(
        private UniqueRule $ur,
        protected Validator $validator,
        public readonly Auth $auth,
        public readonly Usuario $usuario
    ) {
        parent::__construct($ur, $validator);
    }

    public function checkUpdate(array $data): void
    {
        try {
           $this->validate($data, $this->updateRules());
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function checkPassword(array $data): void
    {
        try {
            $this->validate($data, $this->passRules());
        } catch(\Exception $e) {
            throw $e;
        }
    }

    private function updateRules(): array
    {
        return [
            "eps" => 'required',
            "ape1" => 'required',
            "ape2" => 'nullable',
            "nom1" => 'required',
            "nom2" => 'nullable',
            "email" => 'required|email',
            "ciudad" => 'required|min:3',
            "telefono" => 'required',
            "fech_nac" => 'required|date',
            "direccion" => 'required',
            "email" => sprintf(
                "required|email|unique:%s,%s,%s",
                Usuario::TABLE, "email", $this->auth->user()->getData("email")
            ),
            "telefono" => sprintf(
                "required|digits:10|unique:%s,%s,%s",
                Usuario::TABLE, "telefono", $this->auth->user()->getData("telefono")
            ),
            "num_histo" => sprintf(
                "required|digits_between:6,15|unique:%s,%s,%s",
                Usuario::TABLE, "num_histo", $this->auth->user()->getData("documento")
            ),
        ];
    }

    private function passRules(): array
    {
        $pass = $this->auth->user()->clave();
        return [
            "_password" => ["required", function ($val) use ($pass) {
                if (! password_verify($val, $pass)) {
                    return "Revisa...";
                }
            }],
            "new_password" => "required|min:8",
            "new_password_confirm" => "required|same:new_password"
        ];
    }
}
