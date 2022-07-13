<?php
include 'Connection.php';

 $d = $_POST["d"];
  $TotalAmount = $_POST["TotalAmount"];
  $PaidAmount =  $_POST["PaidAmount"];  
  $Discount = $_POST["Discount"];
  $InvoiceID = 0;/*DDY, TotalAmount,Discount,Balance, PaidAmount,GrandTotal*/
  $Balance = $_POST["Balance"];
  $GrandTotal = $_POST["GrandTotal"];
  $user = $_POST["user"];
  $tableno = $_POST["tableno"];
  $type = 'INV';
  $cus = 'Customer';
  
 
  
    $insert = "INSERT into Invoice(InvoiceNo,Amount,Paid,discount,Balance,grandtotal,user,d) values ('$InvoiceID','$TotalAmount','$PaidAmount','$Discount','$Balance',$GrandTotal,'$user','$d')";
    
    $runinsert = mysqli_query($con,$insert);
    if ($runinsert) {
       $getSr = "SELECT * From invoice ORDER BY sr DESC LIMIT 1";
          $res = mysqli_query($con,$getSr);
          while($result = mysqli_fetch_array($res))
        {
          $sr = $result['sr'];
        }
      $query = "UPDATE punchingtable SET invoiceno='$sr', status = '$user' WHERE tableno='$tableno'";
      $r=mysqli_query($con,$query);
      echo json_encode(array("d1" => "t", "d2" => $sr));
    }  
    
?>