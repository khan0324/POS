<?php
include 'Connection.php';

$deal_id = $_GET["deal_id"];
 
 $result = mysqli_query($con,"SELECT deal_detail.*, product.ProductName,product.Price FROM deal_detail INNER JOIN product ON product.sr=deal_detail.product_id WHERE deal_id = $deal_id ");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);
?>