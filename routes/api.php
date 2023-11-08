<?php

declare(strict_types=1);

use Slim\App;
use App\Middleware\AuthMiddleware;
use App\Controllers\Api\EpsController;
use App\Controllers\Api\AuthController;
use App\Controllers\Api\PlanesController;
use App\Controllers\Api\AgendaController;
use App\Controllers\Api\UsuarioController;
use App\Controllers\Api\MedicosController;
use App\Middleware\JsonBodyParserMiddleware;
use Slim\Routing\RouteCollectorProxy as Group;
use App\Controllers\Api\BeneficiarioController;
use App\Controllers\Api\EspecialidadController;
use App\Controllers\Api\MercadoPagoController;
use App\Controllers\Api\PagoController;

/**
 * Mapea TODAS las rutas relacionadas con la API
 * La idea es que estos endpoints seran accedidos mediante JS con
 * el uso de funciones como FETCH o AJAX de jQuery
 */
return function (App $app) {
    $app->group("/api", function (Group $api) {
        $api->group("/especialidades", function (Group $esp) {
            $esp->get("/get-all", [EspecialidadController::class, 'getAll']);
            $esp->get("/get-available", [EspecialidadController::class, 'getAvailable']);
            $esp->get("/{esp}/get-agenda", [EspecialidadController::class, 'getAgenda'] );
            $esp->get("/{esp}/get-available-hours/{fecha}", [EspecialidadController::class, 'getAgendaHours']);
        });


        $api->group("/auth", function (Group $auth) {
            $auth->get("/basic", [UsuarioController::class, "getBasic"]);
            $auth->get("/beneficiarios", [BeneficiarioController::class, "all"]);
            $auth->post("/beneficiario", [BeneficiarioController::class, "store"]);
            $auth->post("/set-card-serial", [UsuarioController::class, "activateCard"]);
            $auth->put("/update-basic", [UsuarioController::class, "update"]);
            $auth->put("/password-update", [UsuarioController::class, "updatePass"]);
        })->add(AuthMiddleware::class);


        $api->group("/agenda", function (Group $agenda) {
            $agenda->get("/mis-citas", [AgendaController::class, "getCitasAgendadas"]);
            $agenda->post("/save", [AgendaController::class, 'save'])
                ->add(JsonBodyParserMiddleware::class);
        })->add(AuthMiddleware::class);


        $api->group("/medicos", function (Group $medicos) {
            $medicos->get("/{esp}/get-available", [MedicosController::class, 'getAvailable']);
        });


        $api->group("/planes", function (Group $planes) {
            $planes->get("/get-available", [PlanesController::class, 'getAvailable']);
            $planes->post("/info-pagos", [PlanesController::class, 'createPreference']);
            $planes->post("/{planId:[0-9]+}/create-preference", [MercadoPagoController::class, 'createPreference']);
        })->add(AuthMiddleware::class);


        $api->group("/pagos", function (Group $pagos) {
            $pagos->put("/{id:[0-9]+}/set-nomina", [PagoController::class, 'nomina']);
            $pagos->delete("/{id:[0-9]+}/delete", [PagoController::class, "remove"]);
        });


        $api->group("/pacientes", function (Group $paciente) {
            $paciente->post("/registro", [UsuarioController::class, 'registro']);
        });


        $api->group("/mp", function (Group $mp) {
            $mp->get("/{id}/preference", [MercadoPagoController::class, "getPref"]);
            $mp->get("/{id}/pago", [MercadoPagoController::class, "getPayment"]);
            $mp->get("/{id}/merch", [MercadoPagoController::class, "getMerch"]);
            $mp->put("/pago/{id}/set-status/{status}", [MercadoPagoController::class, "setPaymentStatus"]);
        });


        $api->post("/login", [AuthController::class, 'login']);
        $api->get("/get-all-eps", EpsController::class);
    })->add(JsonBodyParserMiddleware::class);
};
