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
<?php

$Car_Id=$_GET['Car_Id'];
$No_of_Days=$_GET['No_of_Days'];
// echo "<h1 style='color:white'>".$No_of_Days."</h1>";
include('myconnection.php');
$r=$con->query("select * FROM cardetails where Car_ID='$Car_Id';");
while($row=$r->fetch_assoc())
{
	$x="./uploads/";
	$image=$x.$row['Img'];
    $TotalPrice=$No_of_Days*$row['Price'];
	$y=explode("|",$row['Description']);
	echo "<a href=../images/$row[Img]><img src='$image' style='margin-top:8%' class='col-4'></a>";
	echo "<div class='col-8' style='float:left;margin:5%;background:#e9ecefc2;box-shadow: 2px 2px 5px black, 5px 5px 10px white;'>";
	echo "<h3>$row[ModelName]</h3>";
	echo "<h4>$row[Brand]</h4>";
	echo "<label>Seating Capacity : </label>"." "."$row[SitingCapacity]<br>";
	echo "<label>Available at : </label>"." "."$row[AvailableAtCity]<br>";
	echo "<label>Renter : </label>"." "."$row[Owner_Id]<br>";
	echo "<label>Price : </label>"." "."$TotalPrice"." /-"."<br>";
	echo "<ul><li>$y[0]</li><li>$y[1]</li><li>$y[2]</li></ul>";
	echo "<button  class='pbtn' style='cursor: pointer;margin-bottom:2%' id='request'><a href='ConfirmBooking.php?Car_Id=$row[Car_Id]' style='text-decoration:none;'>Book Now</a></button>";
	echo "</div>";
}

$con->close();
?>
</body>
</html>
