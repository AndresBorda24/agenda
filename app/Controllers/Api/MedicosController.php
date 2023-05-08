<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use function App\responseJSON;

use Medoo\Medoo;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MedicosController
{
    public function __construct(
        private Medoo $db
    ){}

    public function getAvailable(Response $response, string $esp): Response
    {
        try {
            $colors = [
                "primary",
                "secondary",
                "success",
                "danger",
                "info",
                "warning",
                "dark"
            ];

            $data = $this->db->select('citas_web (C)', [
                "[>]medicos (M)" => ["medico" => "codigo"] // JOIN
            ],[
                'C.medico' => ['M.nombre'] // COLUMNAS
            ],[
                "AND" => [
                    "fecha_programada[>=]" => date('Y-m-d', time()),
                    "C.fecha_solicitud" => null, // WHERE
                    "C.especialidad"    => $esp
                ]
            ]);

            if (null !== $data) {
                $data = array_map(function ($me) use (&$colors) {
                    $me["color"] = array_pop($colors);

                    return $me;
                }, $data);
            }

            return responseJSON($response, $data);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }
}
