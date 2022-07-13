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

        </tbody>
      </table>
     
    </div>
    </div>
  </body>
  <script type="text/javascript">
    //Display Function For Customer
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "salesummery-DisplayData.php"; //Invoice == Report
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
            var TotalAmount = data[i].Amount;
            var DDY = data[i].d;
            var PaidAmount = data[i].Paid;
            var discount = data[i].discount;
            var gt = data[i].grandtotal;
            var gst = parseFloat(gt)-(parseFloat(TotalAmount)-parseFloat(discount));
           
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='DDY' id='DDY' class='CustomerAddress' ><a href='daysummery.php?date="+DDY+"'>"+ DDY + "</a></td>";
              d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ TotalAmount + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ discount + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ gst + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ gt + "</td>";
              
            d +="</tr>";
          }
          document.getElementById("ReportTable").innerHTML = d;
          var ta = 0;
          var pa = 0;
          var d = 0;
          var TotalRows = document.getElementById("ReportTable").rows.length;

        for( i = 0; i<TotalRows; i++)
        {
           var TA = document.getElementById("ReportTable").rows[i].cells.item(1).innerHTML;
           var PA = document.getElementById("ReportTable").rows[i].cells.item(2).innerHTML;
           var D = document.getElementById("ReportTable").rows[i].cells.item(3).innerHTML;
            
            ta = parseFloat(TA)+ta;
            pa = parseFloat(PA)+pa;
            d = parseFloat(D)+d;
        }
        var cr = parseFloat(ta)-parseFloat(pa);
        }
      }

        
           
    
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