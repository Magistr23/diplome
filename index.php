<?php
error_reporting(E_ALL);
ini_set('display_errors',true);

$url = $_SERVER["REQUEST_URI"];

require_once __DIR__ . "/bootstrap.php";

if ("/" === $url) {
    (new \api\src\controller\UserController())->User();
} elseif ("/user" === $url) {
    (new \api\src\controller\ReadController())->Read();
} elseif ("/delete" === $url) {
    (new \api\src\controller\DeleteController())->Delete();
} elseif ("/create" === $url) {
    (new \api\src\controller\CreateController())->Create();
} elseif ("/upDate" === $url) {
    (new \api\src\controller\UpDate())->UpDate();
}