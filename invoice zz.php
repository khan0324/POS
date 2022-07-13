<?php
include('Header.php');
?>
<div class="wrapper" >
        <h4 class="T" >POS</h4>

        <div class="menu">
            <h6 class="T returnH6">Running Table</h6>
            <div class="menuitems">
                <div id="view">   </div>
                <div id="menu">
                <table class="table">
                    <thead>
                        <tr class="invoicetable">
                            <th>
                                Table#
                            </th>
                            <th>
                                OT
                            </th>
                            <th>
                                Order#
                            </th>
                                
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="runningtable">
                        
                    </tbody>
                </table>
                </div>
            </div>
            <h6 class="T returnH6 HideInTab">Return Table</h6>
            <div class="menuitems HideInTab">
                <div id="view">
                    
                </div>
                <div id="menu">
                <table class="table">
                    <thead>
                        <tr class="returnThead">
                            <th>
                                Table#
                            </th>

                            <th>
                                Order#
                            </th>
                                
                            <th>
                                Bill
                            </th>
                            <th>
                                Received
                            </th>
                            <th>
                                Return
                            </th>
                            <th>
                                Done
                            </th>
                        </tr>
                    </thead>
                    <tbody id="returntable">
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="neworder">
            <h6 class="T" id="neworderh6">New Order</h6>
            <!-- <div>
                
            </div> -->
            <div class="additem">
                <input list="OrderProduct" placeholder="Select Item" id="OrderProducts">
                <datalist class="OrderProduct" id="OrderProduct">
                <?php 
                 $result = mysqli_query($con,"SELECT * FROM Product WHERE Modal != 'ASSET' ");
                 $data =array();
                 while($row = mysqli_fetch_assoc($result))
                 {
                ?>
                <option id="<?php echo $row['sr'];?>" name="<?php echo $row['Price'];?>" title='<?php echo $row['Stock'];?>' value='<?php echo $row['ProductName'];?>'><?php echo $row['Price'];?></option>
                <?php
                    }
                ?>
                </datalist>
                
                <input type="button" name="AddButton" id="AddButton" value="Add" class="btn btn-primary" >
                <input list="tableno" placeholder="Table" id="tablenos" class="tablenos">
                <datalist id="tableno">
                    <!-- <option id='"+sr+"' value='"+tableno+"'>"+tableno+"</option> -->
                        </datalist>
            </div>
            <table class="table" name="mytable" id="mytable" align="center">
                <thead class="mytablethead">
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">SubTotal</th>
                    <th scope="col" class="d-print-none">Delete</th>
                </tr>
                </thead>

                <tbody id="OrderTable">       </tbody>
            
            </table>

            <div class="getGstTable">            
                    <div id="Total" class="totalMarginBottom">
                        <b class="col-sm2" style=" font-size: 18px;"> Total Amount:</b>
                        <b class="col-sm2" id="TotalAmount" >0</b>
                    </div>
                    <div id="Total" class="totalMarginBottom">
                        <b class="col-sm2"> GST :</b>
                        <input type="radio"  name="gst" value="16" onclick="TotalAmountCalculator()" checked="true"><b> 16%</b>
                        <input type="radio" name="gst" value="0" onclick="TotalAmountCalculator()"><b>0%</b> 
                        <!-- <b class="col-sm2"> GST :</b>
                        <b class="col-sm2" id="gst">16%</b> -->
                    </div>
                    <div id="Claim" class="totalMarginBottom">
                        <b class="col-sm2"> OFF :</b>
                        <input type="radio" name="off" value="1" onclick="TotalAmountCalculator()" checked="true"><b> %</b>
                        <input type="radio" name="off" value="0" onclick="TotalAmountCalculator()"><b>RS.</b> 
                        <input class="col-sm2" type="number" placeholder="DISCOUNT"  min="0" oninput="TotalAmountCalculator()" id="discount">
                    </div>
                    <div id="Bal" class="totalMarginBottom">
                        <b class="col-sm2"> Grand Total:</b>
                        <b class="col-sm2" id="GrandTotal"></b>
                    </div>
                     <div id="Paid" class="totalMarginBottom">
                        <input class="col-sm2" type="number" min="0" placeholder="Received Amount" id="Received" oninput="ReceivedFunction()">
                    </div>
                    <div id="Bal" class="totalMarginBottom">
                        <b class="col-sm2" id="Balance"> Balance:</b>
                        <b class="col-sm2"></b>
                    </div>
                <button type="submit" id="SaveButton" class="btn-primary btn mb-3"> Save </button>
        </div>
        </div>
        
</div>
</body>
</html>

<script type="text/javascript">
     runingtable();
    var TotalItems = 0;
setInterval(function()
{
     runingtable();
     
    },10000)

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
        AddGST();
       
    }
    function AddGST()
    {
        var ta = document.getElementById("GrandTotal").innerHTML;
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
        var Total = $("#TotalAmount").text();
        var discount = document.getElementById("discount").value;
        var rec = document.getElementById("Received").value;

         var offValue = $("input[name='off']:checked").val();
        if (offValue == 1) {
            
            var Bal = (parseInt(Total)/100)*discount;
            var Balance = parseInt(Total)-Bal-rec;
        }
        else{
            var Balance = parseInt(Total) - discount -rec;    
        }
        document.getElementById("GrandTotal").innerHTML = Balance;
        document.getElementById("Balance").innerHTML = Balance;
    }

  function returntable()
  {
      //Getting data to display
    var d = '';
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "getreturntable.php";
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
            var Row = "";

            for (var i = 0; i<data.length ; i++)
            {
                var sr = data[i].sr;
                var tableno = data[i].tableno;
                var orderno = data[i].orderno;
                var bill = data[i].bill;
                
                
                Row +="<tr id="+sr+">";
                    Row +="<td><button style='background-color:#1b775e;color:white;'>"+tableno+"</button></td>";
                    Row +="<td>"+orderno+"</td>";
                    Row +="<td>"+bill+"</td>";
                    Row +="<td><input class='Done' style='width: -webkit-fill-available; padding:0px;' id='billamount'></input></td>";
                    Row +="<td></td>";
                    Row +="<td><button class=' btn btn-info' onclick='done("+sr+")'>DONE</button></td>";
                    
                Row +="</tr>";
            }
            document.getElementById("returntable").innerHTML = Row;
        }
    }

  }
    $(document).on('input','.Done',function(e){
        var id = $(this).attr('id');
        var $ele = $(this).parent().parent();
        var received = $(this).val();
        var billamount  = $(this).parent().siblings(":eq(2)").text();
        var ST = parseInt(received)-parseInt(billamount);
        $(this).parent().siblings(":eq(3)").text(ST);
        });
    function done(sr)
    {
        $.ajax({
            url : 'Updatereturntable.php',
            method : 'post',
            data : {sr:sr},
            success : function(response){
                location.reload();
            }
        });
        
    }

     function gettab()
     {
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
            var table = $(".tabs");
            table.append(d);
            document.getElementById("tableno").innerHTML = d;
            /*disable();*/
        }
    } 
     } 

  function runingtable()
  {
      //Getting data to display
    var d = '';
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "ap-getrunningtable.php";
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
            var Row = "";

            for (var i = 0; i<data.length ; i++)
            {
                var sr = data[i].sr;
                var status = data[i].status;
                var tableno = data[i].tableno;
                var invoiceno = data[i].invoiceno;
            
                
                Row +="<tr id="+sr+">";
                Row +="<td><Select name='"+invoiceno+"' title='"+status+"' class='tabs'><option style='color:white;max-width:15%'>"+tableno+"</option><Select></td>";
                Row +="<td>"+status+"</td>";
                Row +="<td>"+invoiceno+"</td>";
                Row +="<td><a href='#' onclick='view("+invoiceno+")' class='btn-warning ' style='font-size:22px;' >View</a>/<a style='font-size:22px;' href='#' class=' update btn-dark' name='"+tableno+"'  id='"+invoiceno+"'>Edit</a><span class=' printhide'>/</span><a style='font-size:22px;' class='btn-info printhide' href='#' onclick='callurl(\""+sr+"\",\""+tableno+"\",\""+invoiceno+"\")'>Print</a></td>";
              
                Row +="</tr>";
            }
            document.getElementById("runningtable").innerHTML = Row;
            gettab();
            /*disable();*/
        }
    }
    returntable();
  }

        $("#AddButton").click(function Order()//Function to Select Product And Quantity
        {
            var table = $("#OrderTable");
            var Product = $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('Value');
            var Price =  $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('name');
            $("#OrderProducts").val("");   
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
    
    //Delete Function
    $(document).on('click','.Delete',function Delete(){
        var del_id= $(this).attr('id');
        var $ele = $(this).parent().parent();
        $ele.fadeOut().remove();
        TotalAmountCalculator();
    });
    /*Saving Inoice To DB*/
   
        $("#SaveButton").click(function Order()//Function to Select Product And Quantity
            {
                var table_data = [];
                var invoice_data = [];
                var DDY = new Date();
                var dd = DDY.getDate();
                var mm = DDY.getMonth()+1; //January is 0!
                var yyyy = DDY.getFullYear();
                
                var d = yyyy + '-' + mm + '-' + dd;
                
                var Discount   = $("#discount").val();
                var offValue = $("input[name='off']:checked").val();
                if (offValue == 1) {
                    
                    var Discount = (parseInt(TotalAmount)/100)*Discount;
                }
                
                var Row = 1;
            var tableno = $("#tableno option[value='" + $('#tablenos').val()+ "']").attr('Value');
            if (tableno !== undefined) 
            {
             
                $("#SaveButton").attr("disabled", true);
                var inv = {
                    'd' : yyyy + '-' + mm + '-' + dd,
                    'TotalAmount' : $("#TotalAmount").text(),
                    'Discount'   : Discount,
                    'GrandTotal' : $("#GrandTotal").text(),
                    'PaidAmount' : $("#Received").val(),
                    'Balance' : $("#Balance").text(),
                    'tableno' : $("#tableno option[value='" + $('#tablenos').val()+ "']").attr('Value'),
                    'user' : "<?php echo $username?>",
                };
                invoice_data.push(inv);
                
                  $('#OrderTable tr').each(function(row,tr){

                    if($(tr).find('td:eq(0)').text() == "")
                    {

                    }
                    else
                    {
                        var details = 
                        {
                         'tableno' : $("#tableno option[value='" + $('#tablenos').val()+ "']").attr('Value'),
                         'pn' : $(tr).find('td:eq(0)').text(),
                         'q' : ($(tr).find('td:eq(3)').text()/($(tr).find('td:eq(2)').text())),
                         'ur' : $(tr).find('td:eq(2)').text(),
                         'ta' : $(tr).find('td:eq(3)').text(),
                         'DDY' : DDY,
                         'd' : yyyy + '-' + mm + '-' + dd,
                        };
                        table_data.push(details);
                        Row++;
                    }
                });
                 
                $.ajax({
                    url: 'InvoiceSave.php', //url from where we get data accesing DataBase
                    data: {'invoice_data':invoice_data,'table_data':table_data},//passing data to php page in which php will send data to Database
                    dataType: 'json',
                    type: 'POST',
                    cache:false,
                    success:function(data){
                            alert("Invoice Successfully Saved");
                            location.reload();
                        }
                
                    });
           }
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
     function view(sr)
    {
        var sr = sr;
       var url = document.getElementById("view").innerHTML="<button onclick='location.reload();' class='btn'>View Orders</button><object style='width:100%;height:400px' type='text/html' data=vieworder.php?id="+sr+"></object>";
        document.getElementById("menu").style.display = "none";
    }
    function callurl(sr,tableno,invoiceno)
    {
        $.ajax({
            url : 'Updatetable.php',
            method : 'post',
            data : {sr:sr,tableno:tableno,invoiceno:invoiceno},
            success : function(response){
                //console.log(response);
            var url = "InvoiceReport.php?id="+invoiceno;
            window.location.href = url;    
            }
        });
        
    }
     $(document).on('click','.update',function(e){
      var id = $(this).attr('id');
      var tab = $(this).attr('name');
      var url = "editinvoice.php?id="+id+"&tab="+tab;
                            window.location.href = url;
    });
    
    $(document).on('change','.tabs',function(e){
      var invoiceno = $(this).attr('name');
      var status = $(this).attr('title');
      var tab = $(this).val();
      $.ajax({
         url: 'changetable.php', //url from where we get data accesing DataBase
                    data: {tableno:tab,invoiceno:invoiceno,status:status},//passing data to php page in which php will send data to Database
                    dataType: 'json',
                    type: 'POST',
                    cache:false,
                    success:function(data){
                    }
        });
    });

    $(document).on('click','.addtable',function(e){
      var id = $(this).attr('id');
      var url = "addintoinvoice.php?id="+id;
                            window.location.href = url;
    });
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