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
// var_dump($data);

if($parts_url[0] === '/user') {
	if($_SERVER["REQUEST_METHOD"] === "GET") {
		if ($data) {
			$params = $data['id'];
			// $params = array_key_exists('id' , $data);
			(new \api\src\controller\ReadController())->Read($params);
		} else {
			(new \api\src\controller\UserController())->User();
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