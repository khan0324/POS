<?php
include 'Connection.php';
$date = $_GET['date'];


$result = mysqli_query($con,"SELECT ProductName, SUM(OrderQuantity) AS OrderQuantity, SUM(UnitRate) AS UnitRate, SUM(ProductRate) AS ProductRate FROM invoicedetail WHERE d = '$date' GROUP BY ProductName ");


  $data  = array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>