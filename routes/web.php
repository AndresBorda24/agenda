<?php
declare(strict_types=1);

use App\Controllers\Api\PlanesController;
use Slim\App;
use App\Controllers\IndexController;
use App\Controllers\MpController;
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
            $app->redirect("/", "/agenda", 301);
            $app->get("/agenda", [IndexController::class, "agenda"])
                ->setName("agenda");

            $app->post("/logout", [
                \App\Controllers\Api\AuthController::class, "logout"
            ])->setName("logout");


            $app->group("/planes", function(Group $app) {
                $app->get("", [IndexController::class, "planes"])
                    ->setName("planes");
                $app->get("/feedback", [MpController::class, "finish"]);
            });
        })->add(AuthMiddleware::class);

        $app->group("", function(Group $app) {
            $app->get("/registro", [IndexController::class, "registro"])
                ->setName("registro");
            $app->get("/login", [IndexController::class, "login"])
                ->setName("login");
        })->add(GuestMiddleware::class);
    })->add(SetRouteContextMiddleware::class);

};
