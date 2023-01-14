<?php

namespace api\src\controller;

use api\src\setting\Connecting;
use api\src\setting\User;


class DeleteController
{
    public function Delete($params_id)
    {

        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $user = new User($db);

        // $data = json_decode(file_get_contents("php://input"));

        // $user->id = $data->id;

        if ($user->Delete($params_id)) {
            http_response_code(204);

            echo json_encode(array("message" => "Человек был удалён."), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);

            echo json_encode(array("message" => "Не удалось удалить человека."));
        }
    }
}