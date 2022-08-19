<?php

namespace api\src\controller;

use api\src\setting\Connecting;
use api\src\setting\User;

class ReadController
{
    public function Read()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Credentials: true");
        header("Content-Type: application/json");

        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $user = new User($db);

        $user->id = isset($_GET['id']) ? $_GET['id'] : die();

        $user->ReadOne();

        if ($user->login != null) {
            $user_arr = array(
                "id" => $user->id,
                "login" => $user->login,
                "password" => $user->password
            );

            http_response_code(200);

            echo json_encode($user_arr);
        }

        else {

            http_response_code(404);

            echo json_encode(array("message" => "Человека не существует."), JSON_UNESCAPED_UNICODE);
        }
    }
}