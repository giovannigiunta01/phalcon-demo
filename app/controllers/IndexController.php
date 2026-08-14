<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{
    private $messages = [
        "Benvenuto nel nostro supermercato",
        "questo è un progetto per esercitazione",
        "stack usato per il progetto; PHP, Phalcon, Volt, MySql"
    ];

    public function indexAction()
    {
        $this->view->title = "Supermercato - CRUD";
        $this->view->messages = $this->messages;
    }

}

