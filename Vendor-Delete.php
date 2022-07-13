<?php
 include 'Connection.php'; 
 $VendorName = $_POST["del_id"];
 $Query = "DELETE From Vendor where VendorName = '$VendorName'";
 $result = mysqli_query($con,$Query);
 if($result)
 {
 	echo "Delete Successfully";
 }

?>