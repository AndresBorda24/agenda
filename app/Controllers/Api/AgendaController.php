<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use function App\responseJSON;

use Medoo\Medoo;
use App\Contracts\UserInterface;
use App\DataObjects\NuevaCitaMsg;
use App\Services\MessageService;
use App\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AgendaController {
    public function __construct(
        private Medoo $db,
        private MessageService $messageService
    ) {}

    public function save(Request $request, Response $response, UserInterface $user): Response
    {
        try {
            // Informacion de la solicitud
            $body = $request->getParsedBody();
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
                "paciente_ape1"     => $user->info->ape1,
                "paciente_ape2"     => $user->info->ape2,
                "paciente_nom1"     => $user->info->nom1,
                "paciente_nom2"     => $user->info->nom2,
                "paciente_id"       => $user->id(),
                "paciente_ciudad"   => $user->info->ciudad,
                "eps"               => $user->info->eps,
                "solicitada"        => 1,
                "paciente_telefono" => $user->info->telefono,
                "paciente_direccion"=> $user->info->direccion
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

    public function getCitasAgendadas(Response $response, UserInterface $user): Response
    {
        try {
            $data = $this->db->select("citas_web (C)", [
                "[>]medicos (M)" => ["medico" => "codigo"],
                "[>]especialidad (E)" => "especialidad"
            ], [
                "C.id",
                "E.nombre (especialidad)",
                "M.nombre (medico)",
                "C.fecha_programada (fecha)",
                "C.hora_programada (hora)"
            ], [
                "C.paciente_id" => $user->id(),
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

    public function notificarNuevaCita(Request $request, Response $response, User $user): Response
    {
        $data = NuevaCitaMsg::fromArray($request->getParsedBody());
        $msg  = $this->messageService->msgNuevaCita($data);
        $this->messageService->sendMessage($user->info->telefono, $msg);

        return responseJSON($response, true);
    }
}
