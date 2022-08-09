<html>
<doctype! html>
<head>
<title>Rent and Ride</title>
<link rel="stylesheet" href="../CSS/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../CSS/main.css">

<style>
label{
  color:black;
  font-weight: 500;
}
</style>

</head>

<body>
<nav class="navbar navbar-expand-sm navbar-dark">
  <ul class="navbar-nav col-13">
	  
    <li class="nav-item col-2 " style=''><img src='../images/logo.png' height='50px'/></li>
    <li class="nav-item col-1 " style='margin:0 2% 0 20% ;text-align:center'><a class='nav-link' href="index.php" >Home</a></li>
	<li class="nav-item col-1 " style='margin:0 2% 0 2% ;text-align:center'><a class='nav-link' href="#" >Explore</a></li>
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
			
			if($_SESSION['role']=='User')
			{
				echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown' style='margin-left:16%;'><a class='dropdown-item' href='MyBookings.php'>My Bookings</a>";
			}
			else
			{
				echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown' style='margin-left:16%;'><a class='dropdown-item' href='#'>All Bookings</a>";
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
<?php

$Car_Id=$_GET['Car_Id'];
if(!isset($_SESSION['uid']))
{
    header("location:login.php?Car_Id=$Car_Id");
}

$Pickup_Location=$_SESSION['Pickup_Location'];
$Drop_Location=$_SESSION['Drop_Location'];
$Pickup_DateTime=$_SESSION['Pickup_DateTime'];
$Drop_DateTime=$_SESSION['Drop_DateTime'];
$No_of_Days=$_SESSION['No_of_Days'];

// echo $Car_Id."<br>".$Pickup_Location."<br>".$Drop_Location."<br>".$Pickup_DateTime."<br>".$Drop_DateTime."<br>".$No_of_Days."<br>";

echo "<div class='col-8' style='float:left;margin:5%;background:#e9ecefc2;box-shadow: 2px 2px 5px black, 5px 5px 10px white;'>";
	echo "<h3>Confirm Booking Details</h3>";
	echo "<label>Pickup Location : </label>"." "."$Pickup_Location<br>";
	echo "<label>Drop Location : </label>"." "."$Drop_Location<br>";
	echo "<label>Pickup Date-Time : </label>"." "."$Pickup_DateTime<br>";
	echo "<label>Drop Date-Time : </label>"." "."$Drop_DateTime<br>";
	echo "<button  class='pbtn' style='cursor: pointer;margin-bottom:2%' id='request'><a href='BookCar.php?Car_Id=$Car_Id' style='text-decoration:none;'>Confirm</a></button>";
	echo "</div>";

// echo "<button type=button ><a href='BookCar.php?Car_Id=$Car_Id'>Confirm</a></button>";

$con->close();
?>
</body>
</html>

