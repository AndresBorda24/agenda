<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Models\Usuario;
use Psr\Http\Message\ResponseInterface as Response;
use App\Enums\TipoBusquedaFidelizado;
use Spatie\ArrayToXml\ArrayToXml;

class GEMAController
{
    public function __construct(private Usuario $usuario) {}

    /** Busca informacion de un fidelizado si existe y la retorna como un XML */
    public function searchFidelizado(Response $response, string $cc, string $tp): Response
    {
        $type = TipoBusquedaFidelizado::tryFrom($tp);
        if ($type === null) throw new \Exception("Search Type unknown.");

        @[
            'type'    => $type,
            'data'    => $data,
            'titular' => $titular
        ] = $this->usuario->searchfidelizado($type, $cc);

        $xml = match ($type) {
            'T' => array_merge($data, ['tipo_usuario' => $type]),
            'B' => array_merge($titular, ['tipo_usuario' => $type]),
            default => ['tipo_usuario' => '']
        };

        $response->getBody()->write(ArrayToXml::convert(['data' => $xml]));
        return $response->withHeader('Content-Type', 'application/xml');
    }

    public function getBeneficiarios(Response $response, string $cc): Response
    {
        $data = $this->usuario->getBeneficiariosFidelizados(['F.documento' =>  $cc]);
        // $data = (count($data) === 0) ? ['x' => null] : $data;

        $response->getBody()->write(ArrayToXml::convert(['data' => $data]));
        return $response->withHeader('Content-Type', 'application/xml');
    }
}
