<?php

namespace Application\Controllers;

use Application\Libraries\Core\Template;
use Application\Libraries\Core\Database;

class BaseController {

    /**
     * Instance of database class.
     *
     * @var $db \MysqliDb
     */
    protected $db;
    protected $template;

    public function __construct() {
        date_default_timezone_set(env('TIMEZONE', 'UTC'));
        
        $this->template = new Template('application/Views');
        
        try {
            $this->db = Database::connect();
        } catch (\Exception $e) {
            header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
            echo $e->getMessage();
            exit(1); // EXIT_ERROR
        }
    }
}
