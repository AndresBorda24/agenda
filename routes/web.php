<?php
declare(strict_types=1);

use Slim\App;
use App\Controllers\IndexController;

/**
 * Mapea TODAS las rutas `web` de la aplicacion
*/
return function(App $app) {
    $app->get("/", [ IndexController::class, "home" ]);
    $app->get("/registro", [ IndexController::class, "registro" ]);
};
