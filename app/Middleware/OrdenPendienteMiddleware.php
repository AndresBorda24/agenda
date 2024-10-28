<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Auth;
use App\Enums\MpStatus;
use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

use function App\responseJSON;

class OrdenPendienteMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        /** @var \App\Contracts\UserInterface $user */
        $user = $request->getAttribute('user');
        if (!$user) {
            throw new \RuntimeException(
                "No user instance found. Maybe you forgot to set the AuthMiddleware"
            );
        }

        if ($user->getOrder()->status === MpStatus::PENDIENTE) {
            $data = base64_encode(json_encode([
                "ref" => $user->getOrder()->id
            ]));

            $context = RouteContext::fromRequest($request);
            return (new Response(302))
                ->withHeader("Location", $context->getRouteParser()->urlFor("gateway.returnUrl", [
                    "data" => $data
                ]));
        }

        return $handler->handle($request);
    }
}
