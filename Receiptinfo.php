<?php
include 'Connection.php';

$id = intval($_GET['id']);


$result = mysqli_query($con,"SELECT * FROM receipt WHERE sr = $id");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>