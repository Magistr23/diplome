<?php

namespace api\src\controller\user;

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

            $res = [
                "status" => true,
                "massage" => 'Человек был удалён.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);

            $res = [
                "status" => false,
                "massage" => 'Не удалось удалить человека.'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}