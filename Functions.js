function CustomerDisplayData(){
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "Customer-DisplayData.php";
    var asyn = true;
    //Ajax open XML Request
    ajax.open(method,url,asyn);
    ajax.send();

    ajax.onreadystatechange = function displayCustomer()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var d = "";

            for (var i = 0; i<data.length ; i++)
            {
                var CustomerSr = data[i].CustomerSr;
                var CustomerName = data[i].CustomerName;    //CustomerSr,CustomerName,CustomerPhone,CustomerAddress,TotalAmount,PaidAmount
                var CustomerPhone = data[i].CustomerPhone;
                var CustomerAddress = data[i].CustomerAddress;
                var TotalAmount = data[i].TotalAmount;
                var PaidAmount = data[i].PaidAmount;

                d +="<option value='"+CustomerPhone+"' > "+ CustomerAddress + " </option>";
            }
            document.getElementById("CustomerOrder").innerHTML = d;
        }
    }
}
function StockDisplayData(){
        var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "GetStock.php";
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
                var sr = data[i].Sr;
                var Product = data[i].Product;
                var Quantity = data[i].Quantity;
                var Price = data[i].Rate;
                var Total = data[i].Total;
                var Profit = data[i].Profit

                Row += "<tr id='"+sr+"' >";
                Row +="<td>"+ Product+ "</td>";
                Row +="<td>"+ Quantity + "</td>";
                Row +="<td>"+ Price + "</td>";
                Row +="<td>"+ Total + "</td>";
                Row +="<td class='dis'>"+ Profit + "</td>";
                Row +="<td class='d-print-none'> <input type='button' id='"+sr+"' Value='X' class='Delete btn btn-danger '> </td>";
                Row +="</tr>";

            }
            document.getElementById("OrderTable").innerHTML = Row;
        }
    }
}
function TemporaryDataDisplay(){
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "Amount.php";
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
                TotalProfit = data[i].TotalProfit;
            }
            document.getElementById("TotalAmount").innerHTML = TotalAmount;
            document.getElementById("TotalProfit").innerHTML = TotalProfit;
            document.getElementById("Balance").innerHTML = TotalAmount;
           
        }
    }
    }
    function ProductDisplay(){
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
                var BikeName = data[i].BikeName;
                var PurchasePrice = data[i].PurchasePrice;
                var Price = data[i].Price;
                var Quantity = data[i].Quantity;
                var Stock = data[i].Stock;

                d +="<option id='"+sr+"' name='"+Price+"' title='"+Stock+"' value='"+ProductName+"'>"+Price+"</option>";
            }
            document.getElementById("OrderProduct").innerHTML = d;
            /*disable();*/
        }
    }
    }    
    function disable()
    {
        var op = document.getElementById("OrderProduct").getElementsByTagName("option");

        for (var i = 0; i < op.length; i++) {
            if (op[i].title <= "1") {
                op[i].disabled = true;

            }
        }

    }
    function CheckStock()
    {
        var e = document.getElementById("OrderProduct");//Getting Product From Select Tag
        var Product = e.options[e.selectedIndex].text;//Getting Product Through Option
        /*var PurchasePrice = e.options[e.selectedIndex].id;//Geting Price By The id of the Option Tag*/
        var Quantity = e.options[e.selectedIndex].title;//Geting Price By The id of the Option Tag
        var OrderQuantity = $("#OrderQuantity").val();//Getting OrderQuantity
        var Order = parseInt(OrderQuantity);
        
        if (Quantity < Order)
        {
            alert(Product+" in Stock is = "+Quantity);
            location.reload();
            /*document.getElementById("OrderQuantity").innerHTML = Quantity;*/
        }

    }
    //Creating Order
    $(document).ready(function()

    {
        $("#AddButton").click(function Order()//Function to Select Product And Quantity
        {
            var table = $("#OrderTable");

            var Product = $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('Value');
            
            var Price = $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('name');
            var PurchasePrice = $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('id');
            var OrderQuantity = $("#OrderQuantity").val();//Getting OrderQuantity
            var Total = Number(Price) * Number(OrderQuantity);//Total For One Item
            var Profit = (Number(Price)-Number(PurchasePrice))*Number(OrderQuantity);
            var Row = "";
            var Print = "";
            //document.getElementById("OrderProduct").options[selIndex].hidden = true;


            TotalItems = TotalItems+1;
            Row += "<tr id='"+TotalItems+"' >";
            Row +="<td>"+ Product+ "</td>";
            Row +="<td>"+ OrderQuantity + "</td>";
            Row +="<td>"+ Price + "</td>";
            Row +="<td>"+ Total + "</td>";
            Row +="<td class='dis' >"+ Profit + "</td>";
            Row +="<td class='d-print-none'> <input type='button' Value='X' class='Delete btn btn-danger '> </td>";
            Row +="</tr>";


            table.append(Row);
            var TotalProfit = $("#TotalProfit").text();
            TotalProfit = parseInt(TotalProfit)+Profit;
            document.getElementById("TotalProfit").innerHTML = TotalProfit;
           
            var TotalAmount = $("#TotalAmount").text();
            TotalAmount = parseInt(TotalAmount)+Total;
            document.getElementById("TotalAmount").innerHTML = TotalAmount;

            document.getElementById("OrderQuantity").value = 0;
            MinusStock(Product,OrderQuantity,PurchasePrice);
            TempData(Product,OrderQuantity,Price,Total,TotalAmount,TotalProfit,Profit);//Temprary Data Table To Save Invoice/Order Tempraroy


        });
    });
    function TempData(Product,OrderQuantity,Price,Total,TotalAmount,TotalProfit,Profit)
    {
        
        var Flag = 2;
        $.ajax({
            url: 'StockManagment.php', //url from where we get data accesing DataBase
            data: {Product:Product, OrderQuantity:OrderQuantity, Price:Price,Total:Total,TotalAmount:TotalAmount,TotalProfit:TotalProfit,Profit:Profit,Flag:Flag},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {
                location.reload();
                //displaing received msg into div ID as #result
            }
        });
    }
    function MinusStock(Product,OrderQuantity,PurchasePrice)
    {
        var Flag = 0;
        $.ajax({
            url: 'StockManagment.php', //url from where we get data accesing DataBase
            data: {Product:Product, OrderQuantity:OrderQuantity, PurchasePrice:PurchasePrice, Flag:Flag},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {
                //displaing received msg into div ID as #result
                /*alert(data);*/
                
            }
        });
    }
    //Delete Function
    $(document).on('click','.Delete',function Delete(){
        var del_id= $(this).attr('id');
        var $ele = $(this).parent().parent();
        var delAmount =   $(this).parent().siblings(":eq(3)").text();
        var delProfit = $(this).parent().siblings(":eq(4)").text();
        var ProductName = $(this).parent().siblings(":eq(0)").text();
        var ReAddQuantity = $(this).parent().siblings(":eq(1)").text();
        var Flag = 1;

        var TotalAmount = $("#TotalAmount").text();
        TotalAmount = parseInt(TotalAmount) - delAmount;
        document.getElementById("TotalAmount").innerHTML = TotalAmount;
        
        var TotalProfit = $("#TotalProfit").text();
        TotalProfit = parseInt(TotalProfit) - delProfit;
        document.getElementById("TotalProfit").innerHTML = TotalProfit;
        $ele.fadeOut().remove();

        DelTem(del_id);

        $.ajax({
            url: 'StockManagment.php', //url from where we get data accesing DataBase
            data: {ProductName:ProductName, ReAddQuantity:ReAddQuantity,TotalAmount:TotalAmount,TotalProfit:TotalProfit, Flag:Flag},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {
                location.reload();
            }
        });
    });
    function DelTem(del_id)
    {
        var Flag = 3;

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
                var e = document.getElementById("CustomerOrder");//Getting Address From Select Tag
                var Address = e.options[e.selectedIndex].text;//Getting Address in string Through Option
                var DDY = $("#Calender").val();
                var Time = new Date().toLocaleTimeString();
                var TotalProfit = $("#TotalProfit").text();
                var TotalAmount = $("#TotalAmount").text();//Text From A Div
                var PaidAmount = $("#Received").val();
                var ClaimAmount = $("#ClaimAmount").val();
                var Balance = $("#Balance").text();
                var InvoiceNo = Math.floor((Math.random() * 10000) + 1);
                var sr = 0;
                $.ajax({
                    url: 'InvoiceSave.php', //url from where we get data accesing DataBase
                    data: {InvoiceNo:InvoiceNo, Address:Address, DDY:DDY, TotalAmount:TotalAmount,ClaimAmount:ClaimAmount,Balance:Balance, PaidAmount:PaidAmount,TotalProfit:TotalProfit,Time:Time},//passing data to php page in which php will send data to Database
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
                            var UP = '';
                            var Row = 1;
                            var TotalRows = document.getElementById("OrderTable").rows.length;

                            for( i = 0; i<TotalRows; i++)
                            {
                                for( j= 0; j<5; j++)
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
                                    else if (j==4) 
                                    {
                                        UP = document.getElementById("OrderTable").rows[i].cells.item(j).innerHTML;   
                                    }
                                }

                                $.ajax({
                                    url: 'Invoice-Product.php', //url from where we get data accesing DataBase
                                    data: {Row:Row,InvoiceNo:InvoiceNo,PN:PN, PQ:PQ, UR:UR, TA:TA,DDY:DDY,UP:UP},//passing data to php page in which php will send data to Database
                                    type: 'POST',
                                    success:function(data){
                                     callurl(data);
                                    }
                                });
                                Row = Row+1;
                            }
                            
                            alert("Invoice Successfully Saved");
                            CustomerManagment(Address,TotalAmount,PaidAmount,Balance);
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
        var url = "InvoiceReport.php?id="+sr;
                            window.location.href = url;
    }

    function CustomerManagment(Address,TotalAmount,PaidAmount,Balance)
    {
        $.ajax({


            url: 'CustomerManagmet.php', //url from where we get data accesing DataBase
            data: {Address:Address,TotalAmount:TotalAmount,PaidAmount:PaidAmount, Balance:Balance},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data){
                //displaing received msg into div ID as #result
            }
        });
    }

    function DelTemperory()
    {
        var Flag = 4;
        $.ajax({
            type:'POST',
            url:'StockManagment.php',
            data:{Flag:Flag},
            success: function(data){
            }

        });
    }