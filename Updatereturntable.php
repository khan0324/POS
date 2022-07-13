<?php
	 include 'Connection.php';
       //CustomerName:CustomerName, CustomerPhone:CustomerPhone, CustomerAddress:CustomerAddress, ReceivedAmount:ReceivedAmount
	$sr = $_POST["sr"];
     
      $query = "DELETE FROM returntable WHERE sr=$sr";
      $result=mysqli_query($con,$query);
?>