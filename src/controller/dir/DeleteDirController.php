<?php

namespace api\src\controller\dir;

use api\src\setting\Connecting;
use api\src\setting\File;


class DeleteDirController
{
    public function DeleteDir($params_id)
    {

        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $file = new File($db);

        // $data = json_decode(file_get_contents("php://input"));

        // $user->id = $data->id;

        if ($file->DeleteDir($params_id)) {
            http_response_code(204);

            $res = [
                "status" => true,
                "massage" => 'Папка была удалёна.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);

            $res = [
                "status" => false,
                "massage" => 'Не удалось удалить папку.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}