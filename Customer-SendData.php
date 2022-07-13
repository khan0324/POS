<?php
include 'Connection.php';

  
  $CustomerName =  $_POST["CustomerName"];
  $CustomerPhone = $_POST["PhoneNumber"];
  $Address =  $_POST["Address"];
  $TotalAmount =  $_POST["TotalAmount"];
  $Balance =  $_POST["Balance"];
    


  $SendDetail = "Select * from Customer where CustomerPhone = '$CustomerPhone'";
  $Run = mysqli_query($con,$SendDetail);

  $Check = mysqli_num_rows($Run);

  if($Check == 1)
  {
    echo "This Customer is Already Existing";
  exit();
  }
  else{
    $insert = "Insert into Customer(CustomerName,CustomerPhone,CustomerAddress,TotalAmount,Balance) values ('$CustomerName','$CustomerPhone','$Address','$TotalAmount','$Balance')";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      echo "Add Succesfuly";
    }
    else{
    	echo "Not Add";
    }
  }
?>