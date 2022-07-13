    <?php
      include('Header.php');
    ?>
<body>
    <div class="wrapper">
    <div class="container mt-5">
      <h4 class="T">Purchase Reports</h4>
      <div class="form-group">
          <input type="text" name="Name" onkeyup="SearchByName()" placeholder="SearchByName" id="SearchByName">
      </div>
      <table class="wid table table-bordered table-hover" id="tabledata">
        <thead class="bg-primary text-white">
          <tr>
            <th scope="col">Invoice#</th> 
            <th scope="col">Vendor Name</th>
            <th scope="col">Date</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Paid Amount</th>
          </tr>
        </thead>
        <tbody id="ReportTable">
          
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
  
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "Purchase-DisplayDataToFrom.php?from="+from+"&to="+to;//Invoice == Report
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
            var CustomerName = data[i].VendorAddress;    //InvoiceNo,CustomerAddress,Amount,Date,Paid
            var TotalAmount = data[i].Paid;
            var DDY = data[i].Date;
            var PaidAmount = data[i].Paid;
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='Invoice' class='CustomerName'><a href='InvoiceReport.php?id="+sr+"'>"+ sr +" </a></td>";
              d +="<td data-target='CustomerName' id='CustomerName' class='CustomerPhone' >"+ CustomerName + "</td>";
              d +="<td data-target='DDY' id='DDY' class='CustomerAddress' >"+ DDY + "</td>";
              d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ TotalAmount + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ PaidAmount + "</td>";
              /*d +="<td> <a href='#' data-role='update' data-id='"+CustomerSr+"'>Update</a> </td>";Calling Model Through JS Function
              d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";*/
            d +="</tr>";
          }
          document.getElementById("ReportTable").innerHTML = d;
        }
      }
      function SearchByName() 
    {
      var input, filter, table, tr, td, i;
      input = document.getElementById("SearchByName");
      filter = input.value.toUpperCase();
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
  </script>
