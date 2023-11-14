<?php
declare(strict_types=1);

namespace App\Controllers\Validation;

use Rakit\Validation\Validator;
use App\Controllers\Validation\Rules\UniqueRule;
use App\Models\PasswordReset;

class ResetPasswdValidation extends Request
{
    public function __construct(
        private UniqueRule $ur,
        protected Validator $validator,
        public readonly PasswordReset $pw
    ) {
        parent::__construct($ur, $validator);
    }

    public function check(array $data, int $userId): void
    {
        try {
           $this->validate($data, $this->rules($userId));
        } catch(\Exception $e) {
            throw $e;
        }
    }

    private function rules(int $userId): array
    {
        $that = $this;
        return [
            "doc" => "required",
            "cod" => [
                "required",
                fn($cod) => $that->pw->check($userId, $cod)
                    ? true
                    : "Código no valido."
            ],
            "password" => "required|min:8",
            "confirm_password" => "required|same:password"
        ];
    }
}
