<style type="text/css">
    .wrapper{
        color: white;
    }
</style>
<?php
include('Header.php');
?>
<div class="wrapper" >
    <div class="container mt-5">
         <h4 class="T" >INVOICE # <span id="s-invoiceno"></span></h4>

        <div class="table">
            <table class="wid table table-bordered table-hover"name="mytable" id="mytable">
                <thead class="text-white" style="background-color: chocolate;">
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">UnitRate</th>
                    <th scope="col">Total Amount</th>
                </tr>
                </thead>
                <tbody id="OrderTable">

                </tbody>
            </table>
        </div>
        <div style="margin-top: 5px; float: right;">
            
                	
                	<div id="Total" style="margin-bottom:10px">
                    	<b class="col-sm2"> Total Amount:</b>
                    	<b class="col-sm2" id="TotalAmount">0</b>
               		</div>

               		
                    <div id="Paid" style="margin-bottom:10px">
                    	<b class="col-sm2"> Paid Amount:  &nbsp</b>
                    	<input class="col-sm2" type="number" id="Received" oninput="ReceivedFunction()">
                	</div>

                	<div id="Bal" style="margin-bottom:10px">
                   		<b class="col-sm2"> Balance:</b>
                   		<span class="col-sm2" id="Balance"></span>
              		</div>

              
                   
                        <button type="submit" id="SaveButton" class="btn-primary btn"> Save </button>
        </div>
    </div>
</div>
</body>
</html>

 <script type="text/javascript">
     var id = getUrlVars()["id"];
  function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
  vars[key] = value;
  });
  return vars;
  }
   document.getElementById("s-invoiceno").innerHTML = id;


    //Geting data from temprory table on page load
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "Displaypurchaseinvoicedetail.php?id="+id;
    var asyn = true;
    var Row = "";
    //Ajax open XML Request
    ajax.open(method,url,asyn);
    ajax.send();

    ajax.onreadystatechange = function display()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var d = "";

            for (var i = 0; i<data.length ; i++)
            {
                var sr = data[i].sr;
                var Product = data[i].ProductName;
                var Quantity = data[i].PurchaseQuantity;
                var Price = data[i].UnitRate;
                var Total = data[i].ProductRate;
                
                Row += "<tr id='"+sr+"' >";
                Row +="<td>"+ Product+ "</td>";
                Row +="<td>"+ Quantity + "</td>";
                Row +="<td>"+ Price + "</td>";
                Row +="<td>"+ Total + "</td>";
                Row +="</tr>";

            }
            document.getElementById("OrderTable").innerHTML = Row;
            TotalAmountCalculator();
        }
    }
</script>


<script type="text/javascript">

    /*Saving Inoice To DB*/
    $(document).ready(function()
    {
        $("#SaveButton").click(function Order()//Function to Select Product And Quantity
            {
                $("#SaveButton").attr("disabled", true);
                
                var id = $("#s-invoiceno").text();
                var PaidAmount = $("#Received").val();
                var Balance = $("#Balance").text();
                alert(PaidAmount+','+Balance+','+id);
                $.ajax({
                    url: 'PurchaseInvoiceUpdateSave.php', //url from where we get data accesing DataBase
                    data: {id:id,Balance:Balance, PaidAmount:PaidAmount},//passing data to php page in which php will send data to Database
                    type: 'POST',
                    success:function(data){
                        
                        
                            alert("Invoice Successfully Updated");
                            callurl(data);
                        
                    }
                });
            }
        )
    });

    function callurl(sr)
    {
        var url ="PurchaseInvoiceReport.php?id="+sr;
                            window.location.href = url;
    }

</script>

<script type="text/javascript">
   
    function ReceivedFunction() {
        var TotalAmount = $("#TotalAmount").text();
        var rec = document.getElementById("Received").value;
        var Balance = parseInt(TotalAmount) - rec;

        document.getElementById("Balance").innerHTML = Balance;
    }
    function Balance()
    {
        var TotalAmount = $("#TotalAmount").text();
        var rec = document.getElementById("Received").value;

        var Balance = parseInt(TotalAmount) -rec;
        document.getElementById("Balance").innerHTML = Balance;
    }
    function TotalAmountCalculator()
    {
        var ta = 0;
        var TotalRows = document.getElementById("OrderTable").rows.length;

        for( i = 0; i<TotalRows; i++)
        {
            PN = document.getElementById("OrderTable").rows[i].cells.item(3).innerHTML;
            ta = parseInt(PN)+ta;
        }
        document.getElementById("TotalAmount").innerHTML=ta;
        Balance();
       
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