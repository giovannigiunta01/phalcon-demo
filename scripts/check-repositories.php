<?php

declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use App\Models\Cliente;
use App\Models\Ordine;
use App\Models\Prodotto;
use App\Models\Supermercato;
use App\Repositories\ClienteRepository;
use App\Repositories\Impl\ClienteRepositoryImpl;
use App\Repositories\Impl\OrdineRepositoryImpl;
use App\Repositories\Impl\ProdottoRepositoryImpl;
use App\Repositories\Impl\SupermercatoRepositoryImpl;
use App\Repositories\OrdineRepository;
use App\Repositories\ProdottoRepository;
use App\Repositories\SupermercatoRepository;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

require_once APP_PATH . '/config/bootstrap.php';

$di = new FactoryDefault();

require_once APP_PATH . '/config/services.php';

$checks = [
    ClienteRepository::class => [
        'implementation' => ClienteRepositoryImpl::class,
        'model' => Cliente::class,
    ],
    OrdineRepository::class => [
        'implementation' => OrdineRepositoryImpl::class,
        'model' => Ordine::class,
    ],
    ProdottoRepository::class => [
        'implementation' => ProdottoRepositoryImpl::class,
        'model' => Prodotto::class,
    ],
    SupermercatoRepository::class => [
        'implementation' => SupermercatoRepositoryImpl::class,
        'model' => Supermercato::class,
    ],
];

$exitCode = 0;

foreach ($checks as $contract => $expected) {
    try {
        $repository = $di->getShared($contract);
        $secondRequest = $di->getShared($contract);

        if (!$repository instanceof $expected['implementation']) {
            throw new RuntimeException(
                "Implementazione errata per {$contract}"
            );
        }

        if ($repository !== $secondRequest) {
            throw new RuntimeException(
                "Il repository {$contract} non è condiviso"
            );
        }

        $all = $repository->findAll();

        if ($all === []) {
            throw new RuntimeException(
                "Il repository {$contract} non ha restituito record"
            );
        }

        if (!$all[0] instanceof $expected['model']) {
            throw new RuntimeException(
                "findAll() non restituisce model {$expected['model']}"
            );
        }

        $first = $repository->findById(1);

        if (!$first instanceof $expected['model']) {
            throw new RuntimeException(
                "findById(1) non ha restituito il model atteso"
            );
        }

        echo sprintf(
            "OK %-55s %d record%s",
            $contract,
            count($all),
            PHP_EOL
        );
    } catch (Throwable $exception) {
        $exitCode = 1;

        fwrite(
            STDERR,
            "FAIL {$contract}: {$exception->getMessage()}"
                . PHP_EOL
        );
    }
}

exit($exitCode);