<?php
require_once 'inc/lib.inc.php';

if($_SERVER["REQUEST_METHOD"] == 'POST'){

	$data = trim(strip_tags($_POST['data']));
	$event = trim(strip_tags($_POST['event']));
	
	if((!has_presence_string($data)) or (!has_presence_string($event))) {
		// можно еще проверить на тип и формат вводимых данных
		echo "Заполните все поля";
	} else {
		require_once 'inc/db_connect.php';
		$sql = "INSERT INTO random_dates (`date`, `event_name`) VALUES (?, ?)";
		
		if ($stmt = $mysqli->prepare($sql)) {
		    
			$stmt->bind_param('ss', $data, $event);
			$stmt->execute();
			$stmt->close();

			header("Location: all_events.php");
			exit;
		} else {
			echo "Ошибка при добавлении.";
		}
	}
}
?>


<!DOCTYPE html>
<html lang="RU">
<head>
	<meta charset="UTF-8">
	<title>Добавить выходной</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<div>
			<label for="inp">Дата выходного
			<input id="inp" type="text" name="data" value="<?php echo date('Y-m-d', time()); ?>"></label>
		</div>
		<div>
			<label for="inp">Название события
			<input id="inp" type="text" name="event"></label>
		</div>
		<input type="submit" value="Добавить">
	</form>
	<br>
	<a href="all_events.php">К списку выходных</a><br>
	<a href="index.php">Вернуться к календарю</a>
</body>
</html>