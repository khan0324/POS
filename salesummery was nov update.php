    <?php
      include('Header.php');
    ?>
<body>
    <div class="wrapper">
    <div class="container mt-5">
      <h4 class="T">Sale Summery</h4>
      <div class="form-group">
         <input type="Date" class="datepicker" placeholder="Select Date" id="datepicker">
          <input type="Date" class="datepicker" placeholder="Select Date" id="datepickerTo">
          <input type="button" class="btn btn-primary d-print-none" value="Go" onclick="TF()" style="width: 10%;padding: 10px"> 
      </div>
      <table class="wid table table-bordered table-hover" id="tabledata">
        <thead class="bg-primary text-white" id="OrderTable">
          <tr>
           <th scope="col">Date</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Discount</th>
            <th scope="col">GST</th>
            <th scope="col">GrandTotal</th>

          </tr>
        </thead>
        <tbody id="ReportTable" style="background: white">
          <?php
          include 'Connection.php';
          include("function.php");
           $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
            $limit = 15; //if you want to dispaly 10 records per page then you have to change here
            $startpoint = ($page * $limit) - $limit;
            $statement = "  invoice GROUP BY d"; //you have to pass your query over here

            $res=mysqli_query($con,"SELECT d, SUM(Amount) as Amount, SUM(Paid) as Paid, SUM(discount) as discount, SUM(grandtotal) as grandtotal  FROM {$statement}  LIMIT {$startpoint} , {$limit} ");

          // $result = mysqli_query($con,"SELECT LIMIT {$startpoint} , {$limit}");

  
        while($row = mysqli_fetch_assoc($res))

             {?>
              <tr>
                <td><a href="daysummery.php?date=<?php echo $row['d'];?>"> <?php echo $row['d'];?></a></td>
                <td><?php echo $row['Amount'];?></td>
                <td><?php echo $row['discount'];?></td>
                <td><?php echo (floatval($row['grandtotal'])-(floatval($row['Amount'])-floatval($row['discount'])));?></td> 
                <td><?php echo $row['grandtotal'];?></td>    
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
    //Display Function For Customer
           
    
  </script>
  <script type="text/javascript">
    function TF()
    {
      var from = $("#datepicker").val();
      var to = $("#datepickerTo").val();
       var url = "summeryTOFROM.php?from="+from+"&to="+to;
                            window.location.href = url;
    }
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