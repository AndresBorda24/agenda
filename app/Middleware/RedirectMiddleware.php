<?php
declare(strict_types = 1);

namespace App\Middleware;

use App\Auth;
use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

use function App\responseJSON;

class RedirectMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly Auth $auth,
    ) {}

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $path = $request->getUri()->getPath();
        $method = $request->getMethod();
        $newURL = "https://fidelizacion.asotrauma.com.co";

        if ($method != "GET") {
            return responseJSON(new Response(401), [
                "location" => $newURL
            ], 401);
        }

        return (new Response)
            ->withHeader("location", "$newURL$path")
            ->withStatus(301);
    }
}
