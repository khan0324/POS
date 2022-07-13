<?php include('Header.php'); ?>



<body class="homebody">
<div class="container">
  <div class="Title text-center col-12">
    <h1 class="titleH1 border_color">Bake <span class="main_color">&</span> Take Pizza <span class="main_color">&</span> Burger Hut </h1>
  </div>
</div>

<div class="container" >
  <div class="row">
    <div class="col-sm-12 col-md-4 bg_color">
      <a href="Invoice.php"> 
        <figure>
        <img src="img/Bank.png" alt="image" class="image"  >
        <figcaption> Generate Invoice </figcaption>
       </figure>
      </a>
    </div>

     
    <div class="col-sm-12 col-md-4 bg_color">
        <a href="add-product.php">
        <figure>
        <img src="img/AddProduct.png" alt="image" class="image" >
        <figcaption> Add Product</figcaption>
       </figure>
       </a>
    </div>
       
    <div class="col-sm-12 col-md-4 bg_color">
        <a href="Purchaseinvoice.php">
        <figure>
        <img src="img/PurchaseOrder.png" alt="image" class="image" >
        <figcaption> Purchase Order  </figcaption>
       </figure>
       </a>
    </div>


    <div id="d-user" class="col-sm-12 col-md-4 bg_color">
        <a href="user.php" >
        <figure>
        <img src="img/AddCustomer.png" alt="image" class="image"  >
        <figcaption>User </figcaption>
       </figure>
       </a>
    </div>
    
    <div id="d-salereport" class="col-sm-12 col-md-4 bg_color">
        <a href="daily.php" >
        <figure>
        <img src="img/DailyReport.png" alt="image" class="image" >
        <figcaption> Sale Reports </figcaption>
       </figure>
       </a>
    </div>
    <div id="d-vendor" class="col-sm-12 col-md-4 bg_color">
        <a href="add-vendor.php">
        <figure>
        <img src="img/CustomerLedger.png" alt="image" class="image" >
        <figcaption> Vendor Ledger </figcaption>
       </figure>
       </a>
    </div>
  
  </div>  
</div>



</body>
 <script>
    var status = "<?php echo $status?>";
    if (status != "Admin" ) {
       document.getElementById("d-vendor").style.display="none";
      document.getElementById("d-salereport").style.display="none";
      document.getElementById("d-user").style.display="none";
      }
</script>
</html>
