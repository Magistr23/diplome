<?php

namespace api\src\controller\file;

use api\src\setting\Connecting;
use api\src\setting\File;
use PDO;


class CreateFileController
{
    public $dataBase;
    public function Create()
    {
        $this->dataBase = new Connecting();
        $db = $this->dataBase->getConnection();

        $file = new File($db);

        if ($file->Create()) {
            http_response_code(201);

            $res = [
                "status" => true,
                "massage" => 'Файл добавлен :з'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            
        } else {
            http_response_code(404);

            $res = [
                "status" => false,
                "massage" => 'Не получилось добавить Файл :з'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}