<?php
namespace App\Models;

class Ordine extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $cliente_id;

    /**
     *
     * @var integer
     */
    public $supermercato_id;

    /**
     *
     * @var integer
     */
    public $dipendente_id;

    /**
     *
     * @var string
     */
    public $numero_scontrino;

    /**
     *
     * @var string
     */
    public $data_ordine;

    /**
     *
     * @var string
     */
    public $stato;

    /**
     *
     * @var string
     */
    public $metodo_pagamento;

    /**
     *
     * @var double
     */
    public $totale;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("supermercato_demo");
        $this->setSource('ordini');
        $this->belongsTo('cliente_id', Cliente::class, 'id', ['alias' => 'cliente']);
        $this->belongsTo('dipendente_id', Dipendente::class, 'id', ['alias' => 'dipendente']);
        $this->belongsTo('supermercato_id', Supermercato::class, 'id', ['alias' => 'supermercato']);
        $this->hasMany('id', OrdineProdotto::class, 'ordine_id', ['alias' => 'righe']);

        $this->hasManyToMany(
            'id',
            OrdineProdotto::class,
            'ordine_id',
            'prodotto_id',
            Prodotto::class,
            'id',
            ['alias' => 'prodotti']
        );
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ordini[]|Ordini|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ordini|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
