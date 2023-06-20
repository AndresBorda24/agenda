<?php
declare(strict_types=1);

namespace App\Controllers\Api;

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

            return responseJSON($response, [
                "__id" => $this->paciente->create($data)
            ]);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "status" => false,
                "error" => $e->getMessage()
            ], 422);
        }
    }
}
