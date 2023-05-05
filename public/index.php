<?php
declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

// Se carga la configuracion del .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

// Se crea el contanedor con algunas definiciones
$c = new \DI\Container(require __DIR__ . "/../config/ContainerBindings.php");
$app = \DI\Bridge\Slim\Bridge::create($c);

$app->get("/", [\App\Controllers\IndexController::class, "home"]);

$app->run();
