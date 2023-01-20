<?php
// error_reporting(E_ALL);
// ini_set('display_errors',true);
// header('Content-Type: application/json');
session_start();
require_once __DIR__ . "/bootstrap.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Облачное хранилище</title>
</head>
<body>
<?php if ($_SESSION['user']): ?>
	<?php $res = [
		"status" => true,
		"massage" => 'Вы вошли в аккаунт :з'
	];
	//var_dump($_SESSION['id']);
	$params = $_SESSION['id']['id'];
	echo json_encode($res, JSON_UNESCAPED_UNICODE);
	?>
	<a href="logout.php">выйти из аккаунта</a>
	<?php
	echo '<br>';
	(new \api\src\controller\ReadController())->Read($params); ?>
	<?php else:?>
	<form action="/" method="GET">
		<label>
			<input name="email" type="text" placeholder="введите майл">
		</label>
		<label>
			<input name="pass" type="password" placeholder="введите пароль">
		</label>
		<label>
			<input type="submit" name="log">
		</label>
	</form>
	<?php endif;?>
</body>
</html>

<?php

require_once __DIR__ . "/src/setting/setting.php";