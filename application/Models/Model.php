<?php

namespace Application\Models;

class Model {

    /**
     * Instance of database class.
     *
     * @var $db \MysqliDb
     */
    protected $db;
    public $table;
    public $prefix;

    function __construct() {
        $this->db = \MysqliDb::getInstance();

        if(!$this->db)
            exit('E_COULD_NOT_CONNECT_TO_DATABASE');
    }

}
