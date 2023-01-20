<?php

namespace api\src\controller;

use api\src\setting\Connecting;
use api\src\setting\File;
use PDO;

class FileController
{
    public function File()
    {
        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $file = new File($db);

        $stml = $file->ReadFile();
        $num = $stml->rowCount();

        if ($num > 0) {
            $file_arr = [];
            $file_arr["file"] = [];

            while ($row = $stml->fetch(PDO::FETCH_ASSOC)) {

                extract($row);

                $file_item = [
                    "id" => $id,
                    "name" => $name,
                    "directory" => $directory
                    // "email" => $email,
                    //  "role" => $role
                ];

                $file_arr["file"][] = $file_item;
            }

            http_response_code(200);

            echo json_encode($file_arr);
        } else {
            http_response_code(404);

            echo json_encode(array("massage" => 'Никого нечего нет :з'), JSON_UNESCAPED_UNICODE);
        }

    }
    
}