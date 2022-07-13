    <?php
      include('Header.php');
    ?>
    
<body>
    <div class="wrapper">
    <div class="container mt-5">
      <h4 class="T">RECEIVING PAYMENT RECEIPTS</h4>
      <div class="form-group">
          <input type="Date" class="datepicker" onchange="SearchByDate()" placeholder="Select Date" id="datepicker">
          <input type="text" name="Name" onkeyup="SearchByName()" placeholder="SearchByName" id="SearchByName"> 
      </div>
      <table style="" class="table table-bordered table-hover" id="tabledata">
        <thead class="" style="background-color:#007bff; color: white">
          <tr>
            <th scope="col" class="in" style="width: 15%">Receipt#</th>
            <th scope="col" class="in" style="width: 15%">Cutomer Name</th>
            <th scope="col" class="in" style="width: 15%">Date</th>
            <th scope="col" class="in" style="width: 15%">Paid Amount</th>
          </tr>
        </thead>
        <tbody id="ReportTable" style="text-align: center;">
          
        </tbody>
      </table>
    </div>
    </div>
  </body>
  <script type="text/javascript">
    //Display Function For Customer
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "Receipt-DisplayData.php";//Invoice == Report
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
            var CustomerName = data[i].CustomerName;    //InvoiceNo,CustomerAddress,Amount,Date,Paid
            var DDY = data[i].dat;
            var PaidAmount = data[i].ReceivedAmount;
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='Invoice' class='CustomerName'><a href='PrintReceipt.php?id="+sr+"'>"+ sr +" </a></td>";
              d +="<td data-target='CustomerName' id='CustomerName' class='CustomerPhone' >"+ CustomerName + "</td>";
              d +="<td data-target='DDY' id='DDY' class='CustomerAddress' >"+ DDY + "</td>";
              d +="<td data-target='PaidAmount' id='PaidAmount' class='Balance' >"+ PaidAmount + "</td>";
            d +="</tr>";
          }
          document.getElementById("ReportTable").innerHTML = d;
        }
      }
  </script>
  <script type="text/javascript">
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
    function SearchByName() 
    {
      var input, filter, table, tr, td, i;
      input = document.getElementById("SearchByName");
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