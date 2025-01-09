<?php

declare (strict_types=1);

use App\Controllers\Api\AgendaController;
use App\Controllers\Api\AuthController;
use App\Controllers\Api\BeneficiarioController;
use App\Controllers\Api\EpsController;
use App\Controllers\Api\EspecialidadController;
use App\Controllers\Api\ExternalController;
use App\Controllers\Api\GEMAController;
use App\Controllers\Api\MedicosController;
use App\Controllers\Api\OrderController;
use App\Controllers\Api\PagoController;
use App\Controllers\Api\PlanesController;
use App\Controllers\Api\RegaloController;
use App\Controllers\Api\UsuarioController;
use App\Middleware\AuthMiddleware;
use App\Middleware\CorsMiddleware;
use App\Middleware\JsonBodyParserMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy as Group;

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
            $esp->get("/{esp}/get-agenda", [EspecialidadController::class, 'getAgenda']);
            $esp->get("/{esp}/get-available-hours/{fecha}", [EspecialidadController::class, 'getAgendaHours']);
        });

        $api->group("/auth", function (Group $auth) {
            $auth->get("/basic", [UsuarioController::class, "getBasic"]);
            $auth->get("/beneficiarios", [BeneficiarioController::class, "all"]);
            $auth->get("/beneficiario/{doc:[0-9]+}/info", [BeneficiarioController::class, "find"]);
            $auth->post("/beneficiario", [BeneficiarioController::class, "store"]);
            $auth->put("/beneficiario/{id:[0-9]+}/edit", [BeneficiarioController::class, "update"]);
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
        });

        $api->group("/pagos", function (Group $pagos) {
            $pagos->put("/{id:[0-9]+}/set-nomina", [PagoController::class, 'nomina']);
            $pagos->delete("/{id:[0-9]+}/delete", [PagoController::class, "remove"])
                ->add(AuthMiddleware::class)
            ;

            $pagos->group('/order', function (Group $order) {
                $order->get('/user-files', [OrderController::class, 'userFiles'])
                    ->add(AuthMiddleware::class)
                ;
                $order->get('/{id:[0-9]+}/new', [OrderController::class, 'newOrder'])
                    ->add(AuthMiddleware::class)
                ;
                $order->get('/{type:[0-9]+}/check-pendiente', [OrderController::class, 'checkPendiente'])
                    ->add(AuthMiddleware::class)
                ;
                $order->get('/{planId:[0-9]+}/create', [OrderController::class, 'createOrder'])
                    ->add(AuthMiddleware::class)
                ;
                $order->get('/test', [OrderController::class, 'test']);
            })
            ;
        });

        $api->group("/pacientes", function (Group $paciente) {
            $paciente->post("/registro", [UsuarioController::class, 'registro']);
        });

        $api->post("/regalo/{code}/redimir", RegaloController::class)
            ->add(AuthMiddleware::class);

        $api->post("/login", [AuthController::class, 'login']);
        $api->post("/reset-passwd", [UsuarioController::class, 'resetPasswd']);
        $api->post("/start-reset-passwd", [UsuarioController::class, 'startResetPasswd']);
        $api->get("/get-all-eps", EpsController::class);
    })->add(JsonBodyParserMiddleware::class);

    $app->group("/api/external", function (Group $ext) {
        $ext->group('', function (Group $ext) {
            $ext->get("/soporte/{file}", [ExternalController::class, "showSoporte"]);
            $ext->get("/pagos-excel", [ExternalController::class, "getExcelPagos"]);
            $ext->get("/{orderType:[0-9]+}/orders-excel", [ExternalController::class, "getExcelOrders"]);
            $ext->get("/get-planes", [ExternalController::class, "getPlanes"]);
            $ext->get("/{doc}/fetch", [ExternalController::class, "fetch"]);
            $ext->get("/{orderId:[0-9]+}/order-info", [ExternalController::class, "searchOrder"]);
            $ext->get("/pagos-list", [ExternalController::class, "getPagosList"]);
            $ext->get("/{orderType:[0-9]+}/order-list", [ExternalController::class, "getOrdersList"]);
            $ext->post("/create-user", [ExternalController::class, "createUser"]);
            $ext->post("/validate-user", [ExternalController::class, "checkDatos"]);
            $ext->post("/{userId:[0-9]+}/create-pago", [ExternalController::class, "createPago"]);
            $ext->get("/{cc}/search-fidelizado/{tp}", [ExternalController::class, "searchFidelizado"]);
            $ext->post(
                "/{pagoId:[0-9]+}/set-registrado",
                [ExternalController::class, "setRegistradoVal"]
            );
            $ext->options("/{routes:.+}", fn ($response) => $response);
        })->add(CorsMiddleware::class)->add(JsonBodyParserMiddleware::class);

        $ext->group('', function (Group $ext) {
            $ext->get("/{cc}/search-fidelizado/{tp}/gema", [GEMAController::class, "searchFidelizado"]);
            $ext->get("/{cc}/beneficiarios/gema", [GEMAController::class, "getBeneficiarios"]);
        });
    });
};
