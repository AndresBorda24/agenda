<?php
declare(strict_types=1);

use Slim\App;
use App\Controllers\IndexController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\SetRouteContextMiddleware;
use Slim\Routing\RouteCollectorProxy as Group;

/**
 * Mapea TODAS las rutas `web` de la aplicacion
*/
return function(App $app) {
    $app->group("", function(Group $app) {
        $app->group("", function(Group $app) {
            $app->get("/", [IndexController::class, "home"])
                ->setName("home");
            $app->get("/agenda", [IndexController::class, "agenda"])
                ->setName("agenda");

            $app->get("/logout", [
                \App\Controllers\Api\AuthController::class, "logout"
            ])->setName("logout");
        })->add(AuthMiddleware::class);

        $app->group("", function(Group $app) {
            $app->get("/registro", [IndexController::class, "registro"])
                ->setName("vip.registro");
            $app->get("/registro-usuarios", [IndexController::class, "registroUsuario"])
                ->setName("pacientes.registro");

            $app->get("/login", [IndexController::class, "login"])
                ->setName("login");
        })->add(GuestMiddleware::class);
    })->add(SetRouteContextMiddleware::class);
};
