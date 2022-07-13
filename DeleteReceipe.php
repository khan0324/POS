<?php
include 'Connection.php';

 
 $sr = $_POST["del_id"];
 $Query = "DELETE From receipe where sr = $sr";
 $result = mysqli_query($con,$Query);
 if($result)
 {
 	echo "Delete Successfully";
 }

?>