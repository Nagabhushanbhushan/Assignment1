 <?php
session_start()


 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Mr Bean's Personal Cars</title>
  <!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="style.css">
</head>


<body id="main">

<br><br>
	<section class="container text-white text-center p-3" id="layer">
		<br>
		<h3 class="border-btn">Mr. Bean's Personal Car Collection
		</h3>

<hr>
<div class="col-md-6 m-auto border p-3 bg-white text-dark text-center">
<form action="search.php" method="post" class="form-inline">
  <label>Enter Query: </label>
  <input type="text" name="query">

  <input type="submit" name="key" value="Search" class="btn btn-info">
</form>
<span >Or</span>
<form action="search.php" method="post" class="form-inline">
  <label>Enter Range: </label>
   <input type="number" name="low" placeholder="Lowest Price">
   <input type="number" name="high" placeholder="Highest Price">

  <input type="submit" name="range" value="Search" class="btn btn-info">
</form>
</div>
<hr>



<a href="index.php" style="float:right;" class="btn btn-info">Go to home page</a>

<?php
include 'conn.php';

if(isset($_POST['key'])){
  $key = trim($_POST['query']);
 

$fetch = "SELECT * FROM `cars` WHERE `color` LIKE '%$key%' OR `model` LIKE '%$key%' OR `dop` = '$key'  OR `company` LIKE '%$key%';";
$query = mysqli_query($conn, $fetch);

$count = mysqli_num_rows($query);
if ($count == 0) {	?>
	<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>No Data!</strong> Looks like there's no data matching the query. Try different query
</div>
 <?php } 
 else{
 ?>
 <h3>Search Results for: <?php echo $key;  ?></h3>
 <table class="table table-bordered table-sm text-white table-striped">
 	<tr>
 	<th>Sl. No</th>
 	<th>Company</th>
 	<th>Model</th>
 	<th>Color</th>
 	<th>Date</th>
  <th>Price</th>
 	<th>Engine Capacity</th>
 	<th>Car No</th>
 	<th>Seat Capacity</th>
 	<th>Action</th>
    </tr>
		<?php 
		$i = 1;
     while ($row = mysqli_fetch_assoc($query)) {
     	 ?>

     	 <tr>
     	 	<td><?php echo $i; ?></td>
     	 	<td><?php echo $row['company']; ?></td>
     	 	<td><?php echo $row['model']; ?></td>
     	 	<td><?php echo $row['color']; ?></td>
     	 	<td><?php echo $row['dop']; ?></td>
<td><?php echo $row['price']; ?></td>
     	 	<td><?php echo $row['engcap']; ?></td>
     	 	<td><?php echo $row['no']; ?></td>
     	 	<td><?php echo $row['seat']; ?></td>
     	 	<td>
                <a href="edit.php?e=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
     	 		<a href="delete.php?d=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i></a>
     	 			
     	 		</td>

     	 </tr>

   <?php  $i = $i +1;  }
  
		?>

 </table>

<?php  }

} // if post

///////////////////////////////////////////////////////////////////////
  if(isset($_POST['range'])){
  $low = trim($_POST['low']);
  $high = trim($_POST['high']);
  

$fetch = "SELECT * FROM `cars` WHERE `price` BETWEEN '$low' AND 'high';;";
$query = mysqli_query($conn, $fetch);

$count = mysqli_num_rows($query);
if ($count == 0) {  ?>
  <div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>No Data!</strong> Looks like there's no data matching the query. Try different query
</div>
 <?php } 
 else{
 ?>
 <h3>Search Results for range: 
  <?php echo $low;  ?> - <?php echo $high;?>
    
  </h3>
 <table class="table table-bordered table-sm text-white table-striped">
  <tr>
  <th>Sl. No</th>
  <th>Company</th>
  <th>Model</th>
  <th>Color</th>
  <th>Date</th>
  <th>Price</th>
  <th>Engine Capacity</th>
  <th>Car No</th>
  <th>Seat Capacity</th>
  <th>Action</th>
    </tr>
    <?php 
    $i = 1;
     while ($row = mysqli_fetch_assoc($query)) {
       ?>

       <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['company']; ?></td>
        <td><?php echo $row['model']; ?></td>
        <td><?php echo $row['color']; ?></td>
        <td><?php echo $row['dop']; ?></td>
        <td><?php echo $row['engcap']; ?></td>
        <td><?php echo $row['no']; ?></td>
        <td><?php echo $row['seat']; ?></td>
        <td>
                <a href="edit.php?e=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
          <a href="delete.php?d=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i></a>
            
          </td>

       </tr>

   <?php  $i = $i +1;  }
  
    ?>

 </table>

<?php  }

} // if post

 ?>

<br>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
	</section>

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>