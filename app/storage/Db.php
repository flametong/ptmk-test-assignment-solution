<?php

namespace App\Storage;

use mysqli;

class Db
{

    use TSingleton;

    private mysqli $conn;

    private function __construct()
    {
        $db = require_once CONFIG . '/config_db.php';

        $this->conn = new mysqli(
            $db['server_name'],
            $db['username'],
            $db['password'],
            $db['db_name']
        );

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }

}