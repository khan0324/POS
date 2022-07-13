<?php
include 'Connection.php';

$Product = $_GET["Product"];
 
 $result = mysqli_query($con,"SELECT * FROM receipe WHERE product = '$Product' ");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);
?>