<?php
declare(strict_types=1);

use function DI\create;

use App\Config;
use Slim\Views\PhpRenderer;

return [
    Config::class => create()
        ->constructor(require __DIR__ . "/config.php"),
    PhpRenderer::class => fn(Config $c) =>
        new PhpRenderer($c->get("views")),
    "db" => function() {

    }
];

