<?php
include 'Connection.php';
 $result = mysqli_query($con,"SELECT d, SUM(Amount) as Amount, SUM(Paid) as Paid, SUM(discount) as discount, SUM(grandtotal) as grandtotal FROM invoice GROUP BY d");

  $data =array();
  
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }

  echo json_encode($data);
?>