<?
require_once 'inc/db_connect.php';

if($_SERVER["REQUEST_METHOD"] == 'POST'){
	
	$id = abs((int) $_POST['id']);

	$data = trim(strip_tags($_POST['date']));
	$event_name = trim(strip_tags($_POST['event']));

	$sql = "UPDATE random_dates SET `date` = ?, event_name = ?
			WHERE id = ?";

	if($stmt = $mysqli->prepare($sql)) {

		$stmt->bind_param('ssi', $data, $event_name, $id);
		$stmt->execute();

		header('HTTP/1.1 307 Temporary Redirect');
		header('Location: all_events.php');
		exit;
	}
}