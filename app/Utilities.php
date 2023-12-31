<?php
declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface as Response;

if (! function_exists('App\responseJSON')) {
    /**
     * Da formato a la respuesta para devolverla como JSON
    */
    function responseJSON(Response $response, mixed $data, int $statusCode = 201): Response
    {
        $payload = json_encode(
            $data,
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_HEX_APOS | JSON_THROW_ON_ERROR
        );
        $response->getBody()->write($payload);
        return $response
                ->withHeader("Content-Type", "application/json")
                ->withStatus($statusCode);
    }
}

if (! function_exists('App\uppercase')) {
    /**
     * Hace un trim a la cadena de texto y la convierte en Mayusculas.
    */
    function uppercase(?string $string): ?string
    {
        if ($string === null) return null;

        return mb_strtoupper(
            trim($string),
            "UTF-8"
        );
    }
}

/*
 * dd() with headers
 */
if (!function_exists('ddh')) {
    function ddh($var){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dump($var);
        die;
    }
}

/*
 * dump() with headers
 */
if (!function_exists('dumph')) {
    function dumph($var){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dump($var);
    }
}
