<?php

namespace api\src\controller;

use api\src\setting\Connecting;
use api\src\setting\User;


class UpDate
{
    public function UpDate($params_login, $params_pass, $params_email, $params_id)
    {
        // header("Access-Control-Allow-Origin: *");
        // header("Content-Type: application/json; charset=UTF-8");
        // header("Access-Control-Allow-Methods: POST");
        // header("Access-Control-Max-Age: 3600");
        // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $database = new Connecting();
        $db = $database->getConnection();

        $user = new User($db);

        // $data = json_decode(file_get_contents('php://input'));

        $stml = $user->UpDate($params_login, $params_pass, $params_email, $params_id);

        // $user->login = $data->login;
        // $user->password = $data->password;
        // $user->email = $data->email;

        if ($user->UpDate($params_login, $params_pass, $params_email, $params_id)) {
            http_response_code(200);

            echo json_encode(array("message" => "Человек был обновлён."), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "Невозможно обновить аккаунт."), JSON_UNESCAPED_UNICODE);

        }
    }
}