<?php
session_start();
if (isset($_GET['e'])) {
	$id = $_GET['e'];
	# code...

include 'conn.php';

$company = trim($_POST['company']);
$model = trim($_POST['model']);
$color = trim($_POST['color']);

$da = trim($_POST['date']);
$price = trim($_POST['price']);

$capacity = trim($_POST['capacity']);
$no = trim($_POST['no']);
$seat = trim($_POST['seat']);

$update = "UPDATE `cars` SET `company` = '$company', `model` = '$model', `color` = '$color', `dop` = '$da', `price` = '$price', `engcap` = '$capacity', `no` = '$no', `seat` = '$seat' WHERE `cars`.`id` = $id";
$push = mysqli_query($conn, $update);

if($push){
	$_SESSION['message'] = 'edited';
	header("Location: index.php");
}
else{
	$_SESSION['message'] = 'error_update';
	header("Location: index.php");
}

}
else{
	$_SESSION['message'] = 'error_update';
	header("Location: index.php");
}
?>