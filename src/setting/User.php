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

    public function Create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET login=:login, password=:password, email=:email";

        $stml = $this->conn->prepare($query);

        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stml->bindParam(":login", $this->login);
        $stml->bindParam(":password", $this->password);
        $stml->bindParam(":email", $this->email);

        if ($stml->execute()) {
            return true;
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
        
//         $row = $stml->fetchAll(PDO::FETCH_ASSOC);
// //var_dump($row);
//         $this->id = $row[0]['id'];
//         $this->login = $row[0]['login'];
//         $this->password = $row[0]['password'];
//         $this->email = $row[0]['email'];
        // print_r($this->email);
    //     if ($row = $stml->fetchAll(PDO::FETCH_ASSOC)) {
    //         print_r($row);
    //         print_r($row[0]['login']);
    //         $user_arr = [];
    //         $user_arr["user"] = [];
    //             extract($row);

    //             $user_item = [
    //                 "id" => $id,
    //                 "login" => $login,
    //                 "password" => $password,
    //                 "email" => $email,
    //                 "role" => $role
    //             ];

    //             $user_arr["user"][] = $user_item;

    //         http_response_code(200);
    //         echo json_encode($user_item);

    // } else {
    //     http_response_code(404);

    //     echo json_encode(array("massage" => 'Никого тут нет :з'), JSON_UNESCAPED_UNICODE);
    // }

    }

    public function Delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:?";

        $stml = $this->conn->prepare($query);

        $stml->id = htmlspecialchars(strip_tags($this->id));

        $stml->bindParam(1, $this->id);

        if ($stml->execute()) {
            return true;
        }
        return false;
    }
}