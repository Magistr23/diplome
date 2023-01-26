<?php

namespace api\src\setting;
session_start();

use PDO;
use PDOException;

class File
{
    protected $conn;
    protected $table_name = 'fil';
    protected $table_name_dir = 'direct';

    public $login;
    public $password;
    public $email;
    public $id;
    public $name;

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

    public function Create($params_name, $params_dir)
    {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, dir=:id";

        $stml = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($params_name));
        $this->id = htmlspecialchars(strip_tags($params_dir));

        $stml->bindParam(":name", $this->name);
        $stml->bindParam(":id", $this->id);
 

        if ($stml->execute()) {
            return true;
        }
        return false;
    }

    public function CreateDir($name)
    {
        $query = "INSERT INTO " . $this->table_name_dir . " SET name=:name";

        $stml = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($name));

        $stml->bindParam(":name", $this->name);

        if ($stml->execute()) {
            return true;
        }
        return false;
    }

    public function CheakDir()
    {
        $query = "SELECT * FROM " . $this->table_name_dir;

        $stml = $this->conn->prepare($query);

        $stml->execute();

        return $stml;
    }

    public function DeleteDir($params_id)
    {
        $query = "DELETE FROM " . $this->table_name_dir . " WHERE id=:id";

        $stml = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($params_id));

        $stml->bindParam(":id", $this->id);

        if ($stml->execute()) {
            
            return true;
        }
        return false;
    }

    public function UpDate($params_id, $params_name)
    {
        $query = "UPDATE " . $this->table_name_dir . " SET name=:name WHERE id=:id";

        $stml = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($params_name));
        $this->id = htmlspecialchars(strip_tags($params_id));

        $stml->bindParam(":name", $this->name);
        $stml->bindParam(":id", $this->id);

        if ($stml->execute()) {
            return true;
        }

        return false;
    }

    public function ReadDirOne($params)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE dir=:id LIMIT 1";

        $stml = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($params));

        $stml->bindParam(":id", $this->id);

        $stml->execute();

        return $stml;
        
    }

    public function UpFileDate($params_name, $params_id)
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name WHERE id=:id";

        $stml = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($params_name));
        $this->id = htmlspecialchars(strip_tags($params_id));

        $stml->bindParam(":name", $this->name);
        $stml->bindParam(":id", $this->id);

        if ($stml->execute()) {
            return true;
        }

        return false;
    }
}