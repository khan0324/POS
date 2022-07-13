<?php
 include 'Connection.php';
 
 $ProductName = $_POST["del_id"];
 $Query = "DELETE From product where ProductName = '$ProductName'";
 $result = mysqli_query($con,$Query);
 if($result)
 {
 	echo "Delete Successfully";
 }

?>