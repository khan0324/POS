<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
// $ID=$_GET['id'];
$con = mysqli_connect("localhost","root","khan0324","hafiztraders");
$query = "SELECT invoice.*,invoicedetail.*
      FROM invoicedetail
      JOIN invoice
      ON invoicedetail.InvoiceNo = invoice.InvoiceNo 
      WHERE invoice.InvoiceNo='183'";

if ($result=mysqli_query($con,$query))
  {  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
      $Amount=     $row[2]."<br>"; 
      $Paid=       $row[4]."<br>";
      $InvoiceDetailID=$row[5]."<br>";
      $ProductName=    $row[7]."<br>";
      $OrderQuantity=  $row[8]."<br>";
      $UnityPrice=   $row[9]."<br>";
      $ProductPrice=   $row[10]."<br>";
    }
  }
?>


<div class="container">
  <h2>Basic Table</h2>
  <p>The .table class adds basic styling (light padding and horizontal dividers) to a table:</p>            
  <table class="table">
    <thead>
      <tr>
        <th>ProductName</th>
        <th>Quantity</th>
        <th>UnitRate</th>
        <th>ProductRate</th>
        <th>Amount</th>
        <th>Paid</th>
      </tr>
    </thead>
    <tbody>
      <tr>
    
        <td></td>
        
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      
        
    </tbody>
  </table>
</div>

</body>
</html>