<?php

namespace api\src\controller\dir;

use api\src\setting\Connecting;
use api\src\setting\File;
use PDO;


class CreateDirController
{
    public $dataBase;
    public function CreateDir($name)
    {
        $this->dataBase = new Connecting();
        $db = $this->dataBase->getConnection();

        $file = new File($db);

        if ($file->CreateDir($name)) {
            http_response_code(201);

            $res = [
                "status" => true,
                "massage" => 'Папка добавлена :з'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            
        } else {
            http_response_code(404);

            $res = [
                "status" => false,
                "massage" => 'Не получилось добавить папку :з'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}