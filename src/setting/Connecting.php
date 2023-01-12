<?php

namespace api\src\setting;

use PDO;
use PDOException;

class Connecting
{
    private $host = 'localhost';
    private $bd_name = 'users';
    private $username = 'root';
    private $password = 'root';
    public $conn;

    public function getConnection()
    {

        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->bd_name.";charset=utf8" , $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    
}