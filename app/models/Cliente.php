<?php
namespace App\Models;

use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\Email as EmailValidator;
class Cliente extends \Phalcon\Mvc\Model
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
    public $cognome;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var string
     */
    public $data_nascita;

    /**
     *
     * @var integer
     */
    public $consenso_marketing;

    /**
     *
     * @var string
     */
    public $created_at;

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
        $this->setSource("clienti");
        $this->hasMany('id', 'CarteFedelta', 'cliente_id', ['alias' => 'CarteFedelta']);
        $this->hasMany('id', 'Ordini', 'cliente_id', ['alias' => 'Ordini']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cliente[]|Cliente|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cliente|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
