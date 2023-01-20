<?php
session_start();

$urll = $_SERVER["REQUEST_URI"];

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
if ($_GET['log']) {
	$emailGet = $_GET['email'];
	$passGet = $_GET['pass'];
	(new \api\src\controller\CheakController())->Cheak($emailGet, $passGet);
}

// if ($_GET['log']) {
// 	(new \api\src\controller\CheakController())->Cheak($_GET);
// }
// Все GET-параметры
$data = getUrlQuery($urll);
//var_dump($data);
if($parts_url[0] === '/admin/user') {

	switch ($_SERVER["REQUEST_METHOD"]) {
		case "GET":
			if ($data) {
				$params = $data['id'];
				// $params = array_key_exists('id' , $data);
				(new \api\src\controller\ReadController())->Read($params);
			} else {
				echo 'Увы но вы не заполенели id человека';
			}
			break;
		case "POST":
			if ($data) {
				if (isset($data['login']) && isset($data['pass']) && isset($data['email'])) {
					$params_login = $data['login'];
					$params_pass = $data['pass'];
					$params_email = $data['email'];
					(new \api\src\controller\CreateController())->Create($params_login, $params_pass, $params_email);
				} else {
					echo 'Увы но вы заполенели не все данные для добавления человека';
				}

			} else {
				echo 'Увы но вы не заполенели данные для добавления человека';
			}
			break;
		case "DELETE":
			if ($data) {
				if ($data['id'] && is_numeric($data['id'])) {
					$params_id = $data['id'];
					(new \api\src\controller\DeleteController())->Delete($params_id);
				} else {
					echo "id должен быть числовой";
				}
			} else {
				echo "id не записан";
			}
			break;
		case "PUT":
			if ($data) {
				if (isset($data['login']) && isset($data['pass']) && isset($data['email']) && isset($data['id'])) {
					$params_login = $data['login'];
					$params_pass = $data['pass'];
					$params_email = $data['email'];
					$params_id = $data['id'];
					(new \api\src\controller\UpDate())->UpDate($params_login, $params_pass, $params_email, $params_id);
				} else {
					echo 'Увы но вы заполенели не все данные для обновления человека';
				}
			}
			break;
	}
} elseif ($parts_url[0] === '/admin/users') {
	(new \api\src\controller\UserController())->User();
} elseif ($parts_url[0] === '/user') {
	(new \api\src\controller\UserController())->User();
} 
