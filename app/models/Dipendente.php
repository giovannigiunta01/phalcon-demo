<?php
namespace App\Models;

class Dipendente extends \Phalcon\Mvc\Model
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
    public $matricola;

    /**
     *
     * @var string
     */
    public $nome;

    /**
     *
     * @var string
     */
    public $cognome;

    /**
     *
     * @var string
     */
    public $ruolo;

    /**
     *
     * @var string
     */
    public $data_assunzione;

    /**
     *
     * @var double
     */
    public $stipendio;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("supermercato_demo");
        $this->setSource("dipendenti");
        $this->hasMany('id', Ordine::class, 'dipendente_id', ['alias' => 'ordini']);
        $this->belongsTo('supermercato_id', Supermercato::class, 'id', ['alias' => 'supermercato']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Dipendenti[]|Dipendenti|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Dipendenti|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
