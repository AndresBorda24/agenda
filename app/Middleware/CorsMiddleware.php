<?php
declare(strict_types = 1);

namespace App\Middleware;

use App\Config;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class CorsMiddleware implements MiddlewareInterface
{
    private array $allowedOrigins;

    public function __construct(Config $config)
    {
        $this->allowedOrigins = match ($config->get('app.env', 'prod')) {
            'dev' => ['http://fidelizacion-registro.test'],
            default => ['https://intranet.asotrauma.com.co']
        };
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = $handler->handle($request);
        $origin   = @$request->getHeader("Origin")[0];

        if (in_array($origin, $this->allowedOrigins)) {
            $response = $response
                ->withHeader('Access-Control-Allow-Origin', $origin)
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, ngrok-skip-browser-warning')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, OPTIONS, DELETE');
        }

        return $response;
    }
}
