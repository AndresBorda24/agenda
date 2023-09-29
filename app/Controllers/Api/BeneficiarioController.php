<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Models\Beneficiario;
use App\Contracts\UserInterface;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\Validation\BeneficiarioValidation;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Validation\Exceptions\FormValidationException;

use function \App\responseJSON;

class BeneficiarioController
{
    public function __construct(public readonly Beneficiario $beneficiario) {}

    public function store(
        Request $request,
        Response $response,
        UserInterface $user,
        BeneficiarioValidation $validator
    ): Response {
        try {
            $data = $request->getParsedBody();
            $validator->check($data);

            $id = $this->beneficiario->create($data + [
                "titular_id" => $user->id()
            ]);

            return responseJSON($response, $id);
        } catch(\Exception|FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }

    public function all(Response $response, UserInterface $user): Response
    {
        try {
            return responseJSON(
                $response,
                $this->beneficiario->all($user->id())
            );
        } catch(\Exception|FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }
}
