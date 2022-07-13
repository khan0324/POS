<?php
  include 'Connection.php';

  
  $ProductName =  $_POST["ProductName"];
  $BikeName = $_POST["BikeName"];
  $Price =  $_POST["Price"];
  $Quantity =  $_POST["Quantity"];
  $Stock =  $_POST["Quantity"];
  $PurchasePrice = $_POST["PurchasePrice"];
  $Modal = $_POST["Modal"];
  
  $Sold = 0;

  $SendDetail = "SELECT * from Product where ProductName = '$ProductName'";
  $Run = mysqli_query($con,$SendDetail);

  $Check = mysqli_num_rows($Run);

  if($Check == 1)
  {
    echo "This Product is Already Existing";
  exit();
  }
  else{
    $insert = "INSERT into Product(ProductName,BikeName,Price,Quantity,Sold,Stock,PurchasePrice,Modal) values ('$ProductName','$BikeName','$Price','$Quantity','$Sold','$Stock','$PurchasePrice','$Modal')";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      echo "Add Succesfuly";
    }
  }
?>