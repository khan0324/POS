<?php
include 'Connection.php';
 $tableno = $_POST["tableno"];
  $id = $_POST["id"];
  $DDY =  $_POST["DDY"];
  $TotalAmount = $_POST["TotalAmount"];
  $PaidAmount =  $_POST["PaidAmount"];  
  $Discount = $_POST["Discount"];
  $InvoiceID = 0;/*DDY, TotalAmount,Discount,Balance, PaidAmount,GrandTotal*/
  $Balance = $_POST["Balance"];
  $GrandTotal = $_POST["GrandTotal"];
  $user = $_POST["user"];
  $type = 'INV';
  $cus = 'Customer';
  
  // Do Statment is for the issue in version 1.0 on not saved
  $query = "UPDATE invoice SET Amount=$TotalAmount ,Paid=$PaidAmount,discount=$Discount,Balance=$Balance,GrandTotal=$GrandTotal WHERE sr=$id";
    $runinsert = mysqli_query($con,$query);

    
    if ($runinsert) {
      echo json_encode(array("d1" => "t"));
    }  
    
?>