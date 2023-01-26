<?php
namespace api\src\controller\dir;

use api\src\setting\Connecting;
use api\src\setting\File;
use PDO;

class CheakDirController 
{
    public function Cheak() {
        $database = new Connecting();
        $db = $database->getConnection();

        $file = new file($db);

        $stml = $file->CheakDir();

        $num = $stml->rowCount();

        if ($num > 0) {
            $dir_arr = [];
            $dir_arr["read_dir"] = [];
            while ($row=$stml->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $dir_item = [
                    "id" => $id,
                    "name" => $name
                ];

                $dir_arr["read_dir"][] = $dir_item;
            }

            http_response_code(200);

            echo json_encode($dir_arr);

        } else {
            http_response_code(404);

            $res = [
                "massage" => 'Не удалось вывести папки :з'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}