<?php
declare(strict_types=1);

namespace App\Middleware;

use Slim\App;
use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Interfaces\RouteParserInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class PagoValidoMiddleware implements MiddlewareInterface
{
    private RouteParserInterface $routerParser;

    public function __construct(App $app)
    {
        $this->routerParser = $app->getRouteCollector()->getRouteParser();
    }

    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        /** @var \App\Contracts\UserInterface $user */
        $user = $request->getAttribute("user");

        // Si no tiene ningun plan
        if (! $user->hasPago()) {
            return (new Response(302))
                ->withHeader('Location', $this->routerParser->urlFor("planes"));
        }

        // Si tiene un plan y NO esta pendiente
        if ($user->hasPago() && $user->pago->isValid()) {
            return $handler->handle($request);
        }

        return (new Response(302))
            ->withHeader('Location', $this->routerParser->urlFor("planes"));
    }
}
