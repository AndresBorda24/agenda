<?php
declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class GouMicrositioController
{
    /** Guardamos un pago como "pendiente" para tener un poco de control */
    public function __invoke(Response $response): Response
    {
        return $response
            ->withHeader("location", "https://micrositios.goupagos.com.co/clinica-asotrauma-ma")
            ->withStatus(302);
    }
}
