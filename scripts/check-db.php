<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Db\Enum as DbEnum;
use Phalcon\Di\FactoryDefault;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

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

$di = new FactoryDefault();

require_once APP_PATH . '/config/services.php';

try {
    $database = $di->getShared('db');

    $server = $database->fetchOne(
        'SELECT DATABASE() AS database_name, VERSION() AS server_version',
        DbEnum::FETCH_ASSOC
    );

    $tables = $database->fetchOne(
        'SELECT COUNT(*) AS table_count
         FROM information_schema.tables
         WHERE table_schema = DATABASE()',
        DbEnum::FETCH_ASSOC
    );

    echo "Connessione al database riuscita." . PHP_EOL;
    echo "Database: " . $server['database_name'] . PHP_EOL;
    echo "Server: " . $server['server_version'] . PHP_EOL;
    echo "Tabelle e viste: " . $tables['table_count'] . PHP_EOL;
} catch (\Throwable $exception) {
    fwrite(STDERR, "Connessione al database fallita." . PHP_EOL);
    fwrite(STDERR, $exception::class . ': ' . $exception->getMessage() . PHP_EOL);

    exit(1);
}
