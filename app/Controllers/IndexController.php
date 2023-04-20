<?php
declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class IndexController
{
    public function home(Request $request, Response $response): Response
    {
        $renderer = new PhpRenderer(__DIR__ . "/../../src/views");
        return $renderer->render($response, "index.php");
    }
}
