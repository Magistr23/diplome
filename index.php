<?php
error_reporting(E_ALL);
ini_set('display_errors',true);

$urll = $_SERVER["REQUEST_URI"];

require_once __DIR__ . "/bootstrap.php";


$parts_url = explode('?' , $urll);

function getUrlQuery($url, $key = null)
{
	$parts = parse_url($url); 
	if (!empty($parts['query'])) {
		parse_str($parts['query'], $query); 
		if (is_null($key)) {
			return $query;
		} elseif (isset($query[$key])) {
			return $query[$key];
		}        
	}
 
	return false;
}

// Все GET-параметры
$data = getUrlQuery($urll);
//var_dump($data);

if($parts_url[0] === '/user') {
	if($_SERVER["REQUEST_METHOD"] === "GET") {
		if ($data) {
			$params = $data['id'];
			// $params = array_key_exists('id' , $data);
			(new \api\src\controller\ReadController())->Read($params);
		} else {
			(new \api\src\controller\UserController())->User();
		}
	} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
		if ($data) {
			if (isset($data['login']) && isset($data['pass']) && isset($data['email'])) {
				$params_login = $data['login'];
				$params_pass = $data['pass'];
				$params_email = $data['email'];
				(new \api\src\controller\CreateController())->Create($params_login, $params_pass, $params_email);
			} else {
				echo 'Увы но вы не заполенели не все данные для добавления человека';
			}

		} else {
			echo 'Увы но вы не заполенели данные для добавления человека';
		}
	} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
		if ($data) {
			if ($data['id'] && is_numeric($data['id'])) {
				$params_id = $data['id'];
				(new \api\src\controller\DeleteController())->Delete($params_id);
			} else {
				echo "id записан не правильно";
			}
		} else {
			echo "id не записан";
		}
	}
}
 
// Параметр «email»
// echo getUrlQuery('http://site.ru/path?email=mail@site.ru&name=site', 'email');

// if ("/" === $url) {
//     (new \api\src\controller\UserController())->User();
// } elseif ("/user/" === $url) {
//     (new \api\src\controller\ReadController())->Read();
// } elseif ("/delete/{id:\d+}" === $url) {
//     (new \api\src\controller\DeleteController())->Delete();
// } elseif ("/create" === $url) {
//     (new \api\src\controller\CreateController())->Create();
// } elseif ("/upDate" === $url) {
//     (new \api\src\controller\UpDate())->UpDate();
// }