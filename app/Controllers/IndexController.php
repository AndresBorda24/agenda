<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Auth;
use App\Views;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController
{
    function __construct(
        private Views $view,
        private Auth $auth
    ){}

    public function home(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "home/index.php");
    }

    public function profile(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "profile/index.php");
    }

    public function agenda(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "agenda/index.php");
    }

    public function registro(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "registro/index.php");
    }

    public function login(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "login/index.php");
    }

    public function beneficiarios(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "beneficiarios/index.php");
    }

    public function planes(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "planes/index.php");
    }

    public function planesResponse(Request $request, Response $response): Response
    {
        $data = $request->getQueryParams();
        return $this
            ->view
            ->render($response, "planes/finished.php", $data);
    }
}
