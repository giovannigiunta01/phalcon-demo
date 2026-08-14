<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

final class IndirizzoSupermercato extends Model
{
    public $id;
    public $supermercato_id;
    public $via;
    public $civico;
    public $cap;
    public $citta;
    public $provincia;
    public $regione;
    public $latitudine;
    public $longitudine;

    public function initialize(): void
    {
        $this->setSource('indirizzi_supermercato');

        $this->belongsTo(
            'supermercato_id',
            Supermercato::class,
            'id',
            ['alias' => 'supermercato']
        );
    }
}
