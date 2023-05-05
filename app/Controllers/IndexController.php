<?php
declare(strict_types=1);

namespace App\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController
{
    function __construct(
        private PhpRenderer $view
    ){}

    public function home(Request $request, Response $response): Response
    {
        return $this->view->render($response, "index.php");
    }
}
