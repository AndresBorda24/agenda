<?php
declare(strict_types=1);

use Slim\App;
use App\Controllers\Api\AgendaController;
use App\Controllers\Api\AuthController;
use App\Controllers\Api\EpsController;
use App\Controllers\Api\MedicosController;
use App\Middleware\JsonBodyParserMiddleware;
use Slim\Routing\RouteCollectorProxy as Group;
use App\Controllers\Api\EspecialidadController;
use App\Controllers\Api\PlanesController;
use App\Controllers\Api\UsuarioController;
use App\Middleware\AuthMiddleware;

/**
 * Mapea TODAS las rutas relacionadas con la API
 * La idea es que estos endpoints seran accedidos mediante JS con
 * el uso de funciones como FETCH o AJAX de jQuery
*/
return function(App $app) {
    $app->group("/api", function(Group $api) {
        $api->group("/especialidades", function(Group $esp) {
            $esp->get("/get-all", [EspecialidadController::class, 'getAll']);
            $esp->get("/get-available", [EspecialidadController::class, 'getAvailable']);
            $esp->get("/{esp}/get-agenda", [EspecialidadController::class, 'getAgenda']);
            $esp->get("/{esp}/get-available-hours/{fecha}", [
                EspecialidadController::class, 'getAgendaHours'
            ]);
        });

        $api->group("/agenda", function(Group $agenda) {
            $agenda->get("/mis-citas", [AgendaController::class, "getCitasAgendadas"]);
            $agenda->post("/save", [AgendaController::class, 'save'])
                ->add(JsonBodyParserMiddleware::class);
        })->add(AuthMiddleware::class);

        $api->group("/medicos", function(Group $medicos) {
            $medicos->get("/{esp}/get-available", [MedicosController::class, 'getAvailable']);
        });

        $api->group("/planes", function(Group $medicos) {
            $medicos->get("/get-available", [PlanesController::class, 'getAvailable']);
        });

        $api->group("/pacientes", function(Group $paciente) {
            $paciente->post("/registro", [UsuarioController::class, 'registro']);
        });

        $api->post("/login", [AuthController::class, 'login']);
        $api->get("/get-all-eps", EpsController::class);
    })->add(JsonBodyParserMiddleware::class);
};
