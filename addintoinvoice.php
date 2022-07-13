<?php
include('Header.php');
?>
<div class="wrapper" >
        <h4 class="T" >INVOICE # <span id="s-invoiceno"></span></h4>

        <div class="menu HideInTab">
            <h6 class="T">Menu</h6>
            <div class="menuitems" style="margin-left: 5px">
                <table class="table" style="width: 90%;table-layout: fixed;margin: 0px auto">
                    <thead style="background-color: #1e4a3e; color: white;">
                        <tr>
                            <th style="width: 60%">
                                Item
                            </th>

                            <th style="width: 40%">
                                Price
                            </th>
                                
                        </tr>
                    </thead>
                    <tbody id="menutable">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="neworder">
            <h6 class="T" >New Order</h6>

            <div class="additem" style="margin: 20px auto; margin-bottom: 20px; width: 75%;">
                <input list="OrderProduct" placeholder="Select Item" id="OrderProducts" style="width: 70%;border-radius: 25px">
                <datalist id="OrderProduct" style="padding: 5px;margin: 0px auto;"></datalist>
                <input type="button" name="AddButton" id="AddButton" value="Add" class="btn btn-primary" >
                <input list="tableno" placeholder="Table" id="tablenos" style="text-align: center;width: 15%;border-radius: 25px">
                <datalist id="tableno" style="padding: 5px;margin: 0px auto;"></datalist>
            </div>
            <table class="table" name="mytable" id="mytable" align="center" style="margin: 0px auto; table-layout: fixed; width: 90%">
                <thead class="" style="background-color: #134c2c; color: white;">
                <tr>
                    <th scope="col" style="width: 40%">Item</th>
                    <th scope="col" style="width: 15%" >Qty</th>
                    <th scope="col" style="width: 15%">Price</th>
                    <th scope="col" style="width: 15%">SubTotal</th>
                    <th scope="col" style="width: 15%"class="d-print-none">Delete</th>
                </tr>
                </thead>
                <tbody id="OrderTable" style="background-color:; color:white">

                </tbody>
            </table>
            <div style="margin-top: 5px;margin-right: 20px; float: right;max-width: 40%;">
            
                    <div id="Total" style="margin-bottom:10px">
                        <b class="col-sm2"> Total Amount:</b>
                        <b class="col-sm2" id="TotalAmount">0</b>
                    </div>
                    <div id="Total" style="margin-bottom:10px">
                        <b class="col-sm2"> GST :</b>
                        <input type="radio"  name="gst" value="16" onclick="TotalAmountCalculator()" checked="true"><b> 16%</b>
                        <input type="radio" name="gst" value="0" onclick="TotalAmountCalculator()"><b>0%</b> 
                    </div>
                    <div id="Claim" style="margin-bottom:10px">
                        <b class="col-sm2"> OFF :</b>
                        <input type="radio"  name="off" value="1" onclick="TotalAmountCalculator()" checked="true"><b> %</b>
                        <input type="radio" name="off" value="0" onclick="TotalAmountCalculator()"><b>RS.</b> 
                        <input class="col-sm2" type="number" placeholder="DISCOUNT"  min="0" oninput="TotalAmountCalculator()" id="discount">
                    </div>
                    <div id="Bal" style="margin-bottom:10px">
                        <b class="col-sm2"> Grand Total:</b>
                        <b class="col-sm2" id="GrandTotal"></b>
                    </div>
                     <div id="Paid" style="margin-bottom:10px">
                        <input class="col-sm2" type="number" min="0" placeholder="Received Amount" id="Received" oninput="ReceivedFunction()">
                    </div>
                    <div id="Bal" style="margin-bottom:10px">
                        <b class="col-sm2"> Balance:</b>
                        <b class="col-sm2" id="Balance"></b>
                    </div>
                <button type="submit" id="SaveButton" class="btn-primary btn" style="margin-bottom: 10px"> Save </button>
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
 
    //Getting data to display
    var d = '';
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "ap-gettable.php";
    var asyn = true;
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
                var tableno = data[i].tableno;
                
                d +="<option id='"+sr+"' value='"+tableno+"'>"+tableno+"</option>";
            }
            document.getElementById("tableno").innerHTML = d;
            /*disable();*/
        }
    }
</script>
<script type="text/javascript">
    
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
        AddGST();
        Balance();
    }
    function AddGST()
    {
        var ta = document.getElementById("TotalAmount").innerHTML;
        var tai = parseInt(ta);
        var gstValue = $("input[name='gst']:checked").val();
        var gst = (tai/100)*gstValue;
        var gt = tai+gst;
        document.getElementById("GrandTotal").innerHTML=gt;
        document.getElementById("Balance").innerHTML=gt;
    }
      function ReceivedFunction(){
        var GrandTotal = $("#GrandTotal").text();
        var rec = document.getElementById("Received").value;
        var Balance = parseInt(GrandTotal) - rec;
        document.getElementById("Balance").innerHTML = Balance;
    }

    function Balance(){   
        var GrandTotal = $("#GrandTotal").text();
        var discount = document.getElementById("discount").value;
        var rec = document.getElementById("Received").value;

         var offValue = $("input[name='off']:checked").val();
        if (offValue == 1) {
            
            var Bal = (parseInt(GrandTotal)/100)*discount;
            var Balance = parseInt(GrandTotal)-Bal-rec;
        }
        else{
            var Balance = parseInt(GrandTotal) - discount -rec;    
        }
        document.getElementById("GrandTotal").innerHTML = Balance;
        document.getElementById("Balance").innerHTML = Balance;
    }
</script>

<script type="text/javascript">

    //Getting data to display
    var TotalAmount = 0; // Variable declaration for TOTALAMMOUNT OF BILL
    var TotalItems = 0; //DECLARATION OF TOTAL ORDERD ITEMS
    var Row = '';
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "ap-GetData.php";
    var asyn = true;
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
                var ProductName = data[i].ProductName;
                var BikeName = data[i].BikeName;
                var Modal = data[i].Modal;
                var PurchasePrice = data[i].PurchasePrice;
                var Price = data[i].Price;
                var Quantity = data[i].Quantity;
                var Stock = data[i].Stock;
                Row +="<tr>";
                Row +="<td><button style='background-color:#1b775e;color:white;max-width:300px;width:300px'>"+ProductName+"</button></td>";
                Row +="<td>"+Price+"</td>";
                Row +="</tr>";
                
                 if (Modal !== "ASSET") 
                {
                d +="<option id='"+sr+"' name='"+Price+"' title='"+Stock+"' value='"+ProductName+"'>"+Price+"</option>";     
                }
            }
            document.getElementById("OrderProduct").innerHTML = d;

            /*disable();*/
        }
    }
    
    $(document).ready(function()

    {
        $("#AddButton").click(function Order()//Function to Select Product And Quantity
        {
            var table = $("#OrderTable");
            document.getElementById("OrderProducts").innerHTML = null;
            var Product = $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('Value');
            var Price =  $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('name');   
            var Row = "";
            var Print = "";
            //document.getElementById("OrderProduct").options[selIndex].hidden = true;
            TotalItems = TotalItems+1;
            Row += "<tr id='"+TotalItems+"' >";
            Row +="<td>"+ Product+ "</td>";
            Row +="<td> <input class='AddQuantity' type='number'  style=' border-radius:25px; width:75px; text-align:center' id='"+TotalItems+"' min='"+1+"'></td>";
            Row +="<td>"+ Price + "</td>";
            Row +="<td>"+ Price + "</td>";
            Row +="<td class='d-print-none'> <input type='button' Value='X' class='Delete btn btn-danger ' id="+TotalItems+"> </td>";
            Row +="</tr>";

            table.append(Row);
            TotalAmountCalculator();
        
        });

        $(document).on('input','.AddQuantity',function(e){
        var id = $(this).attr('id');
        var $ele = $(this).parent().parent();
        var Q = $(this).val();
        var P  = $(this).parent().siblings(":eq(1)").text();
        var ST = parseInt(Q)*parseInt(P);
        $(this).parent().siblings(":eq(2)").text(ST);
        TotalAmountCalculator();
        });
    });
    
    //Delete Function
    $(document).on('click','.Delete',function Delete(){
        var del_id= $(this).attr('id');
        var $ele = $(this).parent().parent();
        $ele.fadeOut().remove();
        TotalAmountCalculator();
    });
    /*Saving Inoice To DB*/
    $(document).ready(function()
    {
        $("#SaveButton").click(function Order()//Function to Select Product And Quantity
            {
            var tableno = $("#tableno option[value='" + $('#tablenos').val()+ "']").attr('Value');
            if (tableno != undefined) 
            {
                var DDY = new Date();
                var dd = DDY.getDate();
                var mm = DDY.getMonth()+1; //January is 0!
                var yyyy = DDY.getFullYear();
                var d = yyyy + '-' + mm + '-' + dd;
                
                var TotalAmount = $("#TotalAmount").text();//Text From A Div
                var Discount   = $("#discount").val();
                var offValue = $("input[name='off']:checked").val();
                if (offValue == 1) {
                    
                var Discount = (parseInt(TotalAmount)/100)*Discount;
                }

                var GrandTotal = $("#GrandTotal").text();
                var PaidAmount = $("#Received").val();
                var Balance = $("#Balance").text();
                var user = "<?php echo $username?>";

                $.ajax({
                    url: 'AddIntoTable_InvoiceSave.php', //url from where we get data accesing DataBase
                    data: {id:id,DDY:DDY, TotalAmount:TotalAmount,Discount:Discount,Balance:Balance, PaidAmount:PaidAmount,GrandTotal:GrandTotal,user:user,tableno:tableno},//passing data to php page in which php will send data to Database
                    dataType: 'json',
                    type: 'POST',
                    cache:false,
                    success:function(data){
                    	var InvoiceNo =	data.d2;
                        if (data.d1 == "t")
                        {
                            var i = 0;
                            var j = 0;
                            var PN = '';
                            var TA = '';
                            var UP = '';
                            var Row = tableno;
                            var TotalRows = document.getElementById("OrderTable").rows.length;

                            for( i = 0; i<TotalRows; i++)
                            {
                                for( j= 0; j<4; j++)
                                {
                                    if(j==0)
                                    {
                                        PN = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    else if(j==2)
                                    {
                                        UP = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    else if(j==3)
                                    {
                                        TA = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    var Q = parseInt(TA)/parseInt(UP);
                                }

                                $.ajax({
                                    url: 'Invoice-Product.php', //url from where we get data accesing DataBase

                                    data: {Row:Row,InvoiceNo:InvoiceNo,PN:PN,UP:UP,TA:TA,Q:Q,DDY:DDY,d:d},//passing data to php page in which php will send data to Database
                                    type: 'POST',
                                    success:function(data){
                                  callurl(data);
                                    }
                                });
                                MinusStock(PN,Q);
                            }
                            
                            alert("Invoice Successfully Updated");
                        }
                        else
                        {
                            alert("Not Saved");
                        }
                    }
                });
            }
            else{
                /*For remaining same table*/
                var DDY = new Date();
                var dd = DDY.getDate();
                var mm = DDY.getMonth()+1; //January is 0!
                var yyyy = DDY.getFullYear();
                var d = yyyy + '-' + mm + '-' + dd;
                
                var TotalAmount = $("#TotalAmount").text();//Text From A Div
                var Discount   = $("#discount").val();//text from input field
                var offValue = $("input[name='off']:checked").val();
                if (offValue == 1) {
                    
                var Discount = (parseInt(TotalAmount)/100)*Discount;
                }
                var GrandTotal = $("#GrandTotal").text();
                var PaidAmount = $("#Received").val();
                var Balance = $("#Balance").text();
                var user = "<?php echo $username?>";
                tableno = "none";
                $.ajax({
                    url: 'AddIntoTable_InvoiceSave.php', //url from where we get data accesing DataBase
                    data: {id:id,DDY:DDY, TotalAmount:TotalAmount,Discount:Discount,Balance:Balance, PaidAmount:PaidAmount,GrandTotal:GrandTotal,user:user,tableno:tableno},//passing data to php page in which php will send data to Database
                    dataType: 'json',
                    type: 'POST',
                    cache:false,
                    success:function(data){
                        var InvoiceNo = data.d2;
                        if (data.d1 == "t")
                        {
                            var i = 0;
                            var j = 0;
                            var PN = '';
                            var TA = '';
                            var UP = '';
                            var Row =tableno;
                            var TotalRows = document.getElementById("OrderTable").rows.length;

                            for( i = 0; i<TotalRows; i++)
                            {
                                for( j= 0; j<4; j++)
                                {
                                    if(j==0)
                                    {
                                        PN = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    else if(j==2)
                                    {
                                        UP = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    else if(j==3)
                                    {
                                        TA = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    var Q = parseInt(TA)/parseInt(UP);
                                }

                                $.ajax({
                                    url: 'Invoice-Product.php', //url from where we get data accesing DataBase

                                    data: {Row:Row,InvoiceNo:InvoiceNo,PN:PN,UP:UP,TA:TA,Q:Q,DDY:DDY,d:d},//passing data to php page in which php will send data to Database
                                    type: 'POST',
                                    success:function(data){
                                  callurl(data);
                                    }
                                });
                                 MinusStock(PN,Q);
                            }
                            
                            alert("Invoice Successfully Updated");
                        }
                        else
                        {
                            alert("Not Saved");
                        }
                    }
                });
            }
            }
        )
    });
    
    function MinusStock(Product,OrderQuantity)
    {
        var Flag = 0;
        $.ajax({
            url: 'StockManagment.php', //url from where we get data accesing DataBase
            data: {Product:Product, OrderQuantity:OrderQuantity, Flag:Flag},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {   
            }
        });
    }
    function callurl(sr)
    {
        var url = "Invoice.php";
                            window.location.href = url;
    }
</script>

<!-- to set Received amount according to total amount-->
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