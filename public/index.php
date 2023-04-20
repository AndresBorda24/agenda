<?php
declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

$app = \DI\Bridge\Slim\Bridge::create();

$app->get("/", [\App\Controllers\IndexController::class, "home"]);

$app->run();
