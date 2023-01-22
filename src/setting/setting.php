<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors',true);
// header('Content-Type: application/json');


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
	(new \api\src\controller\user\CheakController())->Cheak($emailGet, $passGet);
}

if ($_POST['file']) {
	
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
				(new \api\src\controller\user\ReadController())->Read($params);
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
					(new \api\src\controller\user\CreateController())->Create($params_login, $params_pass, $params_email);
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
					(new \api\src\controller\user\DeleteController())->Delete($params_id);
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
					(new \api\src\controller\user\UpDate())->UpDate($params_login, $params_pass, $params_email, $params_id);
				} else {
					echo 'Увы но вы заполенели не все данные для обновления человека';
				}
			}
			break;
	}
} elseif ($parts_url[0] === '/admin/users') {
	if ($_SERVER["REQUEST_METHOD"] === "GET") {
		(new \api\src\controller\user\UserController())->User();
	}
} 
// elseif ($parts_url[0] === '/user') {
// 	if ($_SERVER["REQUEST_METHOD"] === "GET") {
// 		(new \api\src\controller\UserController())->User();
// 	}
// } 

if ($parts_url[0] === '/file') {
	switch ($_SERVER["REQUEST_METHOD"]) {
		case "GET":
			if ($data) {
				$params = $data['id'];
				// $params = array_key_exists('id' , $data);
				(new \api\src\controller\file\ReadFileController())->ReadFileOne($params);
			} else {
				(new \api\src\controller\file\FileController())->File();
			}
			break;
		case "POST":
			if ($_POST['file']) {
				if (isset($_POST['name']) && $_POST['type'] === "image/jpeg") {
					$params_login = $_POST['name'];
					$params_pass = $data['pass'];
					$params_email = $data['email'];
					(new \api\src\controller\file\CreateController())->Create($params_login, $params_pass, $params_email);
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
					(new \api\src\controller\file\DeleteFileController())->DeleteFile($params_id);
				} else {
					echo "id должен быть числовой";
				}
			} else {
				echo "id не записан";
			}
			break;
		// case "PUT":
		// 	if ($data) {
		// 		if (isset($data['login']) && isset($data['pass']) && isset($data['email']) && isset($data['id'])) {
		// 			$params_login = $data['login'];
		// 			$params_pass = $data['pass'];
		// 			$params_email = $data['email'];
		// 			$params_id = $data['id'];
		// 			(new \api\src\controller\UpDate())->UpDate($params_login, $params_pass, $params_email, $params_id);
		// 		} else {
		// 			echo 'Увы но вы заполенели не все данные для обновления человека';
		// 		}
		// 	}
		// 	break;
	}
} elseif ($parts_url[0] === '/direct') {
	switch ($_SERVER["REQUEST_METHOD"]) {
		case "GET":
			if ($data) {
				$params = $data['id'];
				// $params = array_key_exists('id' , $data);
				(new \api\src\controller\dir\ReadDirController())->ReadDirOne($params);
			} else {
				(new \api\src\controller\dir\DirController())->Dir();
			}
			break;
		case "POST":
			if ($data) {
				$params_name = $data['name'];
				$params_id = $data['id'];
				// $params = array_key_exists('id' , $data);
				(new \api\src\controller\dir\CreateDirController())->CreateDir($params_name, $params_id);
			}
			
		// 	break;
		// case "DELETE":
		// 	if ($data) {
		// 		if ($data['id'] && is_numeric($data['id'])) {
		// 			$params_id = $data['id'];
		// 			(new \api\src\controller\DeleteFileController())->DeleteFile($params_id);
		// 		} else {
		// 			echo "id должен быть числовой";
		// 		}
		// 	} else {
		// 		echo "id не записан";
		// 	}
		// 	break;
		// case "PUT":
		// 	if ($data) {
		// 		if (isset($data['login']) && isset($data['pass']) && isset($data['email']) && isset($data['id'])) {
		// 			$params_login = $data['login'];
		// 			$params_pass = $data['pass'];
		// 			$params_email = $data['email'];
		// 			$params_id = $data['id'];
		// 			(new \api\src\controller\UpDate())->UpDate($params_login, $params_pass, $params_email, $params_id);
		// 		} else {
		// 			echo 'Увы но вы заполенели не все данные для обновления человека';
		// 		}
		// 	}
		// 	break;
	}
}
