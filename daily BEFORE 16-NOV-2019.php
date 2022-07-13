    <?php
      include('Header.php');
    ?>
<body>
    <div class="wrapper">
    <div class="container mt-5">
      <h4 class="T">Sale Reports</h4>
      <div class="form-group">
          <input type="Date" class="datepicker" placeholder="Select Date" id="datepicker">
          <input type="Date" class="datepicker" placeholder="Select Date" id="datepickerTo">
        
         <input type="button" class="btn btn-primary d-print-none" value="Go" onclick="TF()" style="width: 10%;padding: 10px"> 
      </div>
      <table class="wid table table-bordered table-hover" id="tabledata">
        <thead class="text-white" style="background-color: chocolate">
          <tr>
            <th scope="col">Invoice#</th> 
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
    //Display Function For Customer
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "Report-DisplayData.php";//Invoice == Report
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
          var da = "";
          var ta = 0;
          for (var i = 0; i<data.length ; i++)
          {
            var sr = data[i].sr;
            var Invoice = data[i].InvoiceNo;
            var CustomerName = data[i].CustomerAddress;    //InvoiceNo,CustomerAddress,Amount,Date,Paid
            var TotalAmount = data[i].Amount;
            var DDY = data[i].Date;
            var PaidAmount = data[i].Paid;
            var GrandTotal = data[i].grandtotal;
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='Invoice' class='CustomerName'><a href='InvoiceReport.php?id="+sr+"'>"+ sr +" </a></td>";
              d +="<td data-target='DDY' id='DDY' class='CustomerAddress' >"+ DDY + "</td>";
              d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ GrandTotal + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ PaidAmount + "</td>";
            d +="<td> <a href='#' class='update' data-role='update' id='"+sr+"'>Update</a> </td>";
              /*d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";*/
            d +="</tr>";
            ta = parseInt(TotalAmount)+ta;
          }
          document.getElementById("ReportTable").innerHTML = d;
          da += "<tr>";
              da +="<td data-target='Invoice' class='CustomerName'></td>";
              da +="<td data-target='DDY' id='DDY' class='CustomerAddress'><b>TOTAL SALE</b></td>";
              da +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' ><b>"+ ta + "</b></td>";
              da +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' ></td>";
              da +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' ></td>";
              /*d +="<td> <a href='#' data-role='update' data-id='"+CustomerSr+"'>Update</a> </td>";Calling Model Through JS Function
              d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";*/
            da +="</tr>";
        var table = $("#ReportTable");
        table.append(da);  
        }
      }
  </script>
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