<?php

namespace api\src\controller\file;

use api\src\setting\Connecting;
use api\src\setting\File;


class DeleteFileController
{
    public function DeleteFile($params_id)
    {

        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $file = new File($db);

        // $data = json_decode(file_get_contents("php://input"));

        // $user->id = $data->id;

        if ($file->Delete($params_id)) {
            http_response_code(204);

            $res = [
                "status" => true,
                "massage" => 'Файл был удалён.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);

            $res = [
                "status" => false,
                "massage" => 'Не удалось удалить файл.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}