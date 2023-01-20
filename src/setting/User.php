<?php

namespace api\src\setting;
session_start();

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

    public function aut($emailGet, $passGet)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email=:email AND password=:password";

        $stml = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($emailGet));
        $this->password = htmlspecialchars(strip_tags($passGet));

        $stml->bindParam(":email", $this->email);
        $stml->bindParam(":password", $this->password);

        $stml->execute();

        $user = $stml->fetch(PDO::FETCH_ASSOC);
        
        if (!empty($user)) {
            if ($this->email === $user['email']) {
                if ($this->password === $user['password']) {
                    // header('location: type/view/diplom.php');
                    $_SESSION['user'] = ["email" => $this->email];
                    $_SESSION['id'] = ["id" => $user['id']];
                    if ($user['role'] > 0) {
                        $_SESSION['admin'] = ['email' => $this->email];
                    }
                    header("location:index.php");
                    
                }
             }
        }
        var_dump($_SESSION['user']);
        //var_dump($user);
        return $user['id'];
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
            return true;
        }
        return false;
    }

    public function UpDate($params_login, $params_pass, $params_email, $params_id)
    {
        $query = "UPDATE " . $this->table_name . " SET login=:login, password=:password, email=:email WHERE id=:id";

        $stml = $this->conn->prepare($query);

        $this->login = htmlspecialchars(strip_tags($params_login));
        $this->password = htmlspecialchars(strip_tags($params_pass));
        $this->email = htmlspecialchars(strip_tags($params_email));
        $this->id = htmlspecialchars(strip_tags($params_id));

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