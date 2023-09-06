<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Auth;
use App\Models\Usuario;
use Rakit\Validation\Validator;
use App\Controllers\Validation\Exceptions\FormValidationException;
use App\Controllers\Validation\Rules\UniqueRule;

class UpdateUserValidation
{
    public function __construct(
        public readonly Auth $auth,
        public readonly Usuario $usuario,
        private UniqueRule $uniqueRule
    ) {}

    public function check(array $data): void
    {
        try {
            $validator  = new Validator;
            $validator->addValidator("unique", $this->uniqueRule);

            $validator->setMessages([
                "required" => "Valor es requerido.",
                "email" => "Debe ser un correo valido.",
                "min" => "Debe tener una longitud mayor.",
                "date" => "Fecha no valida.",
                "same" => "El valor no coincide.",
                "digits_between" => "Debe tener una longitud entre :min y :max. Y ser un numero."
            ]);

            $validation = $validator->validate($data, [
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
                "num_histo" => [
                    'required',
                    'digits_between:6,15',
                    sprintf(
                        "unique:%s,%s,%s",
                        Usuario::TABLE, 'num_histo', $this->auth->user()->getData("documento")
                    )
                ],
            ]);

            if ($validation->fails()) {
                $errors = $validation->errors();

                throw new FormValidationException(
                    $errors->toArray()
                );
            }
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
