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
        echo $Amount=     $row[2]."<br>";
        echo $Paid=       $row[4]."<br>";
        echo $InvoiceDetailID=$row[5]."<br>";
        echo $ProductName=    $row[7]."<br>";
        echo $OrderQuantity=  $row[8]."<br>";
        echo $UnityPrice=   $row[9]."<br>";
        echo $ProductPrice=   $row[10]."<br>";
    }
}
?>

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
    while ($row=mysqli_fetch_assoc($result))
    {
        ?>
        <tr>
            <td class="mx-auto" style="width: 200px;"><?php echo $row['ProductName']?></td>
            <td><?php echo $row['OrderQuantity']; ?></td>
            <td><?php echo $row['UnitRate']; ?></td>
            <td><?php echo $row['ProductRate']?></td>
            <td><?php echo $row['Amount']; ?></td>
            <td><?php echo $row['Paid']; ?></td> <br>

        </tr>
        <?php
    }
}
?>