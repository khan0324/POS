<?php
include 'Connection.php';
$dateto = $_GET['dateto'];
$datefrom = $_GET['datefrom'];



$result = mysqli_query($con,"SELECT ProductName, SUM(OrderQuantity) AS OrderQuantity, SUM(UnitRate) AS UnitRate, SUM(ProductRate) AS ProductRate FROM invoicedetail WHERE d Between '" . $datefrom . "' AND  '" . $dateto . "' GROUP BY ProductName ");


  $data  = array();
 
  
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
 
   echo json_encode(array($data));
 /* echo json_encode($data);*/

?>