<?php
include 'Connection.php';

 
 $sr = $_POST["del_id"];
 $Query = "DELETE From deal_detail where id = $sr";
 $result = mysqli_query($con,$Query);
 if($result)
 {
 	echo "Delete Successfully";
 }

?>