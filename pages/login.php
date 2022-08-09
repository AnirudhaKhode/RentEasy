<html>
<Doctype!html>
<head>
<title>Rent and Ride</title>
<link rel="stylesheet" href="../CSS/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<style>
form
{
	padding:3%;
	margin-left:20%;
	margin-top:10%;	
}
button>a,button>a:hover
{
	text-decoration:none;
}
</style>
<script>
function ViewPass()
{
	if(document.getElementById("pwd").type=='text')
	{document.getElementById("pwd").type='password';}
	else
	{document.getElementById("pwd").type='text';}
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
			echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown' style='margin-left:16%;'><a class='dropdown-item' href='#'>My Bookings</a>";
			echo "<a class='dropdown-item' href='#'>View Profile</a>";
			echo "<div class='dropdown-divider'></div>";
			echo "<button class='btn btn-primary' style='padding:0px;margin-left:23%;'><a class='nav-link' href='logout.php' style=color:white>Logout</a></button></div>";
			echo "</div>";
		}

		else
		{
			echo "<div style='float:right;'><ul class='navbar-nav'><li class='nav-item'><a class='nav-link' href='login.php' style=color:white>Login</a></li>";
			echo "<li class='nav-item '><button type='button' class='btn btn-light'><a href='register.php' style='text-decoration:none;color:black;'>Sign up</a></button></li></ul></div>";
		}
	?>
</nav>
<div class="container "  >
<form method=post style=width:75% >
<label>Email Id</label><br><input type=email name='uid' placeholder="Enter Email"  class="form-control"><br>
<label>Password</label><br><input type=password name='pwd' id='pwd' placeholder="Enter Password" class="form-control"><br>
<label>Role</label><br><input type=radio name='role'value='User' class='role' > <span style='color:white'>User</span> <input type=radio name='role'value='Renter' class='role' > <span style='color:white'>Renter </span><br><br>
<input type=checkbox onclick='ViewPass()'><span style='color:white'> Show Password </span>
<a href="#" style='float:right;text-decoration:none'>Forgot password?</a><br>
<p style=float:right><span style='color:white'>Don't have an account?</span><a href="register.php" style='text-decoration:none' > Sign up</a></p><br>
<br>
<button type=submit class="btn btn-light">Login</button>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['uid']))
{$uid=$_POST['uid'];
$pwd=$_POST['pwd'];
$role=$_POST['role'];
include("myconnection.php");
if($role=='User')
{
	$r=$con->query("select * from customerdetails where Email_ID='$uid' && Password='$pwd'");
if($row=$r->fetch_assoc())
{	
$_SESSION["uid"]=$row['Email_Id'];
$_SESSION["pwd"]=$row['Password'];
$_SESSION["role"]='User';
// echo $_SESSION["uid"];
if(isset($_GET['Car_Id']))
{
	$Car_Id=$_GET['Car_Id'];
	header("location:ConfirmBooking.php?Car_Id=$Car_Id");
}
else
{
	header("location:index.php");
}
}
else
{
	echo "<p style='color:white;margin-left:30%'>Invalid User_id/password</p>";
}
}

if($role=='Renter')
{
$r=$con->query("select * from ownerdetails where Owner_Id='$uid' && Password='$pwd'");
if($row=$r->fetch_assoc())
{	
$_SESSION["uid"]=$row['Owner_Id'];
$_SESSION["pwd"]=$row['Password'];
$_SESSION["role"]='Renter';
// echo $_SESSION["uid"];
header("location:index.php");
}
else
{
	echo "<p style='color:white;margin-left:30%'>Invalid User_id/password</p>";
}
}

$con->close();
}

?>