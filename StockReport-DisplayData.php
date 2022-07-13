<?php
 include 'Connection.php';
 $result = mysqli_query($con,"SELECT * FROM invoicedetail");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);
?>