<html>
<doctype! html>
<head>
<title>Rent and Ride</title>
<link rel="stylesheet" href="../CSS/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
	function todayDate()
	{	
		let today = new Date(),
		day = today.getDate(),
		month = today.getMonth()+1,
		year = today.getFullYear();
			if(day<10){
					day='0'+day
				} 
			if(month<10){
				month='0'+month
			}
			today = year+'-'+month+'-'+day;
			let time= new Date();
			time = "0"+time.getHours() + ":" + "0" +time.getMinutes() + ":" + time.getSeconds();
			console.log(time);
			document.getElementById("pickupDate").setAttribute("min",today);
			document.getElementById("returnDate").setAttribute("min",today);
			// document.getElementById("pickupTime").setAttribute("min",time);
	}
	
	function Dropdatecheck()
	{	
		if(document.getElementById("pickupDate").value>document.getElementById("returnDate").value)
		{
			document.getElementById("returnDate").value=null;
			alert("Drop date should be greater than Pickup Date");
		}
	}
</script>
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
				header("location:renterindex.php");
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
		<form method='POST'>
		<?php
		include("myconnection.php");
		$r=$con->query('select * from citystate order by City Asc;');
		echo "<label for='pickup'>Pickup Location</label>";
		echo "<select name='pickupLocation' class='form-control' id='pickup'>";
		while($row=$r->fetch_assoc())
		{
			$option=$row['City'].", ".$row['State'];
			echo $option;
			echo "<option value='$option' >$option</option>";
		}
		echo "</select><br>";
		?>
		<input type=date class='form-control' placeholder='Pick-up Date' onclick=todayDate() name='pickupDate' id='pickupDate' required>
		<input type=time class='form-control' placeholder='Pick-up Time' min='00:00:00' name='pickupTime' id='pickupTime' required>
		<?php
		include("myconnection.php");
		$r=$con->query('select * from citystate order by City Asc;');
		echo "<label for='drop'>Drop Location</label>";
		echo "<select name='dropLocation' class='form-control' id='drop' required>";
		while($row=$r->fetch_assoc())
		{
			$option=$row['City'].", ".$row['State'];
			echo $option;
			echo "<option value='$option' >$option</option>";
		}
		echo "</select><br>";
		?>
		<input type=date class='form-control' placeholder='Return Date' oninput=Dropdatecheck() name='returnDate' id='returnDate' required>
		<input type=time class='form-control' placeholder='Return Time' name='returnTime' id='returnTime' required>
		<button type=submit class="btn btn-light" onclick=Dropdatecheck() style='width: 50%; margin-left: 25%;'>Search</button>
		</form>
</div>


<?php
// session_start();

if(isset($_POST['pickupLocation']))
{
	$_SESSION['Pickup_Location']=$_POST['pickupLocation'];
	$_SESSION['Drop_Location']=$_POST['dropLocation'];
	$_SESSION['Pickup_DateTime']=$_POST['pickupDate']." ".$_POST['pickupTime'].":00";
	$_SESSION['Drop_DateTime']=$_POST['returnDate']." ".$_POST['returnTime'].":00";
	
	function dateDiffInDays($date1, $date2) 
	{
		$diff = strtotime($date2) - strtotime($date1);
		return abs(round($diff / 86400));
	} 

	$No_of_Days = dateDiffInDays($_POST['pickupDate'],$_POST['returnDate']);
	$_SESSION['No_of_Days']=$No_of_Days;
	// echo "<h1 style='color:white'>".$No_of_Days."</h1>";
	header('Location: searchCar.php');
}

$con->close();
?>
</body>
</html>
