<?php
include 'Connection.php';
$name = $_GET['name'];


$result = mysqli_query($con,"SELECT * FROM Vendorledger where vendorname = '$name'");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>