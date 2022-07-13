<?php
include 'Connection.php';
/*InvoiceNo, Balance, PaidAmount*/
  $id = $_POST["id"];
  $PaidAmount =  $_POST["PaidAmount"];  
  $Balance = $_POST["Balance"];
  
  // Do Statment is for the issue in version 1.0 on not saved
  $query = "UPDATE purchaseinvoice SET Paid=$PaidAmount,Balance=$Balance WHERE sr=$id";
    $runinsert = mysqli_query($con,$query);

    
    if ($runinsert) {
      /*if $runinsert succesfull it will be cheked that invoiceid saved in db if it is saved it will return a sr outherwise it will be unsucesful*/
      
      echo  $id;
    }  
    
?>