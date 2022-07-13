<?php
	 include 'Connection.php';
       //CustomerName:CustomerName, CustomerPhone:CustomerPhone, CustomerAddress:CustomerAddress, ReceivedAmount:ReceivedAmount
	$sr = $_POST["sr"];
      $Name = $_POST["Name"];
      $Phone = $_POST["Phone"];
      $Address = $_POST["Address"];
      $Password = $_POST["Password"];
      
 
      $query = "UPDATE user SET username='$Name', contactno=$Phone, address='$Address',password='$Password' WHERE sr=$sr";
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