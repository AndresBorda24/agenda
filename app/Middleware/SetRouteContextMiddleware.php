<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Views;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

/**
 * Establece el contexto de la ruta para que, en las vistas,
 * se puedan generar links y comprobar rutas.
*/
class SetRouteContextMiddleware implements MiddlewareInterface
{
    public function __construct(
        private Views $views
    ) {}

    public function process(Request $request, RequestHandler $handler): Response
    {
        $this->views->setRouteContext($request);

        return $handler->handle($request);
    }
}
