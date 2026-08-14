<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

return new \Phalcon\Config\Config([
    'database' => [
        'adapter'     => $_ENV['DB_ADAPTER'],
        'host'        => $_ENV['DB_HOST'],
        'port'        => (int) $_ENV['DB_PORT'],
        'username'    => $_ENV['DB_USERNAME'],
        'password'    => $_ENV['DB_PASSWORD'],
        'dbname'      => $_ENV['DB_NAME'],
        'charset'     => $_ENV['DB_CHARSET'],
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
    ]
]);
