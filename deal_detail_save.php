<?php
include 'Connection.php';

/*Product, ingredient,Quantity*/
  
  $product_id =  $_POST["product_id"];
  $Quantity = $_POST["Quantity"];
  $deal_id = $_POST["deal_id"];

     $insert = "INSERT into deal_detail(product_id,deal_id, product_quantity) values ($product_id,$deal_id,$Quantity)";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      echo "Add Succesfuly";
    }
    else{
    	echo "Not Add";
    }
?>