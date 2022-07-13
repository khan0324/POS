 <?php
      include('Header.php');
      
    ?>
  
   <body>
  
 <div class="wrapper">
    <div class="container mt-5">
      <h4 class="T" >STOCK REPORT</h4>
      <div class="form-group">
        
          <select style=""  id="OrderProduct" onchange='SearchByProduct()'>
            <?php



               $result = mysqli_query($con,"SELECT * FROM Product order by ProductName asc");
               $data =array();
                while($row = mysqli_fetch_assoc($result))
                {
           ?>
                <option  value='' > <?php echo $row['ProductName'];?> </option>
           <?php
                }
            ?>
       </select>
        <input style="" type="Date" onchange="SearchByDate()" placeholder="Select Date" id="datepicker">
        <input style="" class="" type="Date" placeholder="Select Date" id="datepickerTo">
        <input type="button" class="btn btn-primary d-print-none" value="Go" onclick="TF()" style="width: 10%;padding: 10px">
      </div>
      <table class="wid table table-bordered table-hover" id="tabledata">
        <thead class="text-white" style="background-color: chocolate">
          <tr>
            <th scope="col">Invoice#</th> 
            <th scope="col">Product Name</th>
            <th scope="col">Sale Quantity</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody id="ReportTable" style="background-color: white">
            <?php
  include("function.php");
              $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
            $limit = 25; //if you want to dispaly 10 records per page then you have to change here
            $startpoint = ($page * $limit) - $limit;
            $statement = "invoicedetail ORDER BY sr DESC"; //you have to pass your query over here

            $res=mysqli_query($con,"SELECT * FROM {$statement}  LIMIT {$startpoint} , {$limit}");

  while($row = mysqli_fetch_assoc($res))
  {?>
    <tr>
        <td><a href="InvoiceReport.php?id=<?php echo $row['sr'];?>"> <?php echo $row['sr'];?></a></td>
        <td><?php echo $row['ProductName'];?></td>
        <td><?php echo $row['OrderQuantity'];?></td>
        <td><?php echo $row['Date'];?></td>    
          </tr>
   <?php
  }
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
       var url = "SRTOFROM.php?from="+from+"&to="+to;
                            window.location.href = url;
    }
    function SearchByProduct() 
    {
      var e, input, filter, table, tr, td, i;
      e = document.getElementById("OrderProduct");//Getting Product From Select Tag
      
      input = e.options[e.selectedIndex].text;//Getting Product Through Option
     
      filter = input.toUpperCase();
      table = document.getElementById("tabledata");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
    function SearchByDate() 
    {
      var input, filter, table, tr, td, i;
      input = document.getElementById("datepicker");
      filter = input.value.toUpperCase();
      table = document.getElementById("tabledata");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
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