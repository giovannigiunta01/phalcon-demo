# Supermercato CRUD con Phalcon 5

Progetto didattico per imparare Phalcon 5 realizzando un'applicazione CRUD strutturata a livelli, con separazione delle responsabilità ispirata alle applicazioni Java/Spring.

## Elenco rapido dei comandi

Eseguire i comandi applicativi dalla cartella del progetto:

```powershell
cd C:\Users\Giovanni\Desktop\PGE\Studio\supermercato-crud
```

| Obiettivo | Comando |
|---|---|
| Verificare PHP | `php --version` |
| Verificare Composer | `composer --version` |
| Verificare l'estensione Phalcon | `php --ri phalcon` |
| Verificare i DevTools | `phalcon --version` |
| Mostrare i comandi Phalcon | `phalcon commands` |
| Avviare l'applicazione | `php -S 127.0.0.1:8000 -t public .htrouter.php` |
| Arrestare il server | `Ctrl+C` nel terminale del server |
| Validare un file PHP | `php -l percorso\File.php` |
| Installare le dipendenze | `composer install` |
| Aggiornare l'autoloader | `composer dump-autoload` |
| Mostrare le dipendenze | `composer show` |
| Controllare Composer | `composer diagnose` |
| Verificare la connessione al database | `php scripts\check-db.php` |
| Verificare repository e collegamenti DI | `php scripts\check-repositories.php` |
| Creare un controller | `phalcon create-controller --name prodotti` |
| Creare un model | `phalcon model prodotti` |
| Mostrare l'aiuto per i model | `phalcon model --help` |
| Mostrare l'aiuto per i controller | `phalcon controller --help` |
| Mostrare l'aiuto per i progetti | `phalcon project --help` |

> I comandi che generano controller, model o scaffold possono creare o sovrascrivere file. Controllare sempre le opzioni con `--help` prima di usare `--force`.

## Requisiti del progetto

- Windows 64 bit;
- PHP 8.2;
- Phalcon 5.8 caricato come estensione PHP;
- Composer 2;
- Phalcon DevTools 5;
- MySQL 8;
- database `supermercato_demo`;
- estensione PHP `pdo_mysql`.

## Verifica dell'ambiente

```powershell
php --version
php --ri phalcon
php -m
composer --version
phalcon --version
```

Per verificare specificamente PDO e MySQL:

```powershell
php -m | Select-String -Pattern 'PDO|pdo_mysql'
```

Per sapere quali eseguibili vengono utilizzati:

```powershell
where.exe php
where.exe composer
where.exe phalcon
```

Se `phalcon` non viene riconosciuto da PowerShell:

```powershell
& "$env:APPDATA\Composer\vendor\bin\phalcon.bat" --version
```

## Avvio locale

Entrare nella directory del progetto:

```powershell
cd C:\Users\Giovanni\Desktop\PGE\Studio\supermercato-crud
```

Avviare il server PHP integrato:

```powershell
php -S 127.0.0.1:8000 -t public .htrouter.php
```

Aprire nel browser:

<http://127.0.0.1:8000>

Il server integrato è destinato allo sviluppo locale, non alla produzione. Per arrestarlo premere `Ctrl+C` nel terminale in cui è in esecuzione.

Se la porta 8000 è occupata, usarne un'altra:

```powershell
php -S 127.0.0.1:8080 -t public .htrouter.php
```

## Composer

### Inizializzare Composer nel progetto

Se il progetto non contiene ancora `composer.json`, inizializzarlo dalla sua directory:

```powershell
composer init `
  --name="giovanni/supermercato-crud" `
  --description="CRUD didattico con Phalcon 5 e Volt" `
  --type="project" `
  --require="php:>=8.2 <8.3" `
  --require="ext-phalcon:>=5.8 <6.0" `
  --require="ext-pdo:*" `
  --no-interaction
```

Verificare che la sezione generata contenga intervalli di versione e non versioni esatte:

```json
"require": {
    "php": ">=8.2 <8.3",
    "ext-phalcon": ">=5.8 <6.0",
    "ext-pdo": "*"
}
```

Il vincolo `"php": "8.2"` indica esattamente PHP 8.2.0 e non accetta PHP 8.2.12. Per questo progetto usiamo `">=8.2 <8.3"`.

### Installare le dipendenze dichiarate

```powershell
composer install
```

`install` legge `composer.lock`, quando presente, e installa le versioni fissate dal progetto.

Alla prima esecuzione l'assenza di `composer.lock` è normale: Composer risolve le dipendenze, installa i pacchetti e crea il lock file. Le esecuzioni successive utilizzeranno le versioni registrate.

### Rigenerare l'autoloader

Da eseguire dopo aver modificato namespace o configurazione PSR-4:

```powershell
composer dump-autoload
```

Versione ottimizzata:

```powershell
composer dump-autoload --optimize
```

### Esaminare le dipendenze

```powershell
composer show
composer show --direct
composer outdated
```

### Diagnosticare Composer

```powershell
composer validate
composer diagnose
```

### Aggiungere una dipendenza

```powershell
composer require vendor/pacchetto
```

Installare Dotenv per caricare la configurazione locale e le credenziali del database dal file `.env`:

```powershell
composer require vlucas/phpdotenv
```

Il file `.env` contiene valori locali e credenziali e deve rimanere escluso da Git. Il file `.env.example`, privo di password reali, documenta invece le variabili richieste dal progetto.

Dipendenza utilizzata soltanto durante lo sviluppo:

```powershell
composer require --dev vendor/pacchetto
```

Non eseguire `composer update` senza aver prima controllato le versioni proposte: il comando può aggiornare contemporaneamente più dipendenze e modificare `composer.lock`.

## Phalcon DevTools

### Consultare i comandi

```powershell
phalcon commands
phalcon project --help
phalcon controller --help
phalcon model --help
phalcon all-models --help
phalcon scaffold --help
```

### Creare un nuovo progetto

Esempio con template Volt:

```powershell
phalcon create-project supermercato-crud simple --template-engine=volt
```

Alternative supportate direttamente dal generatore:

```text
--template-engine=volt
--template-engine=phtml
```

### Creare un controller

Da eseguire dentro un progetto Phalcon:

```powershell
phalcon create-controller --name prodotti
```

Equivalente abbreviato:

```powershell
phalcon controller prodotti
```

### Creare un model da una tabella

Prima configurare correttamente la connessione al database in `app/config/config.php`.

Controllare innanzitutto che i DevTools e PHP siano raggiungibili:

```powershell
php --version
phalcon model --help
```

Se il comando Phalcon restituisce l'errore `"php" non è riconosciuto`, aggiungere PHP al `PATH` della sola sessione PowerShell corrente:

```powershell
$env:Path = "C:\xampp\php;$env:Path"
```

Quindi ripetere:

```powershell
phalcon model --help
```

Il caricamento di `.env` deve essere disponibile anche dalla CLI. Nel progetto ciò avviene tramite il bootstrap condiviso:

```text
phalcon model
  → app/config/config.php
  → app/config/bootstrap.php
  → vendor/autoload.php e .env
  → configurazione del database
```

```powershell
phalcon model prodotti
```

Con namespace, getter/setter e documentazione per l'IDE:

```powershell
phalcon model prodotti --namespace="App\Models" --get-set --doc
```

Comando pianificato per generare il model della tabella `prodotti` nella directory PSR-4 del progetto:

```powershell
phalcon model prodotti `
  --namespace="App\Models" `
  --output="app/Models" `
  --get-set `
  --doc
```

Prima si verifica `phalcon model --help`; il comando di generazione viene eseguito soltanto dopo aver confermato opzioni, collegamento al database e directory di destinazione.

Prima di generare il model definitivo controllare tutte le opzioni:

```powershell
phalcon model --help
```

### Generare tutti i model

```powershell
phalcon all-models
```

Questo comando può generare molti file. Non usarlo finché namespace, directory di output e convenzioni del progetto non sono stati definiti.

### Scaffold CRUD

```powershell
phalcon scaffold --table-name prodotti
```

Lo scaffold genera rapidamente model, controller e view, ma in questo progetto didattico non viene usato come struttura finale: costruiremo controller, service e repository separatamente per comprendere le responsabilità di ogni livello.

## MySQL

### Verificare la connessione tramite Phalcon

Lo script utilizza Dotenv, il container DI e il servizio condiviso `db` dell'applicazione:

```powershell
php scripts\check-db.php
```

Risultato verificato nell'ambiente locale:

```text
Connessione al database riuscita.
Database: supermercato_demo
Server: 8.0.44
Tabelle e viste: 16
```

Il controllo legge soltanto nome del database, versione del server e numero di tabelle/viste. Non stampa credenziali.

Aprire il client MySQL 8:

```powershell
& 'C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe' -u root -p
```

La password viene richiesta in modo interattivo e non deve essere scritta nel comando o salvata nel README.

Comandi SQL di verifica:

```sql
SHOW DATABASES;
USE supermercato_demo;
SHOW TABLES;
SELECT COUNT(*) FROM prodotti;
SELECT * FROM vw_catalogo_supermercati;
```

Importare uno script SQL dal client MySQL interattivo:

```sql
SOURCE C:/Users/Giovanni/Documents/PGE/supermercato_demo.sql;
```

> Lo script didattico contiene `DROP DATABASE IF EXISTS supermercato_demo`: rieseguirlo elimina e ricrea l'intero database, cancellando eventuali modifiche ai dati.

## Controlli PHP utili

### Verificare i repository registrati nel container

```powershell
php -l app\config\services.php
php -l scripts\check-repositories.php
php scripts\check-repositories.php
```

Risultato verificato:

```text
OK App\Repositories\ClienteRepository       10 record
OK App\Repositories\OrdineRepository        10 record
OK App\Repositories\ProdottoRepository      10 record
OK App\Repositories\SupermercatoRepository  10 record
```

Il controllo verifica binding interfaccia-implementazione, istanza condivisa, `findAll()`, `findById()` e tipo dei model restituiti. Non modifica il database.

Verificare la sintassi di un file:

```powershell
php -l app\controllers\IndexController.php
```

Verificare tutti i file PHP del progetto:

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }
```

Mostrare il file `php.ini` effettivamente caricato:

```powershell
php --ini
```

Mostrare le informazioni sulla configurazione PHP:

```powershell
php -i
```

## Struttura iniziale Phalcon

```text
supermercato-crud/
├── app/
│   ├── config/          configurazione, servizi e router
│   ├── controllers/     gestione delle richieste HTTP
│   ├── library/         componenti applicativi generici
│   ├── migrations/      evoluzione dello schema del database
│   ├── models/          model Phalcon collegati alle tabelle
│   └── views/           template Volt
├── cache/               template Volt compilati
├── public/              document root e risorse pubbliche
│   └── index.php        front controller
└── .htrouter.php        routing per il server PHP locale
```

Durante il percorso aggiungeremo progressivamente:

```text
app/
├── dto/
├── exceptions/
├── handlers/
├── repositories/
└── services/
```

Flusso architetturale previsto:

```text
Browser → Router → Controller → Service → Repository → Model → MySQL
                                      ↓
                              View Volt / Response
```

## Regole del progetto didattico

- Il controller gestisce HTTP e delega i casi d'uso.
- Il service contiene la logica applicativa.
- Il repository contiene l'accesso ai dati.
- Solo repository e model dipendono direttamente dall'Active Record di Phalcon.
- Le view non contengono logica di business.
- Le credenziali non vengono inserite nel repository Git.
- Le query usano sempre parametri associati.
- Le eccezioni applicative vengono gestite centralmente.
- Ogni modifica viene verificata prima di passare al passaggio successivo.

## Risoluzione rapida dei problemi

### `phalcon` non riconosciuto

```powershell
& "$env:APPDATA\Composer\vendor\bin\phalcon.bat" --version
```

Verificare che questa directory sia presente nel `Path` utente:

```text
C:\Users\Giovanni\AppData\Roaming\Composer\vendor\bin
```

### Estensione Phalcon non caricata

```powershell
php --ini
php --ri phalcon
```

Verificare nel `php.ini`:

```ini
extension=php_phalcon.dll
```

### Driver MySQL non disponibile

```powershell
php -m | Select-String -Pattern 'PDO|pdo_mysql'
```

Verificare nel `php.ini`:

```ini
extension=pdo_mysql
```

### Porta occupata

Avviare il server su una porta differente:

```powershell
php -S 127.0.0.1:8080 -t public .htrouter.php
```

### Modifiche Volt non visibili

Arrestare il server e svuotare soltanto i file compilati nella directory `cache`, senza eliminare la directory stessa. Durante lo sviluppo configureremo Volt affinché ricompili automaticamente i template modificati.
