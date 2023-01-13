<?php

namespace api\src\setting;

use PDO;
use PDOException;

class User
{
    protected $conn;
    protected $table_name = 'users';

    public $login;
    public $password;
    public $email;
    public $id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /*public function ReadAdmin()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stml = $this->conn->prepare($query);

        $stml->execute();

        return $stml;
    }*/

    public function Read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stml = $this->conn->prepare($query);

        $stml->execute();

        return $stml;
    }

    public function Create($login, $password, $email)
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
            http_response_code(201);
            echo 'Персонаж добавлен';
        } else {
            http_response_code(404);

            echo json_encode(array("massage" => 'Не получилось добавить человека :з'), JSON_UNESCAPED_UNICODE);
        }

        return false;
    }

    public function UpDate()
    {
        $query = "UPDATE " . $this->table_name . " SET login=:login, password=:password, email=:email WHERE id=:id";

        $stml = $this->conn->prepare($query);

        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stml->bindParam(":login", $this->login);
        $stml->bindParam(":password", $this->password);
        $stml->bindParam(":email", $this->email);
        $stml->bindParam(":id", $this->id);

        if ($stml->execute()) {
            return true;
        }

        return false;
    }

    public function ReadOne($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id LIMIT 1";

        $stml = $this->conn->prepare($query);

        $stml->bindParam(":id", $id);

        $stml->execute();

        return $stml;
        
    }

    public function Delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";

        $stml = $this->conn->prepare($query);

        $stml->id = htmlspecialchars(strip_tags($this->id));

        $stml->bindParam(1, $this->id);

        if ($stml->execute()) {
            return true;
        }
        return false;
    }
}