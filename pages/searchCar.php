<html>
<doctype! html>
<head>
<title>Rent and Ride</title>
<link rel="stylesheet" href="../CSS/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<meta charset="UTF-8">
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<link rel="stylesheet" href="../CSS/main.css">
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

$Pickup_Location=$_SESSION['Pickup_Location'];
$Drop_Location=$_SESSION['Drop_Location'];
$Pickup_DateTime=$_SESSION['Pickup_DateTime'];
$Drop_DateTime=$_SESSION['Drop_DateTime'];
$No_of_Days=$_SESSION['No_of_Days'];
$count=0;



include('myconnection.php');
$r=$con->query("select * FROM cardetails WHERE AvailableAtCity='$Pickup_Location' and car_id NOT IN (SELECT car_id FROM rentdetails WHERE !(( Drop_DateTime < '$Pickup_DateTime') OR (Pickup_DateTime > '$Drop_DateTime')));");
// echo "<table style='color:white;text-align:center'><th>Model Name</th><th>Brand</th><th>Siting Capacity</th><th>Price/Day</th><th>Image</th><th></th>";
while($row=$r->fetch_assoc())
{
	$x="./uploads/";
	$image=$x.$row['Img'];
    $y=explode("|",$row['Description']);
	$Discount=$row['Price']+$row['Price']*0.1;
	$count+=1;
	echo "<table style='width: auto;margin: 0% 0% 0% 11%;''>";
	echo "<tr style='margin: 0% auto;'>";
	echo "	<td style='border: 2px;' style='display: table-cell; margin: 0% 10%;'>";
	echo "	</td>";
	echo "	<td style='border: 2px;' style='display: table-cell; margin: 0% 10%;'>";
	echo "	<div style='background: #e9ecefc2;margin-top:15%;'>";
	echo "			<table class='prod' style='padding: 12px;'>";
	echo "				<tr>";
	echo "				<td  style='border: 2px;' colspan='4'>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td style='border: 2px; ' colspan='4'><img src=$image class='img'  alt=' '></td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td style='border: 2px;' colspan='4'>";
	echo "					<h1 style='height: 25px;margin: -6px 10px 25px 1px ; font-family: cursive; text-align: center;cursor: pointer;'>".$row['ModelName']."</h1>";
	echo "				</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td style='border: 2px;padding-left:25px;'><img src='../images/brand.png' width='20pc' alt=''></td>";
	echo "				<td style='border: 2px;' style='width: 17pc;padding-bottom: 6px;'>".$row['Brand']."</td>";
	echo "				<td style='border: 2px;padding-left:30px;'>#</td>";
	echo "				<td style='border: 2px;' style='width: 17pc;padding-bottom: 6px;'>".$y[0]."</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td style='border: 2px;padding-left:25px;'><img src='../images/seats.png' width='20pc ' alt=''></td>";
	echo "				<td style='border: 2px;' style='width: 17pc;padding-bottom: 6px;'>".$row['SitingCapacity']." seats</td>";
	echo "				<td style='border: 2px;padding-left:30px;'>#</td>";
	echo "				<td style='border: 2px;' style='width: 17pc;padding-bottom: 6px;'>".$y[1]."</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td style='border: 2px;padding-left:25px;'><img src='../images/Mileage.png' width='20pc' alt=''></td>";
	echo "				<td style='border: 2px;' style='width: 17pc;padding-bottom: 6px;'>Unlimited Mileage</td>";
	echo "				<td style='border: 2px;padding-left:30px;'>#</td>";
	echo "				<td style='border: 2px;' style='width: 17pc;padding-bottom: 6px;'> ".$y[2]."</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td colspan='4' style='width: 25%;padding: 10px 3px 5px 3px;'>";
	echo "					<table>";
	echo "						<tr>";
	echo "							<td style='width: 38%;font-size:25px;font-family: cursive;text-align: center;'>";
	echo "								₹".$row['Price']."/-";
	echo "							</td>";
	echo "							<td style='width: 10%;'><b style='text-decoration: line-through;font-size: 70%;'>".$Discount."</b></td>";
	echo "							<td style='width: 26%;'><b style='color: white;'>10% off</b></td>";
	echo "							<td><form method='GET' action='CarDetails.php'><input type=text name=Car_Id value=$row[Car_Id] style='display:none'><input type=number name=No_of_Days value=$No_of_Days style='display:none'><button type='submit' class='pbtn' style='cursor: pointer;' id='request' >View Details</button></form></td>";
	echo "						</tr>";
	echo "					</table>";
	echo "				</td>";
	echo "			</tr>";
	echo "		</table>";
	echo "	</div>";
	echo "	</td>";
	echo "</tr>";
	echo "</table>";
	// echo "<tr><td>$row[ModelName]</td><td>$row[Brand]</td><td>$row[SitingCapacity]</td><td>$row[Price]</td><td><img src=$image></td><td><button><a href='CarDetails.php?Car_Id=$row[Car_Id]&No_of_Days=$No_of_Days'>View Details</a></button></td></tr>";
}
if($count==0)
{
	echo"<h1 style='color:white;text-align:center;margin-top:5%'>No cars available for this location</h1>";
}

$con->close();
?>
</body>
</html>
