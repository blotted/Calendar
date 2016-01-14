<?php
require_once 'inc/db_connect.php';

$sql = "SELECT random_dates.id, random_dates.date, random_dates.event_name
		FROM random_dates
		ORDER BY random_dates.date DESC";
$res = $mysqli->query($sql);

if($res->num_rows) {
	$events = $res->fetch_all(MYSQLI_ASSOC);

	echo <<<TABLE
			<table border='1'>
				<thead>
					<th>Дата</th>
					<th>Название события</th>
					<th></th>
				</thead>
				<tbody>		
TABLE;
			foreach ($events as $event) {
				echo "<tr>
					<td>{$event['date']}</td>
					<td>{$event['event_name']}</td>
					<td>
					<a href='edit_events.php?event={$event['id']}'>Редактировать</a>&nbsp;
					<a href='delete_events.php?event={$event['id']}'>Удалить</a>
					</td>
				</tr>";
			}

			echo <<<ENDTABLE
			</tbody>
			</table><br>
ENDTABLE;
} else {
	echo "Нет событий.<br><br>";
}

echo "<a href=\"add_date.php\">Добавить новый выходной</a><br>";
echo "<a href=\"index.php\">Вернуться к календарю</a>";