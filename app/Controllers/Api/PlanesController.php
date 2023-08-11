<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use function App\responseJSON;

use Medoo\Medoo;
use Psr\Http\Message\ResponseInterface as Response;

class PlanesController
{
    public function __construct(
        private Medoo $db
    ){}

    /** Obtiene todas las especialidades con citas disponibles */
    public function getAvailable(Response $response): Response
    {
        try {
            $data = [];
            $this->db->select("planes", "*", [
                "status" => true,
                "ORDER" => [
                    "valor" => "ASC"
                ]
            ], function($plan) use (&$data) {
                $plan["valor_formatted"] = number_format(
                    $plan["valor"],
                    thousands_separator: '.'
                );

                array_push($data, $plan);
            });

            return responseJSON($response, $data);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }
}
