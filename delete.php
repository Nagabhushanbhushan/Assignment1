<?php


session_start();
if (isset($_GET['d'])) {
	$id = $_GET['d'];
	include 'conn.php';

	$del = "DELETE FROM `cars` WHERE `cars`.`id` = '$id';";

$query = mysqli_query($conn, $del);

if($query){
$_SESSION['message'] = 'deleted';
	header("Location: index.php");
}
else{
$_SESSION['message'] = 'error_delete';
	header("Location: index.php");
}


}


	?>