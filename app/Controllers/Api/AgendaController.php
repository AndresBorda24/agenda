<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use function App\responseJSON;

use Medoo\Medoo;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AgendaController {
    public function __construct(
        private Medoo $db
    ) {}

    public function save(Request $request, Response $response ): Response
    {
        try {
            // Informacion de la solicitud
            $body = $request->getParsedBody();

            // Obtener el usuario
            $user = $this->db->get("pacientes", "*", [ "id" => $body["user"] ]);
            if (null === $user)
                throw new \RuntimeException("Usuario no encontrado");

            // Obtener la informacion de la agenda
            $agenda = $this->db->get("citas_web", [
                "fecha_programada", "hora_programada", "medico"
            ], [
                "id" => $body["__id"]
            ]);
            if (null === $agenda)
                throw new \RuntimeException("Agenda no encontrada");

            // Realizar el update
            $this->db->update("citas_web", [
                "hora_agendada"     => $agenda["hora_programada"],
                "fecha_agendada"    => $agenda["fecha_programada"],
                "medico_agendado"   => $agenda["medico"],
                "paciente_ape1"     => $user["ape1"],
                "paciente_ape2"     => $user["ape2"],
                "paciente_nom1"     => $user["nom1"],
                "paciente_nom2"     => $user["nom2"],
                "paciente_id"       => $user["id"],
                "paciente_ciudad"   => $user["ciudad"],
                "eps"               => $user["eps"],
                "solicitada"        => 1,
                "paciente_telefono" => $user["telefono"],
                "paciente_direccion"=> $user["direccion"]
            ], [
                "id" => $body["__id"]
            ]);

            return responseJSON($response, true);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function getCitasAgendadas(Response $response ): Response
    {
        try {
            $data = $this->db->select("citas_web (C)", [
                "[>]medicos (M)" => ["medico" => "codigo"],
                "[>]especialidad (E)" => "especialidad"
            ], [
                "E.nombre (especialidad)",
                "M.nombre (medico)",
                "C.fecha_programada (fecha)",
                "C.hora_programada (hora)"
            ], [
                "C.paciente_id" => 1,
                "ORDER" => [
                    "C.fecha_programada",
                    "C.hora_programada"
                ]
            ]);

            return responseJSON($response, $data);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
