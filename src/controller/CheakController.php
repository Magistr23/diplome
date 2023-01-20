<?php
namespace api\src\controller;

use api\src\setting\Connecting;
use api\src\setting\User;
use PDO;

class CheakController 
{
    public function Cheak($emailGet, $passGet) {
        $database = new Connecting();
        $db = $database->getConnection();

        $user = new User($db);

        $stml = $user->aut($emailGet, $passGet);
    }
}