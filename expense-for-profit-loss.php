<?php
include 'Connection.php';
$from = $_GET['from'];
$to = $_GET['to'];


$result = mysqli_query($con,"SELECT * FROM expense WHERE Dat BETWEEN '" . $from . "' AND  '" . $to . "'
ORDER by Dat");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>