<?php

namespace api\src\setting;
session_start();

use PDO;
use PDOException;

class CLose 
{
    protected $conn;
    protected $table_name = 'closet';

    public $id_file;
    public $user_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get()
    {

    }

    public function put()
    {
        
    }

    public function delete($id_file, $user_id)
    {
        $query = "INSERT INTO " . $this->table_name . " SET file_id=:file_id, user_id=:user_id";

        $stml = $this->conn->prepare($query);

        $this->id_file = htmlspecialchars(strip_tags($id_file));
        $this->user_id = htmlspecialchars(strip_tags($user_id));

        $stml->bindParam(":file_id", $this->id_file);
        $stml->bindParam(":user_id", $this->user_id);
 
        if ($stml->execute()) {
            return true;
        }
        return false;
    }


}
