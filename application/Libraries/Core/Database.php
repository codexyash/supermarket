<?php

namespace Application\Libraries\Core;

use MysqliDb;

class Database {

    public static function connect() {

        $configuration = [
            'host' => env('DB_HOST', 'localhost'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'db' => env('DB_DATABASE', 'supermarket'),
            'port' => 3306,
            'prefix' => env('DB_PREFIX', 'sm_'),
            'charset' => 'utf8mb4'
        ];

        try {
            $db = new MysqliDb($configuration);
            $db->connect();
            return $db;
        } catch (\Exception $exc) {
            throw new \Exception('E_COULD_NOT_CONNECT_TO_DATABASE');
        }
    }

}
