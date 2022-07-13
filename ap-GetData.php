<?php
 include 'Connection.php';

 $result = mysqli_query($con,"SELECT * FROM product order by ProductName asc");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);
?>