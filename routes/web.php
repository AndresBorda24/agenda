<?php

declare(strict_types=1);

use Slim\App;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Controllers\IndexController;
use App\Middleware\PagoValidoMiddleware;
use App\Controllers\Api\AuthController;
use App\Controllers\Api\PagoController;
use App\Controllers\FilesController;
use App\Controllers\GatewayController;
use App\Controllers\GouMicrositioController;
use App\Middleware\HasActiveCardMiddleware;
use App\Middleware\JsonBodyParserMiddleware;
use App\Middleware\NoPagoMiddleware;
use App\Middleware\OrdenPendienteMiddleware;
use App\Middleware\SetRouteContextMiddleware;
use Slim\Routing\RouteCollectorProxy as Group;

/**
 * Mapea TODAS las rutas `web` de la aplicacion
*/
return function (App $app) {
    $app->group("", function (Group $app) {
        $app->get("/", [IndexController::class, "index"])
            ->setName("index");


        $app->group("", function (Group $app) {
            $app->get("/gateway/{data}/finished", [GatewayController::class, 'returnView'])
                ->setName("gateway.returnUrl");

            $app->get("/home", [IndexController::class, "home"])
                ->setName("home");

            $app->get("/compras", [IndexController::class, "compras"])
                ->setName("compras");

            $app->get("/perfil", [IndexController::class, "profile"])
                ->setName("perfil");

            $app->get("/agenda", [IndexController::class, "agenda"])
                ->setName("agenda");
            // ->add(PagoValidoMiddleware::class);

            $app->get("/mis-citas", [IndexController::class, "citas"])
                ->setName("mis-citas");
            // ->add(PagoValidoMiddleware::class);

            $app->get("/beneficiarios", [IndexController::class, "beneficiarios"])
                ->setName("beneficiarios");
            // ->add(PagoValidoMiddleware::class);

            $app->get("/tramites", [IndexController::class, "tramites"])
                ->setName("tramites");

            $app->get("/activar-tarjeta", [IndexController::class, "activarTarjeta"])
                ->setName("activar-tarjeta")
                ->add(HasActiveCardMiddleware::class)
                ->add(PagoValidoMiddleware::class);

            $app->post("/logout", [AuthController::class, "logout"])
                ->setName("logout");

            $app->group("/planes", function (Group $app) {
                $app->get("", [IndexController::class, "planes"])
                    ->setName("planes")
                    ->add(OrdenPendienteMiddleware::class)
                    ->add(NoPagoMiddleware::class);

                $app->get("/redimir-regalo", [IndexController::class, "planesRegalo"])
                    ->setName("planes.regalo")
                    ->add(NoPagoMiddleware::class);

                $app->get("/fbk", [IndexController::class, "planesResponse"])
                    ->setName("planes.feedback");

                $app->get("/feedback", [PagoController::class, "development"]);
            });

            $app->get("/pagos/gou-micrositio", GouMicrositioController::class)
                ->add(NoPagoMiddleware::class)
                ->setName("pago.gow-micrositio");

            $app->group("/files", function (Group $app) {
                $app->get("/{fileId:[0-9]+}/user-file", [FilesController::class,"userFile"])
                    ->setName("files.user");
            });
        })->add(AuthMiddleware::class);

        $app->group("", function (Group $app) {
            $app->get("/registro", [IndexController::class, "registro"])
                ->setName("registro");

            $app->get("/login", [IndexController::class, "login"])
                ->setName("login");

            $app->get("/reset-password", [IndexController::class, "resetPasswd"])
                ->setName("reset-password");
        })->add(GuestMiddleware::class);

        $app->post(
            "/gateway/webhook",
            [GatewayController::class, 'notificationWebhook']
        )->add(JsonBodyParserMiddleware::class);
        $app->get(
            "/gateway/check-pendientes",
            [GatewayController::class, 'checkPendientes']
        );
    })->add(SetRouteContextMiddleware::class);
};
