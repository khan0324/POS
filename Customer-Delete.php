<?php
include 'Connection.php';

 
 $CustomerName = $_POST["del_id"];
 $Query = "DELETE From Customer where CustomerName = '$CustomerName'";
 $result = mysqli_query($con,$Query);
 if($result)
 {
 	echo "Delete Successfully";
 }

?>