<?php
include 'Connection.php';

  /*UserName,PhoneNumber, Address,Password, Status*/  
  $UserName =  $_POST["UserName"];
  $Phone = $_POST["PhoneNumber"];
  $Address =  $_POST["Address"];
  $Password =  $_POST["Password"];
  $Status =  $_POST["Status"];
    


  $SendDetail = "SELECT * from user where username = '$UserName'";
  $Run = mysqli_query($con,$SendDetail);

  $Check = mysqli_num_rows($Run);

  if($Check == 1)
  {
    echo "This User is Already Existing";
  exit();
  }
  else{
    $insert = "INSERT into user(username,password,contactno,address,status) values ('$UserName','$Password','$Phone','$Address','$Status')";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      echo "Add Succesfuly";
    }
    else{
    	echo "Not Add";
    }
  }
?>