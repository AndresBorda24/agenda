<?php
declare(strict_types=1);

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\Api\EspecialidadController;
use App\Controllers\Api\MedicosController;

require __DIR__ . "/../vendor/autoload.php";

// Se carga la configuracion del .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

// Se crea el contanedor con algunas definiciones
$c = new \DI\Container(require __DIR__ . "/../config/ContainerBindings.php");
$app = \DI\Bridge\Slim\Bridge::create($c);

$app->get("/", [\App\Controllers\IndexController::class, "home"]);
$app->group("/api", function(RouteCollectorProxy $group) {
    $group->get("/especialidades/get-all", [EspecialidadController::class, 'getAll']);
    $group->get("/especialidades/get-available", [EspecialidadController::class, 'getAvailable']);
    $group->get("/especialidades/{esp}/get-agenda", [EspecialidadController::class, 'getAgenda']);
    $group->get("/especialidades/{esp}/get-available-hours/{fecha}", [
        EspecialidadController::class, 'getAgendaHours'
    ]);
    $group->get("/medicos/{esp}/get-available", [MedicosController::class, 'getAvailable']);
});

$app->run();
