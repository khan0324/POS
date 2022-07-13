<?php
include 'Connection.php';

$result = mysqli_query($con,"SELECT * FROM receipt ORDER BY sr DESC");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>