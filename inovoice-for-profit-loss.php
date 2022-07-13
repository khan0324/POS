<?php
include 'Connection.php';
$from = $_GET['from'];
$to = $_GET['to'];


$result = mysqli_query($con,"SELECT * FROM invoice WHERE d BETWEEN '" . $from . "' AND  '" . $to . "'
ORDER by d");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>