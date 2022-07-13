<?php
	 include 'Connection.php';
     
    $invoiceno = $_POST["invoiceno"];
    $tableno = $_POST["tableno"];
    $status = $_POST["status"];
    
    $query = "UPDATE punchingtable SET status = NULL WHERE invoiceno='$invoiceno'";
    $result=mysqli_query($con,$query);

    $query1 = "UPDATE punchingtable SET status = '$status', invoiceno='$invoiceno'  WHERE tableno='$tableno'";
    $result=mysqli_query($con,$query1);

    $query = "UPDATE  invoicedetail SET Row = '$tableno'  WHERE sr=$invoiceno";
    $result=mysqli_query($con,$query);
    if ($query) {
    	echo $result;
    }


?>