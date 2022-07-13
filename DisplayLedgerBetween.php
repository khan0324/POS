<?php
include 'Connection.php';
$from = $_GET['from'];
$to = $_GET['to'];


$result = mysqli_query($con,"SELECT * FROM ledger WHERE date BETWEEN '" . $from . "' AND  '" . $to . "'
ORDER BY sr ASC");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>