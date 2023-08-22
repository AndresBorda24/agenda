<?php
declare(strict_types=1);

use Slim\App;
use App\Controllers\IndexController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Middleware\SetRouteContextMiddleware;
use Psr\Http\Message\ServerRequestInterface;
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
        })->add(AuthMiddleware::class);

        $app->group("", function(Group $app) {
            $app->get("/registro", [IndexController::class, "registro"])
                ->setName("registro");
            $app->get("/login", [IndexController::class, "login"])
                ->setName("login");
        })->add(GuestMiddleware::class);

        $app->get("/planes", [IndexController::class, "planes"]);
        $app->get("/planes/feedback", function(ServerRequestInterface $request) {
            $q = $request->getQueryParams();

            echo "<pre>";
            print_r($q);
            die;
        });
    })->add(SetRouteContextMiddleware::class);

};
