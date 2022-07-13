<?php
 
 include 'Connection.php';
 $result = mysqli_query($con,"SELECT * FROM TA Where Sr=1");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);
?>