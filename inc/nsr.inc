<?php
// MySQL connection details
$server = "localhost";
$user = 'root';
$pass = '';
$database = 'ninjasquid';

//MySQL connection string
$db = new mysqli($server, $user, $pass, $database);

if ($db->connect_errno) {
	printf("connection Failed: %s\n", $db->connect_error);
	exit();
}
