<html>
<Doctype!html>
<head>
<title>Rent and Ride</title>
<link rel="stylesheet" href="../CSS/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function ViewPass()
{
	if(document.getElementById("pwd").type=='text')
	{document.getElementById("pwd").type='password';}
	else
	{document.getElementById("pwd").type='text';}
}

function showrenterfields(x){
	// alert('Done!');
	if(x=='1')
	{
		document.getElementById('RenterFields').style.display='block';
	}
	else
	{
		document.getElementById('RenterFields').style.display='none';
	}
}
</script>
<style>
form
{
	padding:3%;
	margin-left:20%;
	
}
p
{
 padding-left:340px;
 color:red;
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
<form method=post style=width:700px >
<label>Email Id :</label><input type=email name='uid' placeholder="Enter Email"  class="form-control" required><br>
<label>Name :</label><input type=text name='name' placeholder="Enter Name" class="form-control" required><br>
<label>Password :</label><input type=password name='pwd' id='pwd' placeholder="Enter Password" class="form-control" required>
<input type=checkbox onclick='ViewPass()'><span style='color:white'> Show Password </span><br><br>
<label>Contact no. :</label><input type=phone name='phoneno' placeholder='Enter Contact no.' class='form-control' required><br>
<label>Role :</label><input type=radio name='role'value='User' onclick="showrenterfields('0')" class='role'><span style='color:white'> User</span> <input type=radio name='role'value='Renter' class='role' onclick="showrenterfields('1')" ><span style='color:white'> Renter</span> <br><br>
<div id='RenterFields' style='display:none;'><label>Building No. :</label><input type=text name='buildingNo' placeholder='Eg. 310 or 120-A' class='form-control' ><br>
<label>Area :</label><input type=text name='area' placeholder='Enter Area' class='form-control'  ><br>
<label>City :</label><input type=text name='city' placeholder='Enter city' class='form-control' ><br>
<label>State :</label><input type=text name='state' placeholder='Enter state' class='form-control' ><br>
<label>Pincode :</label><input type=text name='pincode' placeholder='Enter pincode' class='form-control ' ><br></div>

<button type=submit class="btn btn-light">Signup</button> 
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['uid']))
{
$uid=$_POST['uid'];
$name=$_POST["name"];
$pwd=$_POST['pwd'];
$role=$_POST["role"];
$contactno=$_POST["phoneno"];
$building=$_POST["buildingNo"];
$area=$_POST["area"];
$city=$_POST["city"];
$state=$_POST["state"];
$pincode=$_POST["pincode"];
$address=$building.", ".$area." ".$city." ".$state." ".$pincode;
$status='Active';

function validate_mobile($mobile)
{
	return preg_match('/^[0-9]{10}+$/', $mobile);


}

include("myconnection.php");
if(validate_mobile($contactno))
{
	if(preg_match("/^[a-zA-Z ]+$/",$name)){
	
	
if($role=='User')
{
	
	$r=$con->query("insert into customerdetails values ('$uid', '$pwd', '$name' , $contactno, '$status')");
}

if($role=='Renter')
{
	$r=$con->query("insert into ownerdetails values ('$uid', '$pwd','$name', '$address', $contactno, '$status' )");
}
	}
	else{
		?>
<script>
  alert("Name");
</script>
<?php
	}
}
else{
?>
<script>
  alert("Mobile no. is not vaild");
</script>
<?php
}

// header("location:login.php");
$con->close();
}

?>