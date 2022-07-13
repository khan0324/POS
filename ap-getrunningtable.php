<?php
 include 'Connection.php';

 $result = mysqli_query($con,"SELECT * FROM punchingtable where status IS NOT NULL order by tableno asc");

  $data =array(); 
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }
  echo json_encode($data);

?>