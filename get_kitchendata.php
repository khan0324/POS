<?php
 include 'Connection.php';

 $result = mysqli_query($con,"SELECT * FROM invoicedetail Where invoiceno = 123 || invoiceno = 111  order by InvoiceDetailId DESC");
$tables = mysqli_query($con,"SELECT * FROM punchingtable Where status = 'Running'");

  $data =array();
  $data1 =array();
  
  while($row = mysqli_fetch_assoc($result))
  {
    $data[] = $row;
  }

  while($row1 = mysqli_fetch_assoc($tables))
  {
    $data1[] = $row1;
  }
  echo json_encode(array($data,$data1));
?>