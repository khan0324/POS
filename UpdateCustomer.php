<?php
	 include 'Connection.php';
       //CustomerName:CustomerName, CustomerPhone:CustomerPhone, CustomerAddress:CustomerAddress, ReceivedAmount:ReceivedAmount
	$sr = $_POST["sr"];
      $CustomerName = $_POST["CustomerName"];
      $CustomerPhone = $_POST["CustomerPhone"];
      $CustomerAddress = $_POST["CustomerAddress"];
      $TotalAmount = $_POST["TotalAmount"];
      $ReceivedAmount = (int)$_POST["ReceivedAmount"];
      $Balance = (int)$_POST["Balance"];
      
      $Balance = $Balance-$ReceivedAmount;
      
      $query = "UPDATE Customer SET CustomerName='$CustomerName', CustomerPhone=$CustomerPhone, CustomerAddress='$CustomerAddress',TotalAmount=$TotalAmount, Balance=$Balance WHERE CustomerSr=$sr";
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