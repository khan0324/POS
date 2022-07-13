    <?php include 'HeaderOnPrintPage.php';?>
    <div class="wrapper">
    <div class="container mt-5" >
      <h4 class="T" style="width: 50%"><span id="s-from"></span>&nbsp<span>TO</span>&nbsp<span id="s-to"></span></h4>
     
      <table class="wid table table-bordered table-hover" id="tabledata">
        <thead class="text-white" style="background-color: chocolate">
          <tr>
            <th scope="col">Invoice#</th> 
            <th scope="col">Date</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Discount</th>
            <th scope="col">Order Taker</th>    
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
      var from = getUrlVars()["from"];
      function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
      });
      return vars;
      }
      var to = getUrlVars()["to"];
      function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
      });
      return vars;
      }
      document.getElementById("s-from").innerHTML = from;
      document.getElementById("s-to").innerHTML = to;
  
      var ta = 0;
      var PN = 0;
      var d = '';
      var da = '';
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "Report-DisplayDataToFrom.php?from="+from+"&to="+to;//Invoice == Report
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
          for (var i = 0; i<data.length ; i++)
          {
            var sr = data[i].sr;
            var Invoice = data[i].InvoiceNo;
            var CustomerName = data[i].CustomerAddress;    //InvoiceNo,CustomerAddress,Amount,Date,Paid
            var TotalAmount = data[i].Amount;
            var DDY = data[i].Date;
            var discount = data[i].discount;
            var GrandTotal = data[i].grandtotal;
            var user = data[i].user;
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='Invoice' class='CustomerName'><a href='InvoiceReport.php?id="+sr+"'>"+ sr +" </a></td>";
              d +="<td data-target='DDY' id='DDY' class='CustomerAddress' >"+ DDY + "</td>";
              d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ GrandTotal + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ discount + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ user + "</td>";
              d +="<td><a href='#' id='"+user+"' class='update'>Update</a></td>"; 
              /*d +="<td> <a href='#' data-role='update' data-id='"+CustomerSr+"'>Update</a> </td>";Calling Model Through JS Function
              d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";*/
            d +="</tr>";
            ta = parseInt(TotalAmount)+ta;
          }
          document.getElementById("ReportTable").innerHTML = d;
          da += "<tr>";
              da +="<td data-target='Invoice' class='CustomerName'></td>";
              da +="<td data-target='DDY' id='DDY' class='CustomerAddress'><b>TOTAL SALE</b></td>";
              da +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' ><b>"+ ta + "</b></td>";
              da +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' ></td>";
              /*d +="<td> <a href='#' data-role='update' data-id='"+CustomerSr+"'>Update</a> </td>";Calling Model Through JS Function
              d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";*/
            da +="</tr>";
        var table = $("#ReportTable");
        table.append(da);      
        }
      }
       $(document).on('click','.update',function(e){
      var id = $(this).attr('id');
      var url = "editinvoice.php?id="+id+"&tab="+404;
                            window.location.href = url;
    });

      function printPage() {
    window.print();
}

      
    
  </script>
