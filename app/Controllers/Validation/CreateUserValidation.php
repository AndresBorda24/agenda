<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use Rakit\Validation\Validator;
use App\Controllers\Validation\Exceptions\FormValidationException;

class CreateUserValidation
{
    public static function check(array $data): void
    {
        try {
            $validator = new Validator;
            $validation = $validator->validate($data, [
                "eps" => 'required',
                "ape1" => 'required',
                "ape2" => 'nullable',
                "nom1" => 'required',
                "nom2" => 'nullable',
                "clave" => 'required',
                "email" => 'required|email',
                "ciudad" => 'required|min:3',
                "telefono" => 'required',
                "fech_nac" => 'required|date',
                "direccion" => 'required',
                "num_histo" => 'required|digits:6',
                "clave_confirm" => 'required|same:clave'
            ]);

            if ($validation->fails()) {
                throw new FormValidationException(
                    $validation->getInvalidData()
                );
            }
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
