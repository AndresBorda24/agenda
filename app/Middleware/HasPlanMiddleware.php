<?php
declare(strict_types=1);

namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class HasPlanMiddleware implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $user = $request->getAttribute("user");
        if ($user->hasPlan()) {
            return $handler->handle($request);
        }

        return (new Response(302))->withHeader('Location', '/planes');
    }
}
