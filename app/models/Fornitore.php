<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

final class Fornitore extends Model
{
    public $id;
    public $ragione_sociale;
    public $partita_iva;
    public $email;
    public $telefono;
    public $citta;
    public $rating;
    public $attivo;

    public function initialize(): void
    {
        $this->setSource('fornitori');

        $this->hasMany(
            'id',
            ProdottoFornitore::class,
            'fornitore_id',
            ['alias' => 'forniture']
        );

        $this->hasManyToMany(
            'id',
            ProdottoFornitore::class,
            'fornitore_id',
            'prodotto_id',
            Prodotto::class,
            'id',
            ['alias' => 'prodotti']
        );
    }
}
