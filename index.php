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

	(new \api\src\controller\dir\CheakDirController())->Cheak(); ?>

	<form action="/" method="POST" enctype="multipart/form-data">
		<label>
			<input name="file" type="file">
		</label>
		<label>
			<input type="text" name="dirid"  placeholder="введите id папки">
		</label>
		<label>
			<input type="submit" name="fileDir">
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

	<form action="/" method="POST">
		<label>
			<input name="last_name" type="text" placeholder="введите новое название файла">
		</label>
		<label>
			<input name="id" type="text" placeholder="введите id файла">
		</label>
		<label>
			<input type="submit" name="reset_name">
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
	
	(new \api\src\controller\dir\CreateDirController())->CreateDir($params_name);
}

if ($_POST['reset_name']) {
	$params_name = $_POST['name'];
	$params_id = $_POST['id'];
	
	(new \api\src\controller\file\UpfileDate())->UpfileDate($params_name, $params_id);
}

if ($_POST['fileDir']) {
	if ($_FILES['file']['type'] === "image/jpeg") {
		$params_name = $_FILES['file']['name'];
		$params_dir = $_POST['dirid'];
		(new \api\src\controller\file\CreateFileController())->Create($params_name, $params_dir);
	}
}
require_once __DIR__ . "/src/setting/setting.php";