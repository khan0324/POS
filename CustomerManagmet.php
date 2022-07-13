<?php
include 'Connection.php';

//CustomerName:CustomerName, CustomerPhone:CustomerPhone, CustomerAddress:CustomerAddress, ReceivedAmount:ReceivedAmount

$Address = $_POST["Address"];
$TotalAmount = $_POST["TotalAmount"];
$PaidAmount = $_POST["PaidAmount"];
$Balance = $_POST["Balance"];

$query = "SELECT * From Customer WHERE CustomerAddress='$Address'";
$results = mysqli_query($con,$query);
while($result = mysqli_fetch_array($results))
{

    $TA = $result['TotalAmount'];
    $PA = $result['PaidAmount'];
    $B = $result['Balance'];
}

$TotalAmount = $TotalAmount+$TA;
$PaidAmount = $PaidAmount+$PA;
$Balance = $Balance+$B;


$query = "UPDATE Customer SET TotalAmount=$TotalAmount, Balance=$Balance, PaidAmount = $PaidAmount WHERE CustomerAddress='$Address'";
$result=mysqli_query($con,$query);

?>