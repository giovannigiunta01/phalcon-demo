<?php
namespace App\Models;
class CarteFedelta extends \Phalcon\Mvc\Model
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
     * @var string
     */
    public $numero_carta;

    /**
     *
     * @var integer
     */
    public $punti;

    /**
     *
     * @var string
     */
    public $livello;

    /**
     *
     * @var string
     */
    public $data_emissione;

    /**
     *
     * @var string
     */
    public $scadenza;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("supermercato_demo");
        $this->setSource("carte_fedelta");
        $this->belongsTo('cliente_id', '\Clienti', 'id', ['alias' => 'Clienti']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CarteFedelta[]|CarteFedelta|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CarteFedelta|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
