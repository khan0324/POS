<?php
include 'Connection.php';
  $Row =  $_POST["Row"];
  $InvoiceNo =  $_POST["InvoiceNo"];  /* InvoiceNo:InvoiceNo,PN:PN, PQ:PQ, UR:UR, TA:TA */
  $PN =  $_POST["PN"];
  $PQ = $_POST["PQ"];
  $UR =  $_POST["UR"];  
  $TA = $_POST["TA"];
  $DDY = $_POST["DDY"];
  
  $getSr = "SELECT * From purchaseinvoice where InvoiceNo = $InvoiceNo";
  $res = mysqli_query($con,$getSr);
  while($result = mysqli_fetch_array($res))
{

    $sr = $result['sr'];
}
    $UpdateQuery = "UPDATE Product SET PurchasePrice = '$UR' WHERE ProductName='$PN'";
    $Update=mysqli_query($con,$UpdateQuery);

    $insert = "Insert into purchaseinvoicedetail(sr,invoiceno,ProductName,PurchaseQuantity,UnitRate,ProductRate,Row,Date) values ('$sr','$InvoiceNo','$PN','$PQ','$UR','$TA','$Row','$DDY')";
    $runinsert = mysqli_query($con,$insert);
    if($runinsert){
      echo $sr;
    }
    else{
     echo $sr; 
    }
    
?>