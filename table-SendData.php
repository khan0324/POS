<?php
  include 'Connection.php';

  
  $table =  $_POST["table"];
  
  $Sold = 0;

  $SendDetail = "SELECT * from  punchingtable where tableno = '$table'";
  $Run = mysqli_query($con,$SendDetail);

  $Check = mysqli_num_rows($Run);

  if($Check == 1)
  {
    echo "This Product is Already Existing";
  exit();
  }
  else{
    $insert = "INSERT into punchingtable(tableno) values ('$table')";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      echo "Add Succesfuly";
    }
  }
?>