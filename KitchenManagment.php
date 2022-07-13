<?php

include 'Connection.php';

	$id =  $_POST["id"];

	$query1 = "UPDATE invoicedetail SET invoiceno=111 WHERE InvoiceDetailId=$id ";
    $result=mysqli_query($con,$query1);
?>