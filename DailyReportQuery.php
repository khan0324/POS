<?php
include 'Connection.php';


// $ID = $_GET['ID'];
$query = "SELECT invoice.*,invoicedetail.*
      FROM invoicedetail
      JOIN invoice
      ON invoicedetail.InvoiceNo = invoice.InvoiceNo 
      WHERE invoice.InvoiceNo='183' ";
 $result = mysqli_query($con,$query);
  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {    $data[] = $row;  }
echo json_encode($data);

?>