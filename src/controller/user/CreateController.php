<?php

namespace api\src\controller\user;

use api\src\setting\Connecting;
use api\src\setting\User;
use PDO;


class CreateController
{
    public $dataBase;
    public function Create($params_login, $params_pass, $params_email)
    {
        $this->dataBase = new Connecting();
        $db = $this->dataBase->getConnection();

        $user = new User($db);

        if ($user->Create($params_login, $params_pass, $params_email)) {
            http_response_code(201);

            $res = [
                "status" => true,
                "massage" => 'Персонаж добавлен :з'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
            
        } else {
            http_response_code(404);

            $res = [
                "status" => false,
                "massage" => 'Не получилось добавить человека :з'
            ];
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}