<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Controllers\Validation\CreateUserValidation;
use App\Controllers\Validation\Exceptions\FormValidationException;
use App\Models\Paciente;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function App\responseJSON;

class UsuarioController
{
    public function __construct(private Paciente $paciente) {}

    public function registro(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();
            CreateUserValidation::check($data);

            return responseJSON($response, [
                "__id" => $this->paciente->create($data)
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
