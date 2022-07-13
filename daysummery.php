 <?php
      include('Header.php');
    ?>
   <body>
  
 <div class="wrapper">
    <div class="container mt-5">
      <h4 class="T" id="h-date"></h4>
      <table class="wid table table-bordered table-hover" id="tabledata">
        <thead class="bg-primary text-white">
          <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Sold Qty</th>
            <th scope="col">UnitRate</th>
            <th scope="col">ProductRate</th> 
          </tr>
        </thead>
        <tbody id="ReportTable" style="background: white"></tbody>
      </table>
      <div style="margin-top: 5px; float: right; color: white">
          <b class="col-sm2">Total Amount:</b>
          <b class="col-sm2" id="b-totalamount"></b>
          <br>
          <b class="col-sm2">Discount:</b>
          <b class="col-sm2" id="b-discount"></b> 
            <br>
          <b class="col-sm2">Total Sale:</b>
          <b class="col-sm2" id="b-Sale"></b>      
          <br>
          <b class="col-sm2">GST:</b>
          <b class="col-sm2" id="b-gst"></b>
          <br>
          <b class="col-sm2">Grand Total:</b>
          <b class="col-sm2" id="b-grandtotal"></b>        
      </div>
    </div>
  </div>

  </body>
  <script type="text/javascript">
  var date = getUrlVars()["date"];
  function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
  vars[key] = value;
  });
  return vars;
  }
  document.getElementById("h-date").innerHTML = date;
 
  var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "daygetdata.php?date="+date;//Invoice == Report
      var asyn = true;
      //Ajax open XML Request
      ajax.open(method,url,asyn);
      ajax.send();
      //ajax call for display
      ajax.onreadystatechange = function ReportDisplay()
      {
        if(this.readyState == 4 && this.status == 200)
        {
          /*var data = JSON.parse(this.responseText);
          */
          var data=JSON.parse(this.responseText);
            
          console.log(data);
          var d = "";
          var ret = 0;
          for (var i = 0; i<data.length ; i++)
          {
            /*ProductName,OrderQuantity,UnitRate,ProductRate,ProductName*/
            var ProductName = data[i].ProductName;    //InvoiceNo,CustomerAddress,Amount,Date,Paid
            var OrderQuantity = data[i].OrderQuantity;
            /*var UnitRate = data[i].UnitRate;*/
            var ProductRate = data[i].ProductRate;
            var UnitRate = parseFloat(ProductRate)/parseFloat(OrderQuantity);
            
            d += "<tr data-id='"+ProductName+"'>";
              d +="<td data-target='Invoice' class='CustomerName'>"+ ProductName +"</td>";
              d +="<td data-target='CustomerName' id='CustomerName' class='CustomerPhone' >"+ OrderQuantity + "</td>";
              d +="<td data-target='DDY' id='DDY' class='CustomerAddress' >"+ UnitRate + "</td>";
              d +="<td data-target='DDY' id='DDY' class='CustomerAddress' >"+ ProductRate + "</td>";
              /*d +="<td> <a href='#' data-role='update' data-id='"+CustomerSr+"'>Update</a> </td>";Calling Model Through JS Function
              d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";*/
            d +="</tr>";
          }
          document.getElementById("ReportTable").innerHTML = d;
          var Row = '';
          var sq = 0;
          var ur = 0;
          var pr = 0;
          var Totals = 0;
          var TotalRows = document.getElementById("ReportTable").rows.length;

        for( i = 0; i<TotalRows; i++)
        {
           var SQ = document.getElementById("ReportTable").rows[i].cells.item(1).innerHTML;
           var UR = document.getElementById("ReportTable").rows[i].cells.item(2).innerHTML;
           var PR = document.getElementById("ReportTable").rows[i].cells.item(3).innerHTML;
            
            sq = parseFloat(SQ)+sq;
            ur = parseFloat(UR)+ur;
            pr = parseFloat(PR)+pr;
          
        }
        var table = $("#ReportTable");
            Row += "<tr>";
                Row +="<td data-target='num' ></td>";
                Row +="<td data-target='Debit' id='Debit' ><b>"+ sq + "</b></td>";
                Row +="<td data-target='Credit' id='Credit' ><b>"+ur  + "</b></td>";
                Row +="<td data-target='Credit' id='Credit' ><b>"+pr  + "</b></td>";
                Row +="</tr>";
                table.append(Row);
                document.getElementById("b-totalamount").innerHTML = Totals;
                gettotal();
        }
      }
      function gettotal()
      {
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "daygetinvoicedetail.php?date="+date;
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
            /*Amount,Paid,discount,Balance,grandtotal*/
            var Amount = data[i].Amount;
            var Paid = data[i].Paid;
            var discount = data[i].discount;
            var Balance = data[i].Balance;
            var grandtotal = data[i].grandtotal;
            var totalsale = (parseFloat(Amount)-parseFloat(discount));
            var gst = parseFloat(grandtotal)-(parseFloat(Amount)-parseFloat(discount));
            
            document.getElementById("b-totalamount").innerHTML = Amount;
            document.getElementById("b-discount").innerHTML = discount;
            document.getElementById("b-gst").innerHTML = gst;
            document.getElementById("b-grandtotal").innerHTML = grandtotal;
            document.getElementById("b-Sale").innerHTML = totalsale;

          }
        }
      }
       }
  </script>
</html>