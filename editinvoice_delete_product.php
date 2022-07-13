<?php
include 'Connection.php';

 
 $sr = $_POST["id"];
 $Query = "DELETE From invoicedetail where InvoiceDetailId = $sr";
 $result = mysqli_query($con,$Query);
 if($result)
 {
 	echo "Delete Successfully";
 }

?>