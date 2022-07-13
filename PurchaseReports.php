    <?php
      include('Header.php');
    ?>
<body>
    <div class="wrapper">
    <div class="container mt-5">
      <h4 class="T main_bg_color">Purchase Reports</h4>
      <div class="form-group">
        <input type="Date" class="datepicker" onchange="SearchByDate()" placeholder="Select Date" id="datepicker">
        <input type="Date" class="datepicker" placeholder="Select Date" id="datepickerTo">
        <input type="button" class="btn btn-primary d-print-none" value="Go" onclick="TF()" style="width: 10%;padding: 10px">  
      </div>
      <table class="wid table table-bordered table-hover" id="tabledata">
        <thead class="text-white" style="background-color: chocolate">
          <tr class="main_bg_color">
            <th scope="col">Invoice#</th> 
            <th scope="col">Vendor Name</th>
            <th scope="col">Date</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Paid Amount</th>
            <th scope="col">Update</th>
          </tr>
        </thead>
        <tbody id="ReportTable" style="background-color: white">
          
        </tbody>
      </table>
 
          </div>
    </div>
  </body>

  <script type="text/javascript">
    
  </script>

  <script type="text/javascript">
    //Display Function For Customer
      table = $("#ReportTable");
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "PurchaseReport-DisplayData.php";//Invoice == Report
      var asyn = true;
      //Ajax open XML Request
      ajax.open(method,url,asyn);
      ajax.send();
      //ajax call for display
      ajax.onreadystatechange = function ReportDisplay()
      {
        if(this.readyState == 4 && this.status == 200)
        {
          var data = JSON.parse(this.responseText);
          console.log(data);
          var d = "";
          var e = "";
          for (var i = 0; i<data.length ; i++)
          {
            var sr = data[i].sr;
            var Invoice = data[i].InvoiceNo;
            var VendorName = data[i].VendorAddress;    //InvoiceNo,CustomerAddress,Amount,Date,Paid
            var TotalAmount = data[i].BillAmount;
            var DDY = data[i].Date;
            var PaidAmount = data[i].Paid;
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='Invoice' class='CustomerName'><a href='PurchaseInvoiceReport.php?id="+sr+"'>"+ sr +" </a></td>";
              d +="<td data-target='CustomerName' id='CustomerName' class='CustomerPhone' >"+ VendorName + "</td>";
              d +="<td data-target='DDY' id='DDY' class='CustomerAddress' >"+ DDY + "</td>";
              d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ TotalAmount + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ PaidAmount + "</td>";
             d +="<td> <a href='#' data-role='update' class='update' id='"+sr+"'>Update</a> </td>";
              /* d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";*/
            d +="</tr>";
            
          }
          document.getElementById("ReportTable").innerHTML = d;
         
        }
          
      }
      /*function total()
      {
        var table = document.getElementById("ReportTable"), sumVal = 0, PaidAmount = 0;
          for(var i = 0; i < table.rows.length; i++)
          {
            sumVal = sumVal + parseInt(table.rows[i].cells[3].innerHTML);
            PaidAmount = PaidAmount + parseInt(table.rows[i].cells[4].innerHTML);
          }
          document.getElementById("total").innerHTML = sumVal;
          document.getElementById("Paid").innerHTML = PaidAmount;

      }*/
      
  </script>

  <script type="text/javascript">
     $(document).on('click','.update',function(e){
      var id = $(this).attr('id');
      var url = "editpurchaseinvoice.php?id="+id;
                            window.location.href = url;
    });
    function TF()
    {
      var from = $("#datepicker").val();
      var to = $("#datepickerTo").val();
       var url = "PurchaseTOFROM.php?from="+from+"&to="+to;
                            window.location.href = url;
    }
    
    function SearchByDate() 
    {
      var input, filter, table, tr, td, i;
      input = document.getElementById("datepicker");
      filter = input.value.toUpperCase();
      table = document.getElementById("tabledata");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
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