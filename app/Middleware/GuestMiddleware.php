<?php
declare(strict_types = 1);

namespace App\Middleware;

use App\Auth;
use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

class GuestMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly Auth $auth,
    ) {}

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        if ($this->auth->user()) {
            $context = RouteContext::fromRequest($request);

            return (new Response)
                ->withStatus(302)
                ->withHeader('Location', $context->getRouteParser()->urlFor("home"));
        }

        return $handler->handle($request);
    }
}
