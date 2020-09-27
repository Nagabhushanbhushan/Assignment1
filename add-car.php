<?php
session_start();

include 'conn.php';

$company = trim($_POST['company']);
$model = trim($_POST['model']);
$color = trim($_POST['color']);

$date = trim($_POST['date']);
$price = trim($_POST['price']);

$capacity = trim($_POST['capacity']);
$no = trim($_POST['no']);
$seat = trim($_POST['seat']);

$insert = "INSERT INTO `cars` (`company`, `model`, `color`, `dop`, `price`, `engcap`, `no`, `seat`) VALUES ('$company', '$model', '$color', '$date', '$price', '$capacity', '$no', '$seat');";
$push = mysqli_query($conn, $insert);

if($push){
	$_SESSION['message'] = 'saved';
	header("Location: index.php");
}

?>