<?php
session_start();


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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btn">
  Add New Car
</button>
<hr>

<?php 
if (isset($_SESSION['message'])) {

	$message = $_SESSION['message'];

	  if($message == "saved"){ ?>
	  	<hr>
      <div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Successfully Saved!</strong> Car details has been saved.
</div>
	<?php 
session_unset();
session_destroy();
	 }
	 if($message == "invalidReq"){ ?>
	  	<hr>
      <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Invalid Request!</strong> Try selecting a row for editing
</div>
	<?php 
session_unset();
session_destroy();
	 }


	  if($message == "edited"){ ?>
	  	<hr>
      <div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong>Data has been edited
</div>
	<?php 
session_unset();
session_destroy();
	 }

	  if($message == "error_update"){ ?>
	  	<hr>
      <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error!</strong>Sorry the data couldnot be edited try again later.
</div>
	<?php 
session_unset();
session_destroy();
	 }


	 if($message == "deleted"){ ?>
	  	<hr>
      <div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Deleted Successfully!</strong>Data Has been deleted
</div>
	<?php 
session_unset();
session_destroy();
	 }


	  if($message == "error_delete"){ ?>
	  	<hr>
      <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Sorry Couldn't Delete!</strong>Please try again later
</div>
	<?php 
session_unset();
session_destroy();
	 }
	 
	# code...
}
?>

<h3>Recent Cars</h3>
<a href="search.php" style="float:right;" class="btn btn-warning">Search Cars</a>

<?php
include 'conn.php';

$fetch = "SELECT * FROM `cars`;";
$query = mysqli_query($conn, $fetch);

$count = mysqli_num_rows($query);
if ($count == 0) {	?>
	<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>No Data!</strong> Looks like you have not added any data Mr Bean. Try adding new data and try again.
</div>
 <?php } 
 else{
 ?>
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

<?php  } ?>

<br>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title">Add  Car</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
       <form class="text-dark text-left" method="post" action="add-car.php">
        	<label>Company:<span class="text-danger">*</span></label>
        	<input type="text" name="company" placeholder="Please Enter Car's Company Name" class="form-control" required="">
        	<br>
        	<label>Model:<span class="text-danger">*</span></label>
        	<input type="text" name="model" placeholder="Please Enter Car's Model" class="form-control" required="">
        	<br>
        	<label>Color:<span class="text-danger">*</span></label>
        	<input type="text" name="color" placeholder="Please Enter Car's Color" class="form-control" required="">
        	<br>
        	<label>Purchased Date:<span class="text-danger">*</span></label>
        	<select class="form-control" name="date">
        		<option selected="" disabled=""> -- Select Year Of Purchase-- </option>
        		<?php 
        		$year = array(1950,1951,1952,1953,1954,1955,1956,1957,1958,1959,1960,1961,1962,1963,1964,1965,1966,1967,1968,1969,1970,1971,1972,1973,1974,1975,1976,1977,1978,1979,1980,1981,1982,1983,1984,1985,1986,1987,1988,1989,1990,1991,1992,1993,1994,1995,1996,1997,1998,1999,2000,2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015,2016,2017,2018,2019,2020); 
        		$arrlength = count($year);
			for($x = 0; $x < $arrlength; $x++) {?>
			    <option value="<?php echo $year[$x]; ?>">
			    	<?php echo $year[$x]; ?></option>
		<?php	}

        		?>
        		
        	</select>
       
        	<br>
        	<label>Price:<span class="text-danger">*</span></label>
        	<input type="number" name="price" placeholder="Please Enter year of purchase" class="form-control" required="" >

        	<br>
        	<label>Engine Capacity:<span class="text-danger">*</span></label>
        	<input type="number" name="capacity" placeholder="Please Enter Engine Capacity" class="form-control" required="" >
        	<br>
        	<label>Licence Plate no:<span class="text-danger">*</span> (without space or symbol)</label>
        	<input type="TEXT" name="no" placeholder="Please Enter Licence Plate no. " class="form-control" required="" >
        	<br>
        	<label>Seating Capacity:<span class="text-danger">*</span> </label>
        	<input type="number" name="seat" placeholder="Please Enter Seating Capacity " class="form-control" required="" >
        	<br>
        	<input type="submit" name="save" class="btn btn-info" value="Save Now">
        </form>
      </div>

      

    </div>
  </div>
</div>


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