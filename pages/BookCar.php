<?php

session_start();
$Car_Id=$_GET['Car_Id'];
include("myconnection.php");
$r=$con->query("Select Owner_Id, Price from cardetails where Car_Id='$Car_Id'");
while($row=$r->fetch_assoc())
{
    $Owner_Id= $row['Owner_Id'];
    $Fare_Charges=$_SESSION['No_of_Days']*$row['Price'];
}

$Email_Id=$_SESSION['uid'];
$Pickup_Location=$_SESSION['Pickup_Location'];
$Drop_Location=$_SESSION['Drop_Location'];
$Pickup_DateTime=$_SESSION['Pickup_DateTime'];
$Drop_DateTime=$_SESSION['Drop_DateTime'];
echo $Pickup_Location;
$con->query("insert into rentdetails values ('$Owner_Id', '$Email_Id', '$Car_Id', '$Pickup_Location', '$Drop_Location', '$Pickup_DateTime', '$Drop_DateTime', $Fare_Charges, 'Confirmation Awaiting')");
$con->close();
echo "<script>alert('Booking Successful');</script>";
header("location:MyBookings.php");

?>