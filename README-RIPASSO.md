# Ripasso PHP e Phalcon

Appunti progressivi del percorso didattico sul progetto `supermercato-crud`.

## Indice

1. [Superglobali PHP](#superglobali-php)
2. [`$_ENV`](#_env)
3. [File `.env` e PHP Dotenv](#file-env-e-php-dotenv)
4. [`createImmutable()`](#createimmutable)
5. [Validazione delle variabili](#validazione-delle-variabili)
6. [Configurazione del database](#configurazione-del-database)
7. [Flusso della configurazione](#flusso-della-configurazione)
8. [Valori obbligatori e valori predefiniti](#valori-obbligatori-e-valori-predefiniti)
9. [Confronto con Java e Spring](#confronto-con-java-e-spring)
10. [File della cartella `app/config`](#file-della-cartella-appconfig)

## Superglobali PHP

Le superglobali sono array messi a disposizione direttamente da PHP e accessibili in ogni ambito dello script.

Le principali sono:

```php
$_GET;      // parametri della query string
$_POST;     // dati inviati tramite form POST
$_SERVER;   // informazioni sulla richiesta e sul server
$_ENV;      // variabili d'ambiente
$_COOKIE;   // cookie ricevuti
$_SESSION;  // dati della sessione
$_FILES;    // file caricati tramite HTTP
```

Questi array appartengono a PHP: non vengono creati da Phalcon o da Composer.

## `$_ENV`

`$_ENV` è una superglobale nativa di PHP usata per leggere le variabili d'ambiente:

```php
$databaseHost = $_ENV['DB_HOST'];
$databaseName = $_ENV['DB_NAME'];
```

PHP mette a disposizione `$_ENV`, ma non interpreta automaticamente un file chiamato `.env`.

## File `.env` e PHP Dotenv

Il pacchetto `vlucas/phpdotenv` legge il file `.env` e rende i suoi valori disponibili in `$_ENV` e `$_SERVER`.

Installazione:

```powershell
composer require vlucas/phpdotenv
```

Esempio di `.env`:

```dotenv
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=supermercato_demo
DB_USERNAME=root
DB_PASSWORD=password-locale
DB_CHARSET=utf8mb4
```

Caricamento nel bootstrap:

```php
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
```

Dopo `load()`:

```php
$_ENV['DB_HOST']; // 127.0.0.1
$_ENV['DB_NAME']; // supermercato_demo
```

Il file `.env` contiene valori locali e potenzialmente segreti, quindi deve essere escluso da Git:

```gitignore
/.env
```

Il file `.env.example` può invece essere versionato perché documenta soltanto i nomi delle variabili, senza password reali.

## `createImmutable()`

L'inizializzazione usata nel progetto è:

```php
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
```

La modalità immutable non sovrascrive una variabile già presente nell'ambiente di esecuzione.

Esempio:

```text
Variabile del sistema: DB_HOST=database-produzione
File .env:            DB_HOST=127.0.0.1
```

Se la variabile era già stata definita dal sistema, conserva la precedenza. Questo comportamento è utile quando l'applicazione viene eseguita in ambienti differenti.

Con `createImmutable()` si leggono i valori tramite:

```php
$_ENV['DB_HOST'];
```

Non è necessario usare `getenv()` né la modalità `createUnsafeImmutable()`.

## Validazione delle variabili

Le variabili obbligatorie vengono controllate subito dopo il caricamento:

```php
$dotenv->required([
    'DB_ADAPTER',
    'DB_HOST',
    'DB_PORT',
    'DB_NAME',
    'DB_USERNAME',
    'DB_PASSWORD',
    'DB_CHARSET',
]);
```

In questo modo l'applicazione fallisce subito con un errore di configurazione comprensibile, invece di arrivare più avanti a un errore generico di connessione.

`required()` controlla la presenza delle variabili. Se un valore deve anche essere non vuoto si può usare:

```php
$dotenv->required('DB_NAME')->notEmpty();
```

Una password vuota può essere valida in un ambiente MySQL locale; per questo non va applicato automaticamente `notEmpty()` a `DB_PASSWORD`.

## Configurazione del database

Il file `app/config/config.php` costruisce un oggetto `Phalcon\Config\Config` utilizzando i valori già caricati:

```php
return new \Phalcon\Config\Config([
    'database' => [
        'adapter'  => $_ENV['DB_ADAPTER'],
        'host'     => $_ENV['DB_HOST'],
        'port'     => (int) $_ENV['DB_PORT'],
        'username' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'],
        'dbname'   => $_ENV['DB_NAME'],
        'charset'  => $_ENV['DB_CHARSET'],
    ],
]);
```

Le variabili provenienti da `.env` sono stringhe. La porta viene quindi convertita esplicitamente:

```php
(int) $_ENV['DB_PORT']
```

Nel nostro `config.php` non usiamo:

```php
$this->getEnv('DB_HOST');
```

Il file di configurazione non è una classe che definisce un metodo `getEnv()`. `$this` avrebbe senso soltanto all'interno del contesto di un oggetto dotato di quel metodo.

## Flusso della configurazione

```text
.env
  ↓
PHP Dotenv legge il file
  ↓
$_ENV contiene le variabili
  ↓
config.php costruisce Phalcon\Config\Config
  ↓
services.php registra il servizio condiviso db
  ↓
Il primo componente che richiede db attiva la connessione
```

La chiamata:

```php
$di->setShared('db', function () {
    // costruzione dell'adapter
});
```

registra nel container una factory condivisa. La connessione non viene necessariamente creata durante la registrazione: viene costruita quando un componente richiede per la prima volta il servizio `db`.

## Valori obbligatori e valori predefiniti

Per una configurazione obbligatoria è preferibile non nascondere l'errore:

```php
'dbname' => $_ENV['DB_NAME'],
```

Per un'impostazione tecnica con un default ragionevole si può usare l'operatore `??`:

```php
'port'    => (int) ($_ENV['DB_PORT'] ?? 3306),
'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
```

L'operatore null coalescing `??` restituisce il valore a sinistra se esiste e non è `null`; altrimenti restituisce il valore a destra.

## Confronto con Java e Spring

| PHP/Phalcon | Java/Spring |
|---|---|
| `.env` | `application-local.properties` o variabili d'ambiente |
| `$_ENV['DB_HOST']` | proprietà letta tramite `Environment` o `@Value` |
| `Phalcon\Config\Config` | configuration properties |
| container DI Phalcon | ApplicationContext |
| servizio condiviso `db` | bean/DataSource singleton |
| `vlucas/phpdotenv` | caricamento della configurazione esterna |

Il principio comune è separare configurazione e credenziali dal codice applicativo.

## File della cartella `app/config`

La cartella contiene quattro responsabilità differenti:

| File | Responsabilità | Analogia Java/Spring |
|---|---|---|
| `config.php` | Costruisce i valori di configurazione | `application.properties` più configuration properties |
| `services.php` | Registra i componenti nel container DI | classi `@Configuration` e metodi `@Bean` |
| `loader.php` | Configura il caricamento delle classi legacy | classpath/component scanning, con differenze |
| `router.php` | Associa URL e metodi HTTP ai controller | `@RequestMapping`, `@GetMapping`, `@PostMapping` |

Ordine semplificato di avvio:

```text
public/index.php
  → carica Composer e .env
  → crea il container DI
  → registra services.php
  → prepara router.php
  → materializza config.php
  → registra loader.php
  → Phalcon gestisce la richiesta
```

### `config.php`

Restituisce un oggetto `Phalcon\Config\Config` con impostazioni database e percorsi applicativi. Non crea la connessione al database.

```php
return new \Phalcon\Config\Config([
    'database' => [
        'host'   => $_ENV['DB_HOST'],
        'dbname' => $_ENV['DB_NAME'],
    ],
]);
```

### `services.php`

Registra nel container componenti come `config`, `url`, `view`, `db`, `modelsMetadata`, `flash` e `session`.

```php
$di->setShared('db', function () {
    // costruzione dell'adapter
});
```

`setShared()` crea una sola istanza condivisa quando viene richiesta per la prima volta. `set()` registra invece un servizio non necessariamente condiviso.

Dentro le closure registrate dal container, `$this` viene associato al container DI. Per questo in `services.php` è possibile usare:

```php
$config = $this->getConfig();
```

Ciò non rende valido `$this->getEnv()` dentro `config.php`: il file di configurazione non definisce quel metodo.

### `loader.php`

Registra le directory legacy nelle quali Phalcon deve cercare controller e model senza namespace:

```php
$loader->setDirectories([
    $config->application->controllersDir,
    $config->application->modelsDir,
])->register();
```

Nel progetto è presente anche l'autoload PSR-4 di Composer. Durante la migrazione i due sistemi convivono; quando tutte le classi useranno namespace coerenti, il loader basato sulle directory potrà essere rimosso.

### `router.php`

Ottiene il router predefinito dal container e gli passa l'URI richiesto. Anche senza rotte esplicite, il router predefinito applica la convenzione controller/action.

Esempio futuro di rotta esplicita:

```php
$router->addGet('/prodotti', [
    'controller' => 'prodotti',
    'action'     => 'index',
]);
```

## Test infrastrutturale del database

Lo script `scripts/check-db.php` verifica la comunicazione con MySQL senza coinvolgere controller e view.

```text
check-db.php
  → carica vendor/autoload.php
  → carica e valida .env
  → crea FactoryDefault
  → registra services.php
  → richiede il servizio condiviso db
  → esegue query di sola lettura sui metadati
```

La chiamata seguente materializza il servizio lazy registrato con `setShared()`:

```php
$database = $di->getShared('db');
```

Il test usa SQL diretto intenzionalmente perché controlla l'infrastruttura stessa. Le funzionalità CRUD useranno invece model e repository, evitando query nei controller.

Il blocco:

```php
catch (\Throwable $exception) {
    // gestione del fallimento
}
```

intercetta sia le eccezioni sia gli errori PHP. Nel namespace globale non serve importare `Throwable` con `use Throwable`; si può usare direttamente il nome completo `\Throwable`.

## Model e repository normalizzati

I model usano nomi di entità singolari e tabelle plurali:

```text
Cliente          → clienti
CartaFedelta     → carte_fedelta
Ordine           → ordini
OrdineProdotto   → ordini_prodotti
Prodotto         → prodotti
Reparto          → reparti
Supermercato     → supermercati
```

Le relazioni 1:1 derivano dai vincoli `UNIQUE`:

```text
Cliente 1:1 CartaFedelta
Supermercato 1:1 IndirizzoSupermercato
```

Le tabelle associative con attributi propri rimangono model di prima classe:

```text
ProdottoFornitore
SupermercatoProdotto
PromozioneProdotto
OrdineProdotto
```

I relativi `hasManyToMany()` sono scorciatoie di lettura e non sostituiscono i model associativi, necessari per costo, scorta, quantità, prezzo e sconto.

I repository principali sono:

```text
ClienteRepository
OrdineRepository
ProdottoRepository
SupermercatoRepository
```

`findAll()` restituisce una lista di model, mentre `findById()` restituisce il model oppure `null`. `save()` e `delete()` controllano il risultato dell'Active Record e sollevano `PersistenceException` quando Phalcon restituisce `false`.

La struttura PSR-4 rispetta maiuscole e minuscole:

```text
app/Models
app/Repositories
app/Repositories/Impl
app/Exceptions
```
