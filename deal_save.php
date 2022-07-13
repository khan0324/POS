<?php
  include 'Connection.php';

  
  $ProductName =  $_POST["ProductName"]; 
  $Price =  $_POST["Price"];
  $status = $_POST["Status"];
  
  $Sold = 0;

    $insert = "INSERT into deal(name,price,status) values ('$ProductName',$Price,$status)";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      echo "Add Succesfuly";
    }
?>