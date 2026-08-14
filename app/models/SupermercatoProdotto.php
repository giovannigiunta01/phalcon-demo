<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

final class SupermercatoProdotto extends Model
{
    public $supermercato_id;
    public $prodotto_id;
    public $prezzo_vendita;
    public $quantita_scorta;
    public $scorta_minima;
    public $corsia;
    public $ultimo_rifornimento;

    public function initialize(): void
    {
        $this->setSource('supermercati_prodotti');

        // Riferimento temporaneo al model globale generato dai DevTools.
        // Diventerà Supermercato::class quando uniformeremo i model esistenti.
        $this->belongsTo(
            'supermercato_id',
            'Supermercati',
            'id',
            ['alias' => 'supermercato']
        );

        $this->belongsTo(
            'prodotto_id',
            Prodotto::class,
            'id',
            ['alias' => 'prodotto']
        );
    }
}
