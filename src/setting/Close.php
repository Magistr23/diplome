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

    public function get($id_file)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE file_id=:file_id";

        $stml = $this->conn->prepare($query);

        $this->id_file = htmlspecialchars(strip_tags($id_file));

        $stml->bindParam(":file_id", $this->id_file);

        $stml->execute();

        $close = $stml->fetchAll(PDO::FETCH_ASSOC);

        foreach($close as $k => $val) {
            echo json_encode("этот файл запрещён этому id = " . $close[$k]['user_id'], JSON_UNESCAPED_UNICODE);
        }
        unset($val);
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
