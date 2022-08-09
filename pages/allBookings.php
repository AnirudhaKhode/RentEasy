<html>
<doctype! html>
<head>
<title>Rent and Ride</title>
<link rel="stylesheet" href="../CSS/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../CSS/main.css">
<style>
table>tr{
    margin-top:2%;
}

</style>
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

<?php
include('myconnection.php');
if(isset($_SESSION['uid']))
{
    $r=$con->query("select * from rentdetails where Owner_Id='$_SESSION[uid]'");
    echo "<table style='color:white;'><th>Customer Email</th><th>Car Id</th><th>Pickup Location</th><th>Drop Location</th><th>Pickup Date-time</th><th>Drop date-time</th><th>Fare charges</th><th>status</th><th></th>";
    while($row=$r->fetch_assoc())
    {
        echo "<tr><td>$row[Email_Id]";
        echo "<td>$row[Car_Id]";
        echo "<td>$row[Pickup_Location]";
        echo "<td>$row[Drop_Location]";
        echo "<td>$row[Pickup_DateTime]";
        echo "<td>$row[Drop_DateTime]";
        echo "<td>$row[Fare_Charges]";
        echo "<td>$row[Status]";
        echo "<td><button class='pbtn' style='cursor: pointer;margin-bottom:2%' id='request'><a href='renterConformation.php?uid=$_SESSION[uid]&carid=$row[Car_Id]&email=$row[Email_Id]' style='text-decoration:none;'>Confirm Booking</a></button>";
        echo "</tr>";
    }
    echo "</table>";
}

else
{
	header("location:login.php");
}
?>

</body>
</html>
