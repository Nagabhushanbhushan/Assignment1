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
		<!-- Button to Open the Modal -->
<a href="index.php" class="btn btn-info" style="float: right;">Cancel / Go Back</a>
<hr>

    



<?php
include 'conn.php';
if(isset($_GET['e'])){
$e = $_GET['e'];
$fetch = "SELECT * FROM `cars` WHERE `id` = '$e';";
$query = mysqli_query($conn, $fetch);

$count = mysqli_num_rows($query);
if ($count == 0) {	?>
	<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>No Data!</strong> Looks like you are trying to edit details which doesn't exist
 <?php } 
 else{
 ?>
 
		<?php 
		$i = 1;
     while ($row = mysqli_fetch_assoc($query)) {
     	    $id  = $row['id']; 
     	    $com  = $row['company']; 
     	    $mod =  $row['model']; 
     	    $col =  $row['color']; 
     	    $dat = $row['dop']; 
          $prc = $row['price']; 
     	    $engcp =  $row['engcap']; 
     	    $vno = $row['no']; 
     	    $seatcap = $row['seat'];
     	           
  } // while loop
  ?>
  <div class="col-md-8 m-auto bg-white p-3 text-dark">
    <h3>Edit Car Details</h3>
    <form class="text-dark text-left" method="post" action="edit-save.php?e=<?php echo $id; ?>">
          <label>Company:<span class="text-danger">*</span></label>
          <input type="text" name="company" placeholder="Please Enter Car's Company Name" class="form-control" required="" value="<?php echo $com; ?>">
          <br>
          <label>Model:<span class="text-danger">*</span></label>
          <input type="text" name="model" placeholder="Please Enter Car's Model" class="form-control" required="" value="<?php echo $mod; ?>">
          <br>
          <label>Color:<span class="text-danger">*</span></label>
          <input type="text" name="color" placeholder="Please Enter Car's Color" class="form-control" required="" value="<?php echo $col; ?>">
          <br>
          <label>Purchased Date:<span class="text-danger">*</span></label>
          <input type="number" name="date" class="form-control" value="<?php echo $dat; ?>">
            
       
          <br>
          <label>Price:<span class="text-danger">*</span></label>
          <input type="number" name="price" placeholder="Please Enter year of purchase" class="form-control" required="" value="<?php echo $prc; ?>">

          <br>
          <label>Engine Capacity:<span class="text-danger">*</span></label>
          <input type="number" name="capacity" placeholder="Please Enter Engine Capacity" class="form-control" required="" value="<?php echo $engcp; ?>" >
          <br>
          <label>Licence Plate no:<span class="text-danger">*</span> (without space or symbol)</label>
          <input type="TEXT" name="no" placeholder="Please Enter Licence Plate no. " class="form-control" required="" value="<?php echo $vno; ?>">
          <br>
          <label>Seating Capacity:<span class="text-danger">*</span> </label>
          <input type="number" name="seat" placeholder="Please Enter Seating Capacity " class="form-control" required="" value="<?php echo $seatcap; ?>">
          <br>
          <input type="submit" name="save" class="btn btn-info" value="Update Now ">
        </form>
  </div>


  
<?php  } 
}

else{
  $_SESSION['message'] = 'invalidReq';
  header("Location: index.php");
}
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