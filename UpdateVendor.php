<?php
	include 'Connection.php';
       //CustomerName:CustomerName, CustomerPhone:CustomerPhone, CustomerAddress:CustomerAddress, ReceivedAmount:ReceivedAmount
	$sr = $_POST["sr"];
      $VendorName = $_POST["VendorName"];
      $VendorPhone = $_POST["VendorPhone"];
      $VendorAddress = $_POST["VendorAddress"];
      $TotalAmount = $_POST["TotalAmount"];
      $ReceivedAmount = (int)$_POST["ReceivedAmount"];
      $Balance = (int)$_POST["Balance"];
      
      $Balance = $Balance-$ReceivedAmount;
      
      $query = "UPDATE Vendor SET VendorName='$VendorName', VendorPhone=$VendorPhone, VendorAddress='$VendorAddress',TotalAmount=$TotalAmount, Balance=$Balance WHERE VendorSr=$sr";
      $result=mysqli_query($con,$query);
      if($result)
      {
      echo "Updated Succesfully";	
      }
      else
      {
            echo "Try Again";
      }
      
?>