<?php

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
	(new \api\src\controller\user\ReadController())->Read($params);

	echo "<br>";

	(new \api\src\controller\dir\CheakDirController())->Cheak($params); ?>

	<form action="/" method="POST" enctype="multipart/form-data">
		<label>
			<input name="file" type="file">
		</label>
		<label>
			<input type="submit" name="file">
		</label>
	</form>
	<form action="/" method="POST">
		<label>
			<input name="name" type="text" placeholder="введите название папки">
		</label>
		<label>
			<input type="submit" name="dir">
		</label>
	</form>

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
if ($_POST['dir']) {
	$params_name = $_POST['name'];
	
	(new \api\src\controller\dir\CreateDirController())->CreateDir($params_name, $params);
}
require_once __DIR__ . "/src/setting/setting.php";