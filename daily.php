    <?php
      include('Header.php');
    ?>
<body>
    <div class="wrapper">
    <div class="container mt-5">
      <h4 class="T main_bg_color">Sale Reports</h4>
      <div class="form-group">
          <input type="Date" class="datepicker" placeholder="Select Date" id="datepicker">
          <input type="Date" class="datepicker" placeholder="Select Date" id="datepickerTo">
        
         <input type="button" class="btn btn-primary d-print-none" value="Go" onclick="TF()" style="width: 10%;padding: 10px"> 
      </div>
      <table class="wid table table-bordered table-hover" id="tabledata">
        <thead class="text-white">
          <tr class="main_bg_color">
            <th scope="col">Invoice#</th> 
            <th scope="col">Date</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Discount</th>
            <th scope="col">Order Taker</th>    
            <th scope="col">Update</th>
          </tr>
        </thead>
        <tbody id="ReportTable" style="background-color: white">
          <?php
            include 'Connection.php';
             //$result = mysqli_query($con,"SELECT * FROM Invoice ORDER BY sr DESC");
             
             include("function.php");
              $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
            $limit = 25; //if you want to dispaly 10 records per page then you have to change here
            $startpoint = ($page * $limit) - $limit;
            $statement = "Invoice ORDER BY sr DESC"; //you have to pass your query over here

            $res=mysqli_query($con,"SELECT * FROM {$statement}  LIMIT {$startpoint} , {$limit}");


              while($row = mysqli_fetch_assoc($res))

             {?>
              <tr>
                <td><a href="InvoiceReport.php?id=<?php echo $row['sr'];?>"> <?php echo $row['sr'];?></a></td>
                <td><?php echo $row['Date'];?></td>
                <td><?php echo $row['grandtotal'];?></td>
                <td><?php echo $row['discount'];?></td>
                <td><?php echo $row['user'];?></td> 
                <td><a href="#" id="<?php echo $row['sr']; ?>" class="update">Update</a></td>    
              </tr>
             <?php }
             echo "<div id='pagingg' >";
             echo pagination($statement,$limit,$page);
             echo "</div>";
              ?>
        </tbody>
      </table>
    </div>
    </div>
  </body>
  
  <script type="text/javascript">
    function TF()
    {
      var from = $("#datepicker").val();
      var to = $("#datepickerTo").val();
       var url = "dailyTOFROM.php?from="+from+"&to="+to;
                            window.location.href = url;
    }
    $(document).on('click','.update',function(e){
      var id = $(this).attr('id');
      var url = "editinvoice.php?id="+id+"&tab="+404;
                            window.location.href = url;
    });
  </script>
<script>
  //Script is to Hovar/Mark opened page in navbar
    $(function(){
        $('a').each(function(){
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active'); $(this).parents('li').addClass('active');
            }
        });
    });
</script>
</html>