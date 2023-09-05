<?php
declare(strict_types=1);

use Slim\App;
use App\Controllers\MpController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Controllers\IndexController;
use App\Middleware\HasPlanMiddleware;
use App\Controllers\Api\AuthController;
use App\Middleware\NoPlanMiddleware;
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
                ->setName("agenda")
                ->add(HasPlanMiddleware::class);

            $app->post("/logout", [AuthController::class, "logout"])
                ->setName("logout");

            $app->get("/planes/pending", [MpController::class, "pending"])
                ->setName("planes.pending");

            $app->group("/planes", function(Group $app) {
                $app->get("", [IndexController::class, "planes"])
                    ->setName("planes");

                $app->get("/feedback", [MpController::class, "finish"]);
            })->add(NoPlanMiddleware::class);
        })->add(AuthMiddleware::class);

        $app->group("", function(Group $app) {
            $app->get("/registro", [IndexController::class, "registro"])
                ->setName("registro");

            $app->get("/login", [IndexController::class, "login"])
                ->setName("login");
        })->add(GuestMiddleware::class);
    })->add(SetRouteContextMiddleware::class);
};
