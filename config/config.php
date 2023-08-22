<?php
return [
    "app" => [
        "name" => $_ENV["APP_NAME"],
        "ver"  => $_ENV["APP_VER"],
        "base" => $_ENV["APP_PATH"],
        "url"  => $_ENV["APP_URL"]
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
    "mp" => [
        "public" => $_ENV["MP_PUBLIC"],
        "token"  => $_ENV["MP_TOKEN"]
    ]
];
