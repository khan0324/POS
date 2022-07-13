<?php
include 'Connection.php';
$date = $_GET['date'];


$result = mysqli_query($con,"SELECT SUM(Amount) AS Amount, SUM(Paid) AS Paid, SUM(discount) AS discount, SUM(Balance) AS Balance, SUM(grandtotal) AS grandtotal FROM invoice WHERE d = '$date'");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>