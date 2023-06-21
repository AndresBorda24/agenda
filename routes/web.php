<?php
declare(strict_types=1);

use Slim\App;
use App\Controllers\IndexController;
use App\Middleware\SetRouteContextMiddleware;
use Slim\Routing\RouteCollectorProxy as Group;

/**
 * Mapea TODAS las rutas `web` de la aplicacion
*/
return function(App $app) {
    $app->group("", function(Group $app) {
        $app->get("/", [IndexController::class, "home"]);
        $app->get("/registro", [IndexController::class, "registro"])
            ->setName("vip.registro");
        $app->get("/registro-usuarios", [IndexController::class, "registroUsuario"])
            ->setName("pacientes.registro");

        $app->get("/login", [IndexController::class, "login"])
            ->setName("login");
    })->add(SetRouteContextMiddleware::class);
};
