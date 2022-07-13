<?php
include 'Connection.php';

/*Product, ingredient,Quantity*/
  
  $Product =  $_POST["Product"];
  $ingredient = $_POST["ingredient"];
  $Quantity = $_POST["Quantity"];

  $SendDetail = "SELECT product from receipe where ingredient = '$ingredient'";
  $Run = mysqli_query($con,$SendDetail);

  $Check = mysqli_num_rows($Run);

  if($Check == 1)
  {
    echo "Already Added";
  exit();
  }
  else{
    $insert = "INSERT into receipe(product, ingredient, qty) values ('$Product','$ingredient','$Quantity')";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      echo "Add Succesfuly";
    }
    else{
    	echo "Not Add";
    }
  }
?>