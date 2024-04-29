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

use function App\responseJSON;

class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly Auth $auth,
    ) {}

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        if ($user = $this->auth->user()) {
            return $handler->handle($request->withAttribute('user', $user));
        }

        $context = RouteContext::fromRequest($request);
        $isAPI = preg_match("#^/api/.*#", $request->getUri()->getPath());
        if ($isAPI) {
            return responseJSON(new Response(401), [
                "location" => $context->getRouteParser()->urlFor("login")
            ], 401);
        }

        return (new Response(302))->withHeader('Location', $context->getRouteParser()->urlFor("login"));
    }
}
