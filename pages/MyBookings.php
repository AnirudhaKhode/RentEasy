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
</body>
</html>



<?php
include("myconnection.php");

if(isset($_SESSION['uid']))
{
    $Email_Id=$_SESSION['uid'];
    $r=$con->query("select rentdetails.Owner_Id, rentdetails.Pickup_Location, rentdetails.Drop_Location, rentdetails.Pickup_DateTime, rentdetails.Drop_DateTime,rentdetails.Fare_Charges,ModelName,Brand,SitingCapacity,Img,Description,rentdetails.Status as Status FROM rentdetails, cardetails WHERE Email_Id='$Email_Id' and rentdetails.Car_Id = cardetails.Car_Id ");
    while($row=$r->fetch_assoc())
    {
        echo "<div style='color:white;margin:2%;'>".$row['Owner_Id']."<br>".$row['Pickup_Location']."<br> ".$row['Drop_Location']."<br> ".$row['Pickup_DateTime']."<br> ".$row['Drop_DateTime']."<br> ".$row['Fare_Charges']."/-<br> ".$row['ModelName']."<br> ".$row['Brand']."<br> ".$row['SitingCapacity']."<br> ".$row['Img']."<br> ".$row['Description']."<br> ".$row['Status']."<br></div> ";
    }
}
else
{
    header("location:login.php");
}

?>