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

class HasActiveCardMiddleware implements MiddlewareInterface
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

        // Si aun no ha activado una tarjeta
        if ($user->hasPago() && $user->getPago()?->tarjeta === null) {
           return $handler->handle($request);
        }

        return (new Response(302))
            ->withHeader('Location', $this->routerParser->urlFor("home"));
    }
}
