<?php
return [
    "app" => [
        "name" => $_ENV["APP_NAME"],
        "ver"  => $_ENV["APP_VER"],
        "base" => $_ENV["APP_PATH"],
        "url"  => $_ENV["APP_URL"],
        "env"  => $_ENV["APP_ENV"]
    ],
    "db" => [
        "host" => $_ENV["DB_HOST"],
        "type" => $_ENV["DB_TYPE"] ?? 'mysql',
        "port" => (int)$_ENV["DB_PORT"] ?? 3306,
        "username" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASS"],
        "database" => $_ENV["DB_NAME"],
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
    ],
    "plan_colaborador_id" => $_ENV["PLAN_COLABORADOR_ID"],
    "assets" => [
        "templates"   => __DIR__ . "/.." . $_ENV["TEMPLATES"],
        "entrypoints" => __DIR__ . "/.." . $_ENV["ENTRYPOINTS_PATH"]
    ],
    "session" => [
        'name'       => $_ENV["APP_NAME"] . '_session',
        'secure'     => false,
        'httponly'   => true,
        'samesite'   => 'lax',
    ],
    "pasarela" => [
        "api" => $_ENV["PASARELA_API"],
        "key" => $_ENV["PASARELA_KEY"],
        "login" => $_ENV["PASARELA_LOGIN"]
    ],
    "wp" => [
        "token" => $_ENV["WP_TOKEN"],
        "instance" => $_ENV["WP_INSTANCE"]
    ],
    "soportes" => __DIR__ . "/../soportes"
];
