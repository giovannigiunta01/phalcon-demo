<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

final class ProdottoFornitore extends Model
{
    public $prodotto_id;
    public $fornitore_id;
    public $codice_fornitore;
    public $costo_acquisto;
    public $giorni_consegna;
    public $fornitore_preferito;

    public function initialize(): void
    {
        $this->setSource('prodotti_fornitori');

        $this->belongsTo(
            'prodotto_id',
            Prodotto::class,
            'id',
            ['alias' => 'prodotto']
        );

        $this->belongsTo(
            'fornitore_id',
            Fornitore::class,
            'id',
            ['alias' => 'fornitore']
        );
    }
}
