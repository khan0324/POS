<?php
 include 'Connection.php';

 $result = mysqli_query($con,"SELECT * FROM punchingtable order by tableno asc");

  $data =array(); 
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>