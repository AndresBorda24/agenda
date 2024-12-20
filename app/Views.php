<?php

declare(strict_types=1);

namespace App;

use App\Contracts\UserInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\RouteInterface;
use Slim\Routing\RouteContext;
use Slim\Routing\RouteParser;
use Slim\Views\PhpRenderer;

use function App\vite;

class Views extends PhpRenderer
{
    public Auth $auth;
    public readonly Config $config;

    private ?RouteInterface $route = null;
    private ?RouteParser $routeParser = null;

    public function __construct(Config $config, Auth $auth)
    {
        $this->auth = $auth;
        $this->config = $config;
        parent::__construct($this->config->get("assets.templates"));
    }

    /**
     * Debido a que se emplea encore para usar librerias de JS, se deben cargar
     * los archivos js y css correspondientes y las rutas estan especificadas en
     * en entrypoints.json.
     *
     * @param string $name El nombre de la carpeta donde estan los archivos en public/build
     */
    public function loadAssets(string $name): string
    {
        /* Ruta del archivo entrypoints.json */
        $_ = file_get_contents($this->config->get("assets.entrypoints"));
        $ep = @json_decode($_, true);

        /** En dado caso que la ruta no exista */
        if (!(bool) $ep) {
            return "";
        }

        /**
         * En el archivo de entrypoints esta folder(name)/app para
         * identificar los archivos de cada vista.
         */
        $k = $name;
        if (!array_key_exists($k, $ep["entrypoints"])) {
            return "";
        }

        /**
         * Tags `script` y `link`
         */
        $tags = "";

        /**
         * Tags para los diferentes tipos de assets
         */
        $types = [
            "css" => "<link rel=\"stylesheet\" type=\"text/css\" href=\"%s\">",
            "js" =>
                "<script src=\"%s\" type=\"text/javascript\" defer></script>",
        ];

        foreach ($ep["entrypoints"][$k] as $type => $assets) {
            if (!array_key_exists($type, $types)) {
                continue;
            }

            foreach ($assets as $asset) {
                $tags .= sprintf($types[$type], $asset);
            }
        }

        return $tags;
    }

    /**
     * Debido a que se emplea encore para usar librerias de JS, se deben cargar
     * los archivos js y css correspondientes y las rutas estan especificadas en
     * en entrypoints.json.
     *
     * @param string $name El nombre de la carpeta donde estan los archivos en public/build
     */
    public function loadAssetsVite(string $name): string
    {
        if ($this->config->get('app.env', 'dev') !== 'prod') {
            return <<<HTML
            <script type="module" src="http://localhost:5173/@vite/client"></script>
            <script type="module" src="http://localhost:5173/assets/$name"></script>
            HTML;
        }

        /* Ruta del archivo entrypoints.json */
        $_ = file_get_contents($this->config->get("assets.entrypoints"));
        $ep = @json_decode($_, true);

        /** En dado caso que la ruta no exista */
        if (!(bool) $ep) {
            return "";
        }
        return vite($ep, 'assets/'.$name, $this->config->get("app.base"));
    }

    /**
     * Setea a `route` y `routeParser`, importantes si se quieren generar
     * links
     */
    public function setRouteContext(ServerRequestInterface $request): void
    {
        $context = RouteContext::fromRequest($request);

        $this->route = $context->getRoute();
        $this->routeParser = $context->getRouteParser();
    }

    /**
     * Genera el link para el nombre de una ruta
     */
    public function link(string $name, array $params = []): string
    {
        if (!isset($this->routeParser)) {
            throw new \RuntimeException(
                "No Route. You may have forgotten to use setRouteContext"
            );
        }

        return $this->routeParser->urlFor($name, $params);
    }

    /**
     * Retorna TRUE o FALSE dependiendo si el nombre de la ruta corresponde
     * al nombre de la ruta actual
     */
    public function isRoute(string $name): bool
    {
        if (!isset($this->routeParser)) {
            throw new \RuntimeException(
                "No Route. You may have forgotten to use setRouteContext"
            );
        }

        return $this->route->getName() === $name;
    }

    /**
     * Devuelve la ruta `absoluta` para un archivo $asset
     */
    public function asset(string $asset): string
    {
        return $this->config->get("app.url") . $asset;
    }

    /**
     * Retorna una instancia de auth para tener control de la sesion en el
     * renderizado.
     */
    public function auth(): Auth
    {
        return $this->auth;
    }

    /**
     * Helper para acceder al usuario de session mas rapidamente
     */
    public function user(): ?UserInterface
    {
        return $this->auth->user();
    }
}
