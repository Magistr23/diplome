<?php

namespace api\src\controller;

use api\src\setting\Connecting;
use api\src\setting\User;


class DeleteController
{
    public function Delete()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $user = new User($db);

        $data = json_decode(file_get_contents("php://input"));

        $user->id = $data->id;

        if ($user->Delete()) {

            http_response_code(200);

            echo json_encode(array("message" => "Человек был удалён."), JSON_UNESCAPED_UNICODE);
        } else {

            http_response_code(503);

            echo json_encode(array("message" => "Не удалось удалить человека."));
        }
    }
}