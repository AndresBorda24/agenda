<?php
declare(strict_types=1);

use App\ErrorRenderer\HtmlErrorRenderer;
use App\Middleware\StartSessionsMiddleware;
use Psr\Log\LoggerInterface;

require __DIR__ . "/../vendor/autoload.php";

/**
 * Fecha - Hora | Colombia
 */
date_default_timezone_set('America/Bogota');

/**
 * Carga las rutas web
 * @var Callable
 * @return void
*/
$web = require __DIR__ . "/../routes/web.php";

/**
 * Carga los endpionts de la API
 * @var Callable
 * @return void
*/
$api = require __DIR__ . "/../routes/api.php";

// Se carga la configuracion del .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

/* -----------------------------------------------------------------------------
| Se configura el contenedor.
+ ------------------------------------------------------------------------------
*/
$c = new \DI\Container(require __DIR__ . "/../config/ContainerBindings.php");
$app = \DI\Bridge\Slim\Bridge::create($c);
$config = $c->get(\App\Config::class);
$logger = $c->get(LoggerInterface::class);

/* -----------------------------------------------------------------------------
| Cargamos las rutas
+ ------------------------------------------------------------------------------
*/
$app->setBasePath($config->get('app.base'));
// Esto está aquí por la redirección que se hizo de panelusuario a fidelizacion
// $app->add(App\Middleware\RedirectMiddleware::class);
$app->add(StartSessionsMiddleware::class);
$web($app);
$api($app);

/* -----------------------------------------------------------------------------
|  Errores
+ ------------------------------------------------------------------------------
*/
$errorMiddleware = ($config->get("app.env") === "prod")
    ? $app->addErrorMiddleware(false, true, false, $logger)
    : $app->addErrorMiddleware(true, true, false, $logger);

$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->registerErrorRenderer("text/html", HtmlErrorRenderer::class);

$app->run();
