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
  $query = "UPDATE invoice SET Amount = Amount+'$TotalAmount' , Paid = Paid+'$PaidAmount' ,discount = discount+$Discount,Balance = Balance+$Balance,GrandTotal = GrandTotal+$GrandTotal WHERE sr=$id";
    $runinsert = mysqli_query($con,$query);

    
    if ($runinsert) {
      /*if $runinsert succesfull it will be cheked that invoiceid saved in db if it is saved it will return a sr outherwise it will be unsucesful*/
      if($tableno!= "none")
      {
       $query = "UPDATE punchingtable SET status = NULL WHERE invoiceno='$id'";
      $r=mysqli_query($con,$query);
      $query = "UPDATE punchingtable SET invoiceno='$id', status = 'Running' WHERE tableno='$tableno'";
      $r=mysqli_query($con,$query);
      }

      echo json_encode(array("d1" => "t", "d2" => $id));
    }  
    
?>