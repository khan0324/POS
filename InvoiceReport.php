<?php include'Connection.php'?>

<div class="containerfluid" style="background-color: white">

  <?php include 'HeaderOnPrintPage.php';
    $id = $_GET['id'];
  ?>
<div style="margin-left: 50px;text-align: center;width: 302px;font-weight:900;">
	    <h1 align="center" > <u>Sale Invoice</u> </h1>
        <h2 style="">Invoice No#<span id="s-invoiceno"><?php echo $id;  ?></span></h2>
     <p class="m-0 p-0">Miraj town Haji Coat Opp PSO petrol pump Kala khatai road</p>
         <p class="m-0 p-0">0334-0314610</p>
        <p class="m-0 p-0">0300-0314610</p>
        <p class="m-0 p-0">042-37925912</p>
        <figure style="background-color: white;">
          <img src="img/Logo1.jpg" class="rounded" alt="image" style="margin-bottom: 10px;width: 200px;height: 200px;">
          <!-- <figcaption style="font-size: 14px;">PNTN:000000-0</figcaption> -->
        </figure>
        <table class="table" style="width: 390px;margin-left: -40px">
        <thead class="" style="color: black" >
        <tr class="main_bg_color">
            <th scope="col" style="width: 10%">Qty</th>
            <th scope="col" style="width: 50%">Product</th>
            <th scope="col" style="width: 15%">Total</th>
            <th scope="col" style="width: 25%">S.Total</th>
        </tr>
        </thead>
        <tbody id="Items" style="background-color: white">
          <?php
        $result = mysqli_query($con,"SELECT * FROM invoicedetail where sr = '$id'");

        $data =array();
        while($row = mysqli_fetch_assoc($result))
        {?>
     <tr id="">
        <td><?php echo $row['OrderQuantity'];?></td>
        <td><?php echo $row['ProductName'];?></td>   
        <td><?php echo $row['UnitRate'];?></td>
        <td><?php echo $row['ProductRate'];?></td>  
      </tr>
        <?php
        }
        ?>
        </tbody>
        </table>

      <div style="width:80%;float: right; text-align: right; margin-right:0px">
       <?php
       $result = mysqli_query($con,"SELECT * FROM invoice where sr = '$id'"); 
        $data =array();
         while($row = mysqli_fetch_assoc($result))
        {?>
     <p >Total:<span id="s-total"><?php echo $row['Amount'];?></span></p>
          <p >5% GST:<span id="s-GST"></span><?php echo($row['grandtotal']-($row['Amount']- $row['discount'])) ; ?> </p>
          <p >Discount:<span id="s-discount"><?php echo $row['discount'];?></span></p>
          <p style="font-size: 20px"><b>Grand Total:</b><span id="s-grandtotal"><?php echo $row['grandtotal'];?></span></p>
          <!-- <p >Received:<span id="s-received"><?php echo $row['Paid'];?></span></p> -->
        
       </div>
       <div style="float: left;">
        <b>Serve By:</b><span id="s-user"><?php echo $row['user']; ?></span><br>
         <b>Printed By:</b><span id="s-user"><?php echo $_SESSION['username'] ?></span><br>
         <span id="s-date" style="font-weight: 400"> <?php echo $row['Date'];?> </span>
       </div>
       <?php
        }
        ?>
       <?php require ('InvoiceReportFooter.php');?>
       </div>
 </div>      
<script>
  
  document.body.style.color = "black";
  //Getting data to display

function printPage() {
    window.print();
    window.location.href = "invoice.php";
}
</script>

</html>
