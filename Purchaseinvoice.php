<style type="text/css">
    .wrapper{
        color: white;
    }
    input#OrderProducts{
        width: 30%;
    }
</style>
<?php
include('Header.php');
?>
<div class="wrapper" >
    <div class="container mt-5">
        <h4 class="T main_bg_color"> Purchase Invoice</h4>
        <div class="container mt-3">
        <div class="d-print-none form-group">
            <input list="OrderProduct" id="OrderProducts">
            <datalist id="OrderProduct" style="padding: 5px"></datalist>

            <label class="lbl" >Order Quantity:</label> <input type="number" name="OrderQuantity" id="OrderQuantity" value="1" placeholder="Quantity" min="1" oninput="validity.valid||(value='');">
            <label class="lbl" >Purchase Price:</label> <input type="number" name="Purchase Price" id="PurchasePrice" value="1" placeholder="Purchase Price" oninput="validity.valid||(value='');"> 
            <input type="button" name="AddButton" id="AddButton" value="Add" class="btn btn-primary">
        </div>
    </div>

        <div class="table">
            <table class="wid table table-bordered table-hover"name="mytable" id="mytable">
                <thead class="text-white" style="background-color: chocolate;">
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">UnitRate</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col" class="d-print-none" >Delete</th>
                </tr>
                </thead>
                <tbody id="OrderTable">

                </tbody>
            </table>
        </div>
        <div class="mt-3" style="float: right;">
            
                	<div id="VendorName">
                        <select class="font-weight-bold col" id="VendorOrder" style="padding: 5px;margin-bottom:10px">
                        </select>
                	</div>
                    <div id="DateSelector" style="margin-bottom:10px"> 
                    	<input class="col-sm" type="date" min="2018-03-01" id="Calender" value="<?php echo date('Y-m-d');?>" name="Calender" >
                	</div>
                    
                	<div id="Total" style="margin-bottom:10px">
                    	<b class="col-sm2"> Total Amount:</b>
                    	<b class="col-sm2" id="TotalAmount">0</b>
               		</div>

               		<div id="Claim dis" style="margin-bottom:10px">
                    	<b class="col-sm2 dis"> Claim Amount:</b>
                    	<input class="col-sm2 dis" type="number"  min="0" onkeyup="Balance()" id="ClaimAmount">
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
    //Geting data from temprory table on page load
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "GetStockPurchase.php";
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
                var Product = data[i].Product;
                var Quantity = data[i].Quantity;
                var Price = data[i].Price;
                var Total = data[i].Total;
                
                Row += "<tr id='"+sr+"' >";
                Row +="<td>"+ Product+ "</td>";
                Row +="<td>"+ Quantity + "</td>";
                Row +="<td>"+ Price + "</td>";
                Row +="<td>"+ Total + "</td>";
                Row +="<td class='d-print-none'> <input type='button' id='"+sr+"' Value='X' class='Delete btn btn-danger '> </td>";
                Row +="</tr>";

            }
            document.getElementById("OrderTable").innerHTML = Row;
        }
    }
</script>

<script type="text/javascript">
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "PurchaseTA.php";
    var asyn = true;
    var TotalAmount = 0;
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
                TotalAmount = data[i].TotalAmount;
            }
            document.getElementById("TotalAmount").innerHTML = TotalAmount;
        }
    }
</script>
<script type="text/javascript">

    //Getting data to display
    var TotalAmount = 0; // Variable declaration for TOTALAMMOUNT OF BILL
    var TotalItems = 0; //DECLARATION OF TOTAL ORDERD ITEMS
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
                var Modal = data[i].Modal;
                var PurchasePrice = data[i].PurchasePrice;
                var Price = data[i].Price;
                var Quantity = data[i].Quantity;
                var Stock = data[i].Stock;
                
                d +="<option id='"+PurchasePrice+"' name='"+Price+"' title='"+Stock+"' value='"+ProductName+"'>"+Price+"</option>";
            	
            }
            document.getElementById("OrderProduct").innerHTML = d;
        
        }
    }
    
    //Creating Order
    $(document).ready(function()

    {
        $("#AddButton").click(function Order()//Function to Select Product And Quantity
        {
            var table = $("#OrderTable");
            var Product = $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('Value');
            var selIndex = document.getElementById("OrderProduct").selectedIndex;
            var Price = $("#PurchasePrice").val();
            var OrderQuantity = $("#OrderQuantity").val();//Getting OrderQuantity
            var Total = Number(Price) * Number(OrderQuantity);//Total For One Item
            var Row = "";
            var Print = "";
            //document.getElementById("OrderProduct").options[selIndex].hidden = true;


            TotalItems = TotalItems+1;
            Row += "<tr id='"+TotalItems+"' >";
            Row +="<td>"+ Product+ "</td>";
            Row +="<td>"+ OrderQuantity + "</td>";
            Row +="<td>"+ Price + "</td>";
            Row +="<td>"+ Total + "</td>";
            Row +="<td class='d-print-none'> <input type='button' Value='X' class='Delete btn btn-danger '> </td>";
            Row +="</tr>";

            table.append(Row);

            var TotalAmount = $("#TotalAmount").text();
            TotalAmount = parseInt(TotalAmount)+Total;
            document.getElementById("TotalAmount").innerHTML = TotalAmount;

            document.getElementById("OrderQuantity").value = 0;
            UpdateStock(Product,OrderQuantity,Price);
            TempData(Product,OrderQuantity,Price,Total,TotalAmount);//Temprary Data Table To Save Invoice/Order Tempraroy


        });
    });
    function TempData(Product,OrderQuantity,Price,Total,TotalAmount)
    {
        
        var Flag = 10;
        $.ajax({
            url: 'StockManagment.php', //url from where we get data accesing DataBase
            data: {Product:Product, OrderQuantity:OrderQuantity, Price:Price,Total:Total,TotalAmount:TotalAmount,Flag:Flag},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {
                location.reload();
            }
        });
    }
    function UpdateStock(Product,OrderQuantity,Price)
    {
        var Flag = 11;
        $.ajax({
            url: 'StockManagment.php', //url from where we get data accesing DataBase
            data: {Product:Product, OrderQuantity:OrderQuantity,Flag:Flag},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {
            }
        });
    }
    //Delete Function
    $(document).on('click','.Delete',function Delete(){
        var del_id= $(this).attr('id');
        var $ele = $(this).parent().parent();
        var delAmount =   $(this).parent().siblings(":eq(3)").text();
        var ProductName = $(this).parent().siblings(":eq(0)").text();
        var ReMinusQuantity = $(this).parent().siblings(":eq(1)").text();
        var Flag = 12;

        var TotalAmount = $("#TotalAmount").text();
        TotalAmount = parseInt(TotalAmount) - delAmount;
        document.getElementById("TotalAmount").innerHTML = TotalAmount;
        
        $ele.fadeOut().remove();

        DelTem(del_id);
        
        $.ajax({
            url: 'StockManagment.php', //url from where we get data accesing DataBase
            data: {ProductName:ProductName, ReMinusQuantity:ReMinusQuantity,TotalAmount:TotalAmount, Flag:Flag},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {
                location.reload();
            }
        });
    });
    function DelTem(del_id)
    {
        var	Flag = 13;

        $.ajax({
            type:'POST',
            url:'StockManagment.php',
            data:{del_id:del_id,Flag:Flag},
            success: function(data){

            }

        });
    }
    /*Saving Inoice To DB*/
    $(document).ready(function()
    {
        $("#SaveButton").click(function Order()//Function to Select Product And Quantity
            {
                $("#SaveButton").attr("disabled", true);
                var e = document.getElementById("VendorOrder");//Getting Address From Select Tag
                var Address = e.options[e.selectedIndex].text;//Getting Address in string Through Option
                var VendorName = e.options[e.selectedIndex].value;
                var DDY = $("#Calender").val();
                var Time = new Date().toLocaleTimeString();
                var TotalAmount = $("#TotalAmount").text();//Text From A Div
                var PaidAmount = $("#Received").val();
                var ClaimAmount = $("#ClaimAmount").val();
                var Balance = $("#Balance").text();
                var InvoiceNo = Math.floor((Math.random() * 10000) + 1);
                var sr = 0;
                /*alert(Address+','+DDY+','+Time+','+TotalAmount+','+PaidAmount+','+ClaimAmount+','+Balance+','+InvoiceNo);*/
                $.ajax({
                    url: 'PurchaseInvoiceSave.php', //url from where we get data accesing DataBase
                    data: {InvoiceNo:InvoiceNo, Address:Address, DDY:DDY, TotalAmount:TotalAmount,ClaimAmount:ClaimAmount,Balance:Balance, PaidAmount:PaidAmount,Time:Time,VendorName:VendorName},//passing data to php page in which php will send data to Database
                    type: 'POST',
                    success:function(data){
                        if (data == "t")
                        {
                            var i = 0;
                            var j = 0;
                            var PN = '';
                            var PQ = '';
                            var UR = '';
                            var TA = '';
                            var Row = 1;
                            var TotalRows = document.getElementById("OrderTable").rows.length;

                            for( i = 0; i<TotalRows; i++)
                            {
                                for( j= 0; j<4; j++)
                                {
                                    if(j==0)
                                    {
                                        PN = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    else if(j==1)
                                    {
                                        PQ = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    else if(j==2)
                                    {
                                        UR = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                    else if(j==3)
                                    {
                                        TA = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;
                                    }
                                }
                                $.ajax({
                                    url: 'PurchaseInvoice-Product.php', //url from where we get data accesing DataBase
                                    data: {Row:Row,InvoiceNo:InvoiceNo,PN:PN, PQ:PQ, UR:UR, TA:TA,DDY:DDY},//passing data to php page in which php will send data to Database
                                    type: 'POST',
                                    success:function(data){
                                     callurl(data);

                                    }
                                });
                                Row = Row+1;
                            }
                            
                            alert("Invoice Successfully Saved");
                            VendorManagment(Address,TotalAmount,PaidAmount,Balance);
                            DelTemperory();
                            /*var url = "InvoiceReport.php?id="+sr;
                            window.location.href = url;*/
                        }
                        else
                        {

                            alert("Not Saved");
                        }
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

    function VendorManagment(Address,TotalAmount,PaidAmount,Balance)
    {
        $.ajax({


            url: 'VendorManagmet.php', //url from where we get data accesing DataBase
            data: {Address:Address,TotalAmount:TotalAmount,PaidAmount:PaidAmount, Balance:Balance},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data){
                //displaing received msg into div ID as #result
            }
        });
    }

    function DelTemperory()
    {
        var Flag = 14;
        $.ajax({
            type:'POST',
            url:'StockManagment.php',
            data:{Flag:Flag},
            success: function(data){
            }

        });
    }

</script>

<script type="text/javascript">
    function ReceivedFunction() {
        var TotalAmount = $("#TotalAmount").text();
        var rec = document.getElementById("Received").value;
        var Claim = document.getElementById("ClaimAmount").value;
        var Balance = parseInt(TotalAmount) - rec - Claim;

        /*if (rec > TotalAmount) {
            document.getElementById("Received").value = TotalAmount; //to set by default total amount.
            document.getElementById("Received").style.background = "grey";
        }*/
        document.getElementById("Balance").innerHTML = Balance;
    }
    function Balance()
    {
        var TotalAmount = $("#TotalAmount").text();
        var Claim = document.getElementById("ClaimAmount").value;
        var rec = document.getElementById("Received").value;

        var Balance = parseInt(TotalAmount) - Claim -rec;
        document.getElementById("Balance").innerHTML = Balance;
    }

</script>

<script type="text/javascript">
    var ajaxC = new XMLHttpRequest();
    var methodC = "Get";
    var urlC = "Vendor-DisplayData.php";
    var asynC = true;
    //Ajax open XML Request
    ajaxC.open(methodC,urlC,asynC);
    ajaxC.send();

    ajaxC.onreadystatechange = function display()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var d = "";

            for (var i = 0; i<data.length ; i++)
            {
                var VendorSr = data[i].VendorSr;
                var VendorName = data[i].VendorName;    //CustomerSr,CustomerName,CustomerPhone,CustomerAddress,TotalAmount,PaidAmount
                var VendorPhone = data[i].VendorPhone;
                var VendorAddress = data[i].VendorAddress;
                var TotalAmount = data[i].TotalAmount;
                var PaidAmount = data[i].PaidAmount;

                d +="<option value='"+VendorName+"' > "+ VendorName + " </option>";
            }
            document.getElementById("VendorOrder").innerHTML = d;
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