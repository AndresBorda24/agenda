<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Models\Usuario;
use App\Controllers\Validation\CreateUserValidation;
use App\Controllers\Validation\Exceptions\FormValidationException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function App\responseJSON;

class UsuarioController
{
    public function __construct(private Usuario $usuario) {}

    public function registro(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();
            CreateUserValidation::check($data, $this->usuario);

            return responseJSON($response, [
                "__id" => $this->usuario->create($data)
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
}
