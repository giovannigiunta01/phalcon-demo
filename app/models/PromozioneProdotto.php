<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

final class PromozioneProdotto extends Model
{
    public $promozione_id;
    public $prodotto_id;
    public $limite_per_cliente;
    public $quantita_disponibile;

    public function initialize(): void
    {
        $this->setSource('promozioni_prodotti');

        $this->belongsTo(
            'promozione_id',
            Promozione::class,
            'id',
            ['alias' => 'promozione']
        );

        $this->belongsTo(
            'prodotto_id',
            Prodotto::class,
            'id',
            ['alias' => 'prodotto']
        );
    }
}
