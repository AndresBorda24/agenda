<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use Medoo\Medoo;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseJSON;

class EpsController
{
    public function __construct(
        private Medoo $db
    ) {}

    public function __invoke(Response $response): Response
    {
        try {
            $eps = $this->db->select("eps", [
                "codigo", "nombre"
            ], [
                "ORDER" => "nombre"
            ]);
            $eps = empty($eps) ? [] : $eps;

            return responseJSON($response, [
                "eps" => $eps
            ]);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "statud" => false,
                "message" => $e->getMessage()
            ], 422);
        }
    }
}
