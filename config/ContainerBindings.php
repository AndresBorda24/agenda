<?php
declare(strict_types=1);

use function DI\create;

use App\Config;
use Medoo\Medoo;
use Slim\Views\PhpRenderer;
use App\DataObjects\SessionConfig;
use UltraMsg\WhatsAppApi;

return [
    Config::class => create()
        ->constructor(require __DIR__ . "/config.php"),

    PhpRenderer::class => fn(Config $c) =>
        new PhpRenderer($c->get("views")),

    Medoo::class => fn(Config $c) =>
        new Medoo($c->get("db")),

    WhatsAppApi::class => fn(Config $c) => new WhatsAppApi(
        $c->get("wp.token"),
        $c->get("wp.instance")
    ),

    SessionConfig::class => fn(Config $c) => new SessionConfig(
        $c->get("session.name"),
        $c->get("session.secure"),
        $c->get("session.httponly"),
        $c->get("session.samesite")
    )
];

