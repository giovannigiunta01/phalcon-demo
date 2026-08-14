<?php
namespace App\Models;

class Reparti extends \Phalcon\Mvc\Model
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
    public $supermercato_id;

    /**
     *
     * @var string
     */
    public $nome;

    /**
     *
     * @var integer
     */
    public $piano;

    /**
     *
     * @var string
     */
    public $responsabile;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("supermercato_demo");
        $this->setSource("reparti");
        $this->hasMany('id', 'Prodotti', 'reparto_id', ['alias' => 'Prodotti']);
        $this->belongsTo('supermercato_id', '\Supermercati', 'id', ['alias' => 'Supermercati']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Reparti[]|Reparti|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Reparti|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
