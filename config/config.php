<?php
return [
    "app" => [
        "name" => $_ENV["APP_NAME"],
        "ver"  => $_ENV["APP_VER"],
        "base" => $_ENV["APP_PATH"]
    ],
    "db" => [
        "host" => $_ENV["DB_HOST"],
        "type" => $_ENV["DB_TYPE"] ?? 'mysql',
        "port" => (int)$_ENV["DB_PORT"] ?? 3306,
        "username" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASS"],
        "database" => $_ENV["DB_NAME"]
    ],
    "views" => __DIR__ ."/../src/views"
];
