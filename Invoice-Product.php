<?php
include 'Connection.php';
date_default_timezone_set("Asia/Karachi");
  $Row =  $_POST["Row"];
  $sr =  $_POST["InvoiceNo"];  /* Row,InvoiceNo,PN,UP,TA,Q,DDY */
  $PN =  $_POST["PN"];
  $UP = $_POST["UP"];
  $TA = $_POST["TA"];
  $Q = $_POST["Q"];
//  $DY = datetime('Y-m-d h:i:s'); 

  $i_date = new DateTime();
  $DDY = $i_date->format('Y-m-d H:i:s');


  $InvoiceNo = 123;
  $d = $_POST["d"];

$subQuery = "SELECT d From invoice WHERE sr = $sr";

                $subTotalQuantity = mysqli_query($con,$subQuery);
                while($subresult = mysqli_fetch_array($subTotalQuantity))
                {
                  $d = $subresult['d'];
                }

  $insert = "INSERT into invoicedetail(sr,invoiceno,Row,ProductName,OrderQuantity,UnitRate,ProductRate,Date,d) values ('$sr','$InvoiceNo','$Row','$PN','$Q','$UP','$TA','$DDY','$d')";
    $runinsert = mysqli_query($con,$insert);
    if($runinsert){
      echo $sr;
    }
    else{
      echo $sr;
    }
    
?>