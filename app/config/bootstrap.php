<?php

declare(strict_types=1);

use Dotenv\Dotenv;

defined('BASE_PATH')
    || define('BASE_PATH', dirname(__DIR__, 2));

defined('APP_PATH')
    || define('APP_PATH', BASE_PATH . '/app');

require_once BASE_PATH . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$dotenv->required([
    'DB_ADAPTER',
    'DB_HOST',
    'DB_PORT',
    'DB_NAME',
    'DB_USERNAME',
    'DB_PASSWORD',
    'DB_CHARSET',
]);