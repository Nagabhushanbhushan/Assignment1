<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "bean";


$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
	echo "Db Connection failed";
}

?>