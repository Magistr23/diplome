<?php

namespace api\src\controller;

use api\src\setting\Connecting;
use api\src\setting\User;
use PDO;

class ReadController
{
    public function Read($id)
    {
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: access");
        // header("Access-Control-Allow-Methods: GET");
        // header("Access-Control-Allow-Credentials: true");
        // header("Content-Type: application/json");

        $databasa = new Connecting();
        $db = $databasa->getConnection();

        $user = new User($db);

        $stml = $user->ReadOne($id);

        $num = $stml->rowCount();

        if ($num > 0) {
            $user_arr = [];
            $user_arr["read_user"] = [];
            while ($row=$stml->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $user_item = [
                    "id" => $id,
                    "login" => $login,
                    "password" => $password,
                    "email" => $email,
                    "role" => $role
                ];

                $user_arr["read_user"][] = $user_item;
            }

            http_response_code(200);

            echo json_encode($user_arr);

        } else {
            http_response_code(404);

            echo json_encode(array("massage" => 'Я такого не нашёл :з'), JSON_UNESCAPED_UNICODE);
        }

        
        //$read = new ReadOne($id);

        // $user->id = isset($_GET['id']) ? $_GET['id'] : die();

        //$user->ReadOne(array($args['id']));

    //    if ($user->login != null) {
    //         $user_arr = array(
    //             "id" => $user->id,
    //             "login" => $user->login,
    //             "password" => $user->password
    //         );

    //         http_response_code(200);
 
    //         echo json_encode($user_arr);
    //     }

    //     else {

    //         http_response_code(404);

    //         echo json_encode(array("message" => "Человека не существует."), JSON_UNESCAPED_UNICODE);
    //     }
    }

}