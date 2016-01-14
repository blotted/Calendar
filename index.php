<?php
require_once "inc/lib.inc.php";
require_once 'inc/db_connect.php';

$self = $_SERVER['PHP_SELF'];
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link href="main.css" media="all" rel="stylesheet" type="text/css" />
	<title>Календарь</title>
</head>
<body>
<?php
echo selectDate($month, $year);
echo makeCalendar($month, $year);
?>
	<p><a href="all_events.php">Добавление и редактирование выходных</a></p>
</body>
</html>