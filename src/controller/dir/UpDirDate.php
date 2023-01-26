<?php

namespace api\src\controller\dir;

use api\src\setting\Connecting;
use api\src\setting\File;


class UpDirDate
{
    public function UpDirDate($params_id, $params_name)
    {
        // header("Access-Control-Allow-Origin: *");
        // header("Content-Type: application/json; charset=UTF-8");
        // header("Access-Control-Allow-Methods: POST");
        // header("Access-Control-Max-Age: 3600");
        // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $database = new Connecting();
        $db = $database->getConnection();

        $file = new File($db);

        // $data = json_decode(file_get_contents('php://input'));
        // $user->login = $data->login;
        // $user->password = $data->password;
        // $user->email = $data->email;

        if ($file->UpDate($params_id, $params_name)) {
            http_response_code(200);

            $res = [
                "status" => true,
                "massage" => 'Папка была обновлёна.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);

            $res = [
                "status" => false,
                "massage" => 'Невозможно обновить папку.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);

        }
    }
}