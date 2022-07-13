<?php
include 'Connection.php';
  
  $VendorName =  $_POST["VendorName"];
  $VendorPhone = $_POST["PhoneNumber"];
  $Address =  $_POST["Address"];
  $TotalAmount =  $_POST["TotalAmount"];
  $Balance =  $_POST["Balance"];
  $Paid = (int)$TotalAmount-(int)$Balance;


  $SendDetail = "SELECT * from Vendor where VendorPhone = '$VendorPhone'";
  $Run = mysqli_query($con,$SendDetail);

  $Check = mysqli_num_rows($Run);

  if($Check == 1)
  {
    echo "This Vendor is Already Existing";
  exit();
  }
  else{
    $insert = "INSERT into Vendor(VendorName,VendorPhone,VendorAddress,TotalAmount,PaidAmount,Balance) values ('$VendorName','$VendorPhone','$Address','$TotalAmount','$Paid','$Balance')";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      echo "Add Succesfuly";
    }
    else{
    	echo "Not Add";
    }
  }
?>