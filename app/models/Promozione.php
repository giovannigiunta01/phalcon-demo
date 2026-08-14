<?php
namespace App\Models;

class Promozione extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $nome;

    /**
     *
     * @var string
     */
    public $descrizione;

    /**
     *
     * @var string
     */
    public $tipo;

    /**
     *
     * @var double
     */
    public $valore;

    /**
     *
     * @var string
     */
    public $data_inizio;

    /**
     *
     * @var string
     */
    public $data_fine;

    /**
     *
     * @var integer
     */
    public $attiva;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("supermercato_demo");
        $this->setSource("promozioni");
        $this->hasMany('id', 'PromozioniProdotti', 'promozione_id', ['alias' => 'PromozioniProdotti']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Promozioni[]|Promozioni|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Promozioni|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
