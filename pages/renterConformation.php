<?php
$Owner=$_GET['uid'];
$CarId=$_GET['carid'];
$email=$_GET['email'];

include("myconnection.php");
$con->query("Update rentdetails set status='Confirmed' where Owner_Id='$Owner' and Car_ID='$CarId' and Email_Id='$email'");
header("Location:allBookings.php");
?>