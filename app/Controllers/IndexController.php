<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Auth;
use App\Views;
use Psr\Http\Message\ResponseInterface as Response;

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

    public function agenda(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "agenda/indes.php");
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
}
