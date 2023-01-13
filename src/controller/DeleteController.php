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
        $stml = $user->Delete($params_id);
    }
}