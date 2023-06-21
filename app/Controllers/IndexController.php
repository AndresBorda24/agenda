<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Views;
use Psr\Http\Message\ResponseInterface as Response;

class IndexController
{
    function __construct(
        private Views $view,
    ){}

    public function home(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "home/index.php");
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
            ->render($response, "registro-vip/index.php");
    }

    public function registroUsuario(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "registro-usuarios/index.php");
    }

    public function login(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "login/index.php");
    }
}
