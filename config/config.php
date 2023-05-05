<?php
return [
    "app" => [
        "name" => $_ENV["APP_NAME"],
        "ver"  => $_ENV["APP_VER"],
        "base" => $_ENV["APP_PATH"]
    ],
    "db" => [
        "host" => $_ENV["DB_HOST"],
        "user" => $_ENV["DB_USER"],
        "PORT" => $_ENV["DB_PORT"] ?? '3306',
        "PASS" => $_ENV["DB_PASS"],
        "NAME" => $_ENV["DB_NAME"]
    ],
    "views" => __DIR__ ."/../src/views"
];
