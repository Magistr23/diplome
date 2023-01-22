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

    public function Create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET login=:login, password=:password, email=:email";

        $stml = $this->conn->prepare($query);

        $this->login = htmlspecialchars(strip_tags($login));
        $this->password = htmlspecialchars(strip_tags($password));
        $this->email = htmlspecialchars(strip_tags($email));

        $stml->bindParam(":login", $this->login);
        $stml->bindParam(":password", $this->password);
        $stml->bindParam(":email", $this->email);

        if ($stml->execute()) {
            return true;
        }
        return false;
    }

    public function CreateDir($name, $params)
    {
        $query = "INSERT INTO " . $this->table_name_dir . " SET name=:name, user_id=:user_id";

        $stml = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($name));
        $this->id = htmlspecialchars(strip_tags($params));

        $stml->bindParam(":name", $this->name);
        $stml->bindParam(":user_id", $this->id);

        if ($stml->execute()) {
            return true;
        }
        return false;
    }

    public function CheakDir($id)
    {
        $query = "SELECT * FROM " . $this->table_name_dir . " WHERE user_id=:id";

        $stml = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($id));

        $stml->bindParam(":id", $this->id);

        $stml->execute();

        return $stml;
    }
}