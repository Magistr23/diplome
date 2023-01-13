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

        $stml = $user->Create($params_login, $params_pass, $params_email);
    }
}