<?php
include 'Connection.php';
$from = $_GET['from'];
$to = $_GET['to'];


$result = mysqli_query($con,"SELECT * FROM purchaseinvoice WHERE Date BETWEEN '" . $from . "' AND  '" . $to . "'
ORDER by Date ASC");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>