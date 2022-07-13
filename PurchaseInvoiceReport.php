  
<?php include 'HeaderOnPrintPage.php';?>
<div class="Container" style="max-width: 785px; margin: 25px 30px 25px 30px;">

<?php
 $ID=$_GET['id'];
$con2  = mysqli_connect("localhost","root","khan0324","teapos");
$query2 = "SELECT DISTINCT * From purchaseinvoice WHERE sr='$ID' ";
if ($result2=mysqli_query($con2,$query2))
  {  // Fetch one and one row
  while ($row2=mysqli_fetch_assoc($result2))
  {
     $InvoiceNo= $row2['sr'];          
     $VendorAddress= $row2['VendorAddress'];
     $Date= $row2['Date']; 
     $Amount=$row2['BillAmount'];
     $Paid=$row2['Paid'];
     $ClaimAmount=$row2['Claim'];
     $Balance=$row2['Balance'];
     $Time=$row2['Time'];
}
}
$query3 = "SELECT DISTINCT * From vendor WHERE VendorAddress='$VendorAddress' ";
if ($result3=mysqli_query($con2,$query3))
  {  // Fetch one and one row
  while ($row3=mysqli_fetch_assoc($result3))
  {
     $VendorPhone = $row3['VendorPhone'];
     $VendorName = $row3['VendorName'];
}
}

?>
<div class="Top" style="line-height: 1;"><!--  d-none d-print-block -->
<div class="Company" style=" text-align: left; float: left; width: 60%;">

    <h4 style="text-decoration: underline; font-weight: 700; font-size: xx-large;margin:0px 0px 0px 150px">Bake <span class="main_color">&</span> Take Pizza <span class="main_color">&</span> Burger Hut</h4>
    <!-- <h3> SALE INVOICE </h3>
    <h5>042 36367015/0303 4319049</h5> -->
    <h6 style="margin:0px 0px 0px 150px">Miraj town Haji Coat Opp PSO petrol pump Kala khatai road.</h6>
</div>
<!-- <div class="verticalline"></div> -->
<div class="CompanyDo" style="margin-left: 10px; float: left;">
  <div class="lab" style="float: left;">
    <label style="font-weight: 700;">Ph:</label><span> &nbsp 042-37925912</span><br>
    <label style="font-weight: 700;">Mobile:&nbsp</label><span>0334-0314610</span><span></span><span style="margin-left: 5px"></span><br> 
    
  </div>
  <!-- <h2>Deal In:</h2>
  <b><p>&nbsp Toyota, Suzuki, Honda<br>&nbsp Hundai  Body Parts & Lights.</p>
  <p>&nbsp Whole Sale & Retail.</p></b> -->
</div>
<div class="V-D" style="float: right; text-align: right;">
      <label style="font-weight: 700;">Voucher #:&nbspInv-<b><?php echo $InvoiceNo;?></b></label><br>
      <label style="font-weight: 700;">Date:&nbsp</label><span> <?php echo $Date;?></span>
    </div>
<div class="SI" style="">
      <h4 style="font-weight: 700;"><b>Purchase Invoice</b></h4>
    </div>
</div>

<p style="background-color: black;color:white;margin: 0px 0px -12px 10px; width: fit-content;">Acount Detail</p>
<p style="background-color: black;color:white;margin: -12px 225px 10px 0px; width: fit-content; float: right;">Deal In</p>
<div class="" style="width: 100%;height:132px;border: 1px;border-style: solid;margin-bottom: 10px;">
  <div style="width: 60%; float: left; border-right:  1px solid black">
    <label style="margin-top: 10px">Vendor Name &nbsp</label><span><?php echo $VendorName;?></span> <br>
    <label>Address &nbsp</label><span><?php echo $VendorAddress;?><br></span><br>
    <label>Contact No &nbsp</label><span><?php echo $VendorPhone;?></span>
  </div>
<div style="float: left;line-height: 1" class="dis"><p>&nbsp Toyota, Suzuki, Honda<br>&nbsp Hyundai  Body Parts & Lights.</p>
  <p>&nbsp Whole Sale & Retail.</p></div>

</div>


<div style="background-color: #ffffff">
  <table class="table OrderTable"  style="font-size: 14px;border:1px solid black" >
      <thead style="background-color: chocolate">
      <tr class="tr">
        <th style="font-weight: 800;border-top: 1px solid black" > Sr#</th>
        <th style="font-weight: 800;border-top: 1px solid black" > Product Name</th>
        <th style="font-weight: 800;border-top: 1px solid black" > Quantity</th>
        <th style="font-weight: 800;border-top: 1px solid black" > Unit Rate</th>
        <th style="font-weight: 800;border-top: 1px solid black" > TotalAmount</th>   
      </tr>
      </thead>
  <tbody id="OrderTable">
  <?php
   $ID=$_GET['id'];
  $con  = mysqli_connect("localhost","root","khan0324","teapos");
  $query = "SELECT Purchaseinvoice.*,Purchaseinvoicedetail.*
        FROM Purchaseinvoicedetail
        JOIN Purchaseinvoice
        ON Purchaseinvoicedetail.sr = Purchaseinvoice.sr 
        WHERE Purchaseinvoice.sr='$ID' order by Row asc";

  if ($result=mysqli_query($con,$query))
    {  // Fetch one and one row
    while ($row=mysqli_fetch_assoc($result))
      {
  ?>
         <tr class="tr">
              <td ></td>
              <td ><?php echo $row['ProductName'];?>  </td> 
              <td ><?php echo $row['PurchaseQuantity'];?></td> 
              <td ><?php echo $row['UnitRate']; ?>    </td>
              <td ><?php echo $row['ProductRate']?>   </td> 
          </tr>     
       <?php
    }
  }

  ?>
  </tbody>
</table>
</div>
<?php
$con2  = mysqli_connect("localhost","root","khan0324","teapos");
$query2 = "SELECT DISTINCT * From Purchaseinvoice WHERE sr='$ID'";

if ($result2=mysqli_query($con2,$query2))
  {  // Fetch one and one row
    while ($row2=mysqli_fetch_assoc($result2))
    {
       $InvoiceNo= $row2['sr'];          
       $PurchaseAddress= $row2['VendorAddress'];
       $Date= $row2['Date']; 
       $Amount=$row2['BillAmount'];
       $Paid=$row2['Paid'];
    }
}
?>

<div style="width: 30%;margin-top: 10px;float: right; border:1px solid black;">

     <div style="background-color: grey; border-bottom: 1px solid black"><label>Totals </label><b style="float: right;margin-right: 10px"><?php echo $Amount;?></b></div>
     <br>
     <label>Paid</label> <b style="float: right;margin-right: 10px;"><?php echo $Paid;?></b><br>
     <label>Balance</label> <b style="float: right;margin-right: 10px;"><?php echo $Balance;?></b>   
</div>
<div style="width:68%;border: 1px solid black;float: left;margin-top: 10px">
  <div style="width:25%;border-right: 1px solid black;float: left;">
    <label>Transporter</label><br>
    <label>Deliver Date</label><br>
    <label>No Of Cases</label><br>
  </div>
  <div>
    <span></span><br>
    <label style="margin: 10px"><?php echo $Date;?></label>
  </div>
</div>
<div style="width: 68%;border:1px solid black; height: 50px;border-top:none;display: -webkit-inline-box;">
  <label style="margin-top: 15px">Deliver To:</label>
</div>
<div style="display: -webkit-inline-box;margin-top: 30px; height:  60px;width:70%">
  <hr style="margin-left: 0px;width: 30%;background-color:black;"><br>
  <label style="margin-left: -550px;">Checked By</label>
  <hr style="margin-left: -185px;width: 30%;background-color:black;"><br>
  <label style="margin-left: -735px;">Created By</label>
</div>
<?php require ('InvoiceReportFooter.php');?>


<script type="text/javascript">
function printPage() {
    window.print();
    window.location.href = "invoice.php";
}
</script>
<script type="text/javascript">
   document.body.style.background = "white";
    var table = $('#OrderTable');
    var tablerow = $('#OrderTable tr').length;
    var Row = '';
    if(tablerow < 10)
    {
     var row = 10-tablerow;
      
     var  a = 1;
      while(a<row)
      {
          Row += "<tr style='border:none'>";
            Row +="<td style='border-bottom:none;border-top:none'></td>";
            Row +="<td style='border-bottom:none;border-top:none'></td>";
            Row +="<td style='border-bottom:none;border-top:none'></td>";
            Row +="<td style='border-bottom:none;border-top:none'></td>";
            Row +="<td style='border-bottom:none;border-top:none'> </td>";
          Row +="</tr>";
        a=  a+1;
      }
      table.append(Row);
    }


</script>


</script>
