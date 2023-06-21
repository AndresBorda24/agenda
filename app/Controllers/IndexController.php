<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Views;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController
{
    function __construct(
        private Views $view,
    ){}

    public function home(Request $request, Response $response): Response
    {
        return $this
            ->view
            ->render($response, "agenda.php");
    }

    public function registro(Request $request, Response $response): Response
    {
        return $this
            ->view
            ->render($response, "registro-vip/index.php");
    }

    public function registroUsuario(Request $request, Response $response): Response
    {
        return $this
            ->view
            ->render($response, "registro-usuarios.php");
    }

    public function login(Request $request, Response $response): Response
    {
        return $this
            ->view
            ->render($response, "login/index.php");
    }
}
