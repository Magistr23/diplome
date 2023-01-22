<?php

namespace api\src\controller\user;

use api\src\setting\Connecting;
use api\src\setting\User;
use PDO;

class UserController
{
    public function User()
    {
        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $user = new User($db);

        $stml = $user->Read();
        $num = $stml->rowCount();

        if ($num > 0) {
            $user_arr = [];
            $user_arr["user"] = [];

            while ($row = $stml->fetch(PDO::FETCH_ASSOC)) {

                extract($row);

                $user_item = [
                    "id" => $id,
                    "login" => $login,
                    "password" => $password,
                    "email" => $email,
                     "role" => $role
                ];

                $user_arr["user"][] = $user_item;
            }

            http_response_code(200);

            echo json_encode($user_arr);
        } else {
            http_response_code(404);

            echo json_encode(array("massage" => 'Никого тут нет :з'), JSON_UNESCAPED_UNICODE);
        }

    }
    
}