<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Auth;
use App\Models\Usuario;
use App\Controllers\Validation\CreateUserValidation;
use App\Controllers\Validation\UpdateUserValidation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Validation\Exceptions\FormValidationException;

use function App\responseJSON;

class UsuarioController
{
    public function __construct(private Usuario $usuario) {}

    public function registro(Request $request, Response $response, Auth $auth): Response
    {
        try {
            $data = $request->getParsedBody();
            CreateUserValidation::check($data, $this->usuario);

            $id = $this->usuario->create($data);
            $auth->logIn($this->usuario->find($id));

            return responseJSON($response, [
                "__id" => $id,
                "redirect" => "/planes"
            ]);
        } catch(FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e->getInvalidFields()
            ], 422);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => []
            ], 422);
        }
    }

    public function getBasic(Response $response, Auth $auth): Response
    {
        try {
            $_ = $auth->user();
            return responseJSON($response, $this->usuario->basic($_->id()));
        } catch(FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e->getInvalidFields()
            ], 422);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => []
            ], 422);
        }
    }

    public function update(
        Request $request,
        Response $response,
        UpdateUserValidation $validator
    ): Response {
        try {
            $data = $request->getParsedBody();
            $validator->check($data, $this->usuario);

            return responseJSON($response, [
                "status" => true,
                "__ctrl" => $this
                    ->usuario
                    ->update($data, $validator->auth->user()->id())
            ]);
        } catch(FormValidationException|\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields() : []
            ], 422);
        }
    }
}
