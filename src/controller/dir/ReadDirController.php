<?php

namespace api\src\controller\dir;

use api\src\setting\Connecting;
use api\src\setting\File;
use PDO;

class ReadDirController 
{
    public function ReadDirOne($params)
    {
        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $file = new File($db);

        $stml = $file->ReadDirOne($params);

        $num = $stml->rowCount();

        if ($num > 0) {
            $file_arr = [];
            $file_arr["read_file"] = [];
            while ($row=$stml->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $file_item = [
                    "id" => $id,
                    "name" => $name,
                ];

                $file_arr["read_file"][] = $file_item;
            }

            http_response_code(200);

            echo json_encode($file_arr);

        } else {
            http_response_code(404);

            $res = [
                "status" => false,
                "massage" => 'Я такого не нашёл :з'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}