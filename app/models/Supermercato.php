<?php
namespace App\Models;

use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\Email as EmailValidator;

class Supermercato extends \Phalcon\Mvc\Model
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
    public $codice;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $data_apertura;

    /**
     *
     * @var integer
     */
    public $attivo;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("supermercato_demo");
        $this->setSource("supermercati");
        $this->hasMany('id', 'Dipendenti', 'supermercato_id', ['alias' => 'Dipendenti']);
        $this->hasMany('id', 'IndirizziSupermercato', 'supermercato_id', ['alias' => 'IndirizziSupermercato']);
        $this->hasMany('id', 'Ordini', 'supermercato_id', ['alias' => 'Ordini']);
        $this->hasMany('id', 'Reparti', 'supermercato_id', ['alias' => 'Reparti']);
        $this->hasMany('id', 'SupermercatiProdotti', 'supermercato_id', ['alias' => 'SupermercatiProdotti']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Supermercato[]|Supermercato|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Supermercato|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
