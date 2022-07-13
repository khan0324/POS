<?php
include 'Connection.php';
$id = $_GET['id'];


$result = mysqli_query($con,"SELECT * FROM invoicedetail where sr = '$id'");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);
?>