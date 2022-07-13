<?php
	 include 'Connection.php';
       //CustomerName:CustomerName, CustomerPhone:CustomerPhone, CustomerAddress:CustomerAddress, ReceivedAmount:ReceivedAmount
	$sr = $_POST["sr"];
    $invoiceno = $_POST["invoiceno"];
    $tableno = $_POST["tableno"];

    $getamountquery = "SELECT grandtotal FROM invoice WHERE sr='$invoiceno'";
    $amount = mysqli_query($con,$getamountquery);

    while($totalamount= mysqli_fetch_array($amount))
    {
    	$grandtotal = $totalamount['grandtotal'];
    }

    $insertdata = "INSERT into returntable(tableno,orderno,bill)Values('$tableno',$invoiceno,$grandtotal)";
    $ins=mysqli_query($con,$insertdata);
     
      $query = "UPDATE punchingtable SET status = NULL WHERE invoiceno='$invoiceno'";
      $result=mysqli_query($con,$query);
?>