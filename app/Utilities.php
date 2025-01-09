<?php
declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface as Response;

if (!function_exists('App\responseJSON')) {
    /**
     * Da formato a la respuesta para devolverla como JSON
     */
    function responseJSON(
        Response $response,
        mixed $data,
        int $statusCode = 200
    ): Response {
        $payload = json_encode(
            $data,
            JSON_HEX_TAG |
                JSON_HEX_AMP |
                JSON_HEX_QUOT |
                JSON_HEX_APOS |
                JSON_THROW_ON_ERROR
        );
        $response->getBody()->write($payload);
        return $response
            ->withHeader("Content-Type", "application/json")
            ->withStatus($statusCode);
    }
}

if (!function_exists("App\uppercase")) {
    /**
     * Hace un trim a la cadena de texto y la convierte en Mayusculas.
     */
    function uppercase(?string $string): ?string
    {
        if ($string === null) {
            return null;
        }

        return mb_strtoupper(trim($string), "UTF-8");
    }
}

if (!function_exists("App\createInstance")) {
    /**
     * Este helper permite la creacion de una clase a partir de un array de
     * argumentos que se emplea como parametros.
     */
    function createInstance(string $class, array $params = [])
    {
        return (new \ReflectionClass($class))->newInstanceArgs($params);
    }
}

/*
 * dd() with headers
 */
if (!function_exists("ddh")) {
    function ddh($var)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: *");
        dump($var);
        die();
    }
}

/**
 * Determina si el usuario esta ingresando desde la red de la clinia o no
 * @param string $ip Direccion a validar
 */
if (!function_exists("isLocalIp")) {
    function isLocalIp(string $ip)
    {
        $LOCAL_IP = [
            "190.71.235.38",
            "127.0.0.1", // Para el desarrollo local
        ];

        return in_array($ip, $LOCAL_IP);
    }
}

/*
 * dump() with headers
 */
if (!function_exists("dumph")) {
    function dumph($var)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Allow-Headers: *");
        dump($var);
    }
}

if (!function_exists('App\vite')) {
    /**
     * Esta funcion carga los archivos necesarios dependiendo del manifest
     * generado por vite
     */
    function vite(array $entrtyPoints, string $entry, string $base = ""): string
    {
        $jsTags = [];
        $cssTags = [];

        ["js" => $js, "css" => $css] = load(
            $entrtyPoints,
            $entry,
            false,
            $base
        );
        array_push($jsTags, ...$js);
        array_push($cssTags, ...$css);

        if (array_key_exists("imports", $entrtyPoints[$entry])) {
            foreach ($entrtyPoints[$entry]["imports"] as $import) {
                ["js" => $js, "css" => $css] = load(
                    $entrtyPoints,
                    $import,
                    true,
                    $base
                );
                array_push($jsTags, ...$js);
                array_push($cssTags, ...$css);
            }
        }

        return implode("\n", $cssTags) . "\n" . implode("\n", $jsTags) . "\n";
    }

    /**
     * Obtiene los JS y los CSS de cierta entrada para los assets
     *
     * @param bool $isImport Determina si la entrada es un import dinamico
     * @return array Un array con las tags de los archivos js y css
     */
    function load(
        array $entrtyPoints,
        string $entry,
        bool $isImport = false,
        string $base = ""
    ): array {
        if (!array_key_exists($entry, $entrtyPoints)) {
            throw new \Exception(
                "Error cargando asset. Entry: $entry no existe"
            );
        }

        $jsTags = [];
        $cssTags = [];

        $_e = $entrtyPoints[$entry];
        $js = "<script type=\"module\" src=\"$base/%s\"></script>";
        $css = "<link rel=\"stylesheet\" href=\"$base/%s\" />";

        if (preg_match("/.js$/", $_e["file"]) === 1) {
            $jsTags[] = sprintf(
                $isImport
                    ? "<link rel=\"modulepreload\" href=\"$base/%s\" />"
                    : $js,
                $_e["file"]
            );
        } else {
            $cssTags[] = sprintf($js, $_e["file"]);
        }

        if (array_key_exists("css", $_e)) {
            foreach ($_e["css"] as $cssFile) {
                $cssTags[] = sprintf($css, $cssFile);
            }
        }

        return ["js" => $jsTags, "css" => $cssTags];
    }
}


if (! function_exists('App\iva')) {
    /**
     * Calcula el valor del iva de una cantidad dada.
     * @return float Valor de iva redondeado a un máximo de 2 decimales.
     */
    function iva(float $value, bool $included = true): float
    {
        $IVA = 19;

        if ($included) {
            $valNoIva = $value / ($IVA / 100 + 1);
            return $value - round($valNoIva, 2);
        }

        return $value / 100 * $IVA;
    }
}

if (! function_exists('App\sanitizeString')) {
    function sanitizeString(string $str): string
    {
        return trim(preg_replace("/[^\p{L}\p{N}\s]+/u", '', $str));
    }
}
