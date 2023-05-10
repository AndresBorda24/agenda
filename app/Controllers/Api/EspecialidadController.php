<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use function App\responseJSON;

use Medoo\Medoo;
use Psr\Http\Message\ResponseInterface as Response;

class EspecialidadController
{
    public function __construct(
        private Medoo $db
    ){}

    /** Obtiene todas las Especialidades */
    public function getAll(Response $response): Response
    {
        try {
            $data = $this->db->select('especialidad', ['especialidad', 'nombre']);

            return responseJSON($response, $data);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }

    /** Obtiene todas las especialidades con citas disponibles */
    public function getAvailable(Response $response): Response
    {
        try {
            $data = $this->db->select('citas_web (C)', [
                "[>]especialidad (E)" => ["especialidad"] // JOIN
            ],[
                '@C.especialidad', 'E.nombre' // COLUMNAS
            ],[
                "fecha_programada[>=]" => date('Y-m-d', time()),
                "C.fecha_solicitud"    => null, // WHERE
                "solicitada"           => 0, // WHERE
                "agendada"             => 0
            ]);

            return responseJSON($response, $data);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }

    /** Obtiene todas las especialidades con citas disponibles */
    public function getAgenda(Response $response, string $esp): Response
    {
        try {
            $data = $this->db->select('citas_web', [
                'fecha_programada', 'medico' // COLUMNAS
            ],[
                "AND" => [
                    "solicitada"       => 0,
                    "agendada"         => 0,
                    "especialidad"    => $esp,
                    "fecha_programada[>=]" => date('Y-m-d', time())
                ]
            ]);

            $data = array_reduce($data, function($c, $a) {
                if (! array_key_exists($a['fecha_programada'], $c)) {
                    $c[$a['fecha_programada']] = [];
                }

                if(! in_array($a['medico'], $c[$a['fecha_programada']])) {
                    $c[$a['fecha_programada']][] = $a['medico'];
                }

                return $c;
            }, []);

            return responseJSON($response, $data);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }

    /** Obtiene todas las especialidades con citas disponibles */
    public function getAgendaHours(
        Response $response,
        string $esp,
        string $fecha
    ): Response {
        try {
            $data = $this->db->select('citas_web', [
                'hora_programada', 'medico', 'id' // COLUMNAS
            ],[
                "AND" => [
                    "especialidad"     => $esp, // WHERE
                    "fecha_programada" => $fecha, // WHERE
                    "solicitada"       => 0,
                    "agendada"         => 0
                ],
                "ORDER" => "hora_programada"
            ]);

            $data = array_reduce($data, function($c, $a) {
                if (! array_key_exists($a['medico'], $c)) {
                    $c[$a['medico']] = [];
                }

                if(! in_array($a['hora_programada'], $c[$a['medico']])) {
                    $c[$a['medico']][] = [
                        "hora" => $a['hora_programada'],
                        "__id" => $a['id']
                    ];
                }
                return $c;
            }, []);

            return responseJSON($response, $data);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }
}
