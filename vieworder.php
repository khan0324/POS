<?php 
include 'Connection.php';
$id = $_GET['id'];

?>
<div style="margin-left: 50px;text-align: center;width: 302px">
	   
        <h2 style="">Order #<span id="s-invoiceno"><?php echo $id;  ?></span></h2>
        <table class="table" style="width: 390px;margin-left: -40px">
        <thead class="" style="color: black" >
        <tr>
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

      <div style="width:60%;float: right; text-align: right; margin-right:0px; display: none;">
          <?php
include 'Connection.php';
$id = $_GET['id'];
 $result = mysqli_query($con,"SELECT * FROM invoice where sr = '$id'");

  $data =array();
  while($row = mysqli_fetch_assoc($result))
  {?>
     <p><b>Total:</b><span id="s-total"><?php echo $row['Amount'];?></span></p>
          <p><b>GST:</b><span id="s-GST">16%</span></p>
          <p><b>Discount:</b><span id="s-discount"><?php echo $row['discount'];?></span></p>
          <p><b>Grand Total:</b><span id="s-grandtotal"><?php echo $row['grandtotal'];?></span></p>
          <p><b>Received:</b><span id="s-received"><?php echo $row['Paid'];?></span></p>
          <p><b>Balance:</b><span id="s-balance"></span></p>
        <?php
        }
        ?>
        
        
       </div>
       </div>
       
<script>
  var id = getUrlVars()["id"];
  function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
  vars[key] = value;
  });
  return vars;
  }
 /* document.getElementById("s-invoiceno").innerHTML = id;*/
  document.body.style.background = "white";
  document.body.style.fontWeight = "900";
  

</script>

</html>
