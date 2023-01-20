<?php

namespace api\src\setting;
session_start();

use PDO;
use PDOException;

class File
{
    protected $conn;
    protected $table_name = 'files';

    public $login;
    public $password;
    public $email;
    public $id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function ReadFile()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stml = $this->conn->prepare($query);

        $stml->execute();

        return $stml;
    }

    public function ReadFileOne($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id LIMIT 1";

        $stml = $this->conn->prepare($query);

        $stml->bindParam(":id", $id);

        $stml->execute();

        return $stml;
        
    }

    public function Delete($params_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";

        $stml = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($params_id));

        $stml->bindParam(":id", $this->id);

        if ($stml->execute()) {
            
            return true;
        }
        return false;
    }
}