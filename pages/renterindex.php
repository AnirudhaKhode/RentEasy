<html>
<doctype! html>
<head>
<title>Rent and Ride</title>
<link rel="stylesheet" href="../CSS/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-sm navbar-dark">
  <ul class="navbar-nav col-13">
	  
    <li class="nav-item col-2 " style=''><img src='../images/logo.png' height='50px'/></li>
    <li class="nav-item col-1 " style='margin:0 2% 0 20% ;text-align:center'><a class='nav-link' href="renterindex.php" >Home</a></li>
	<li class="nav-item col-1 " style='margin:0 2% 0 2% ;text-align:center;padding:0px'><a class='nav-link' href="#" >My Cars</a></li>
	<li class="nav-item col-1 " style='margin:0 2% 0 2% ;text-align:center'><a class='nav-link' href="#" >About</a></li>
	<li class="nav-item col-1 " style='margin:0 20% 0 2% ;text-align:center'><a class='nav-link' href="#" >Contact</a></li>
	</ul>	
	<?php
		include("myconnection.php");
		session_start();
		if(isset($_SESSION['uid']))
		{
			echo "<div class='nav-item dropdown col-2'>";
			echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='color:white;float:right;'>".$_SESSION['uid']."</a>";
			
			if($_SESSION['role']=='Renter')
			{
				echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown' style='margin-left:16%;'><a class='dropdown-item' href='allBookings.php'>All Bookings</a>";
			}
			echo "<a class='dropdown-item' href='#'>View Profile</a>";
			echo "<div class='dropdown-divider'></div>";
			echo "<button class='btn btn-primary' style='padding:0px;margin-left:23%;background-color: #212529; border: none;'><a class='nav-link' href='logout.php' style=color:white>Logout</a></button></div>";
			echo "</div>";
		}
		else
		{
			echo "<div style='float:right;'><ul class='navbar-nav'><li class='nav-item'><a class='nav-link' href='login.php' style=color:white>Login</a></li>";
			echo "<li class='nav-item '><button type='button' class='btn btn-light'><a href='register.php' style='text-decoration:none;color:black;'>Sign up</a></button></li></ul></div>";
		}
	?>
</nav>

<div class='container col-5' id='searchDiv' >
		<form action="upload.php" method="post" enctype="multipart/form-data">
        <label for='model'>Model:</label>
		<input type=text class='form-control' name='model' id='model' placeholder='Enter Car Model' required />
        <label for='brand'>Brand:</label>
		<input type=text class='form-control' name='brand' id='brand' placeholder='Enter Car Brand' required />
        <label for='vehicleno'>Vehicle No.:</label>
		<input type=text class='form-control' name='vehicleno' id='vehicleno' placeholder='Enter Vehicle number' required />
        <label for='seatingcapacity'>Seating Capacity:</label>
		<input type=number class='form-control' name='seatingcapacity' id='seatingcapacity' placeholder='Enter Number of Seats' min='2' required />
        <label for='colour'>Colour:</label>
		<input type=text class='form-control' name='colour' id='colour' placeholder='Enter Colour' required />
        <label for='price'>Price:</label>
		<input type=number class='form-control' name='price' id='price' placeholder='Enter Price per day' required />
        <label for='description'>Description:</label>
		<input type=text class='form-control' name='description' id='description' placeholder='Pleace add points seperated by |' required />
        <?php
		include("myconnection.php");
		$r=$con->query('select * from citystate order by City Asc;');
		echo "<label for='availableat'>Available At:</label>";
		echo "<select name='availableat' class='form-control' id='availableat' required>";
		while($row=$r->fetch_assoc())
		{
			$option=$row['City'].", ".$row['State'];
			echo $option;
			echo "<option value='$option' >$option</option>";
		}
		echo "</select><br>";
		?>
        <label>Select image to upload:</label>
		<input type="file" class='form-control' name="fileToUpload" id="fileToUpload">
		<input type="submit" style="background:white;width:35%" value="Submit" name="submit">
		</form>
</div>

</body>
</html>
