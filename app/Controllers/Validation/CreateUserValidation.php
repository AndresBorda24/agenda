<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use App\Models\Usuario;
use Rakit\Validation\Validator;
use App\Controllers\Validation\Exceptions\FormValidationException;

class CreateUserValidation
{
    public static function check(array $data, Usuario $usuario): void
    {
        try {
            $validator  = new Validator;

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
                "clave" => 'required|min:8',
                "email" => 'required|email',
                "ciudad" => 'required|min:3',
                "telefono" => 'required',
                "fech_nac" => 'required|date',
                "direccion" => 'required',
                "clave_confirm" => 'required|same:clave',
                "num_histo" => [
                    'required',
                    'digits_between:6,15',
                    function ($val) use ($usuario) {
                        if (! $usuario->checkUnique("num_histo", $val)) {
                            return "El documento ya ha sido registrado";
                        }
                    }
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
