<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Auth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

use function App\responseJSON;

class AuthController
{
    public function __construct(
        private readonly Auth $auth
    ) {}

    public function login(
        App $app,
        Request $request,
        Response $response
    ): Response {
        try {
            $data = $request->getParsedBody();

            if (! $this->auth->attemptLogin($data)) {
                throw new \Exception("Datos invalidos...");
            }

            return responseJSON($response, [
                "status" => true,
                "redirect" => $app->getRouteCollector()->getRouteParser()->urlFor("home"),
            ]);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
            ], 422);
        }
    }

    public function logout(Response $response): Response
    {
        $this->auth->logOut();

        return $response
            ->withStatus(302)
            ->withHeader("Location", "/login");
    }
}
