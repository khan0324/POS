<?php
include 'Connection.php';
$dateto = $_GET['dateto'];
$datefrom = $_GET['datefrom'];


$result = mysqli_query($con,"SELECT SUM(Amount) AS Amount, SUM(Paid) AS Paid, SUM(discount) AS discount, SUM(Balance) AS Balance, SUM(grandtotal) AS grandtotal FROM invoice WHERE d Between '" . $datefrom . "' AND  '" . $dateto . "'");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>