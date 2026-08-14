<?php
namespace App\Models;

class OrdineProdotto extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $ordine_id;

    /**
     *
     * @var integer
     */
    public $prodotto_id;

    /**
     *
     * @var double
     */
    public $quantita;

    /**
     *
     * @var double
     */
    public $prezzo_unitario;

    /**
     *
     * @var double
     */
    public $sconto_percentuale;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("supermercato_demo");
        $this->setSource('ordini_prodotti');
        $this->belongsTo('ordine_id', Ordine::class, 'id', ['alias' => 'ordine']);
        $this->belongsTo('prodotto_id', Prodotto::class, 'id', ['alias' => 'prodotto']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrdiniProdotti[]|OrdiniProdotti|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrdiniProdotti|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
