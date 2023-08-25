<?php
declare(strict_types=1);

namespace App\Middleware;

use Slim\Psr7\Response as Re;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class NoPlanMiddleware implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        $user = $request->getAttribute("user");
        if (! $user->hasPlan()) {
            return $handler->handle($request);
        }

        return (new Re(302))->withHeader('Location', '/');
    }
}
