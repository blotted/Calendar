<?php
$id = abs ((int) $_GET['event']);

if($id) {
	require_once 'inc/db_connect.php';
	$sql = "DELETE FROM random_dates WHERE id = ?";

	if($stmt = $mysqli->prepare($sql)) {
		$stmt->bind_param('i', $id);
		$stmt->execute();
	}
}

header('HTTP/1.1 307 Temporary Redirect');
header('Location: all_events.php');
exit;