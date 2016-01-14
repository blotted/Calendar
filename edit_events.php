<?php
require_once 'inc/db_connect.php';

$id = abs((int) $_GET['event']);

$sql = "SELECT random_dates.id, random_dates.date, random_dates.event_name
		FROM random_dates
		WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();

$res = $stmt->get_result();
$row = $res->fetch_row();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Редактирование выходного дня</title>
	<style type="text/css">
		div{margin-bottom: 10px;}
	</style>
</head>
<body>
	<form action="update_events.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<div>
			<label for="title">Дата</label>
			<input id="title" type="text" name="date" value="<?php echo $row[1]; ?>">
		</div>
		<div>
			<label for="mark">Название события</label>
			<input id="mark" type="text" name="event" value="<?php echo $row[2]; ?>">
		</div>
		<div>
			<input type="submit" value="Редактировать выходной день">
		</div>
	</form>
	<a href="all_events.php">Вернуться к списку выходных</a>
</body>
</html>