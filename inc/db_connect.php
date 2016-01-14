<?php
define('DB_NAME','calendar');
define('DB_HOST','localhost');
define('DB_USER','calendar');
define('DB_PASS','calendar');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
} else {
	$sql = "SET NAMES 'UTF-8'";
	$mysqli->query($sql);	
}