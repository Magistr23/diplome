<?php

namespace api\src\controller;

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

            echo json_encode(array("massage" => 'Персонаж добавлен :з'), JSON_UNESCAPED_UNICODE);
            
        } else {
            http_response_code(404);

            echo json_encode(array("massage" => 'Не получилось добавить человека :з'), JSON_UNESCAPED_UNICODE);
        }
    }
}