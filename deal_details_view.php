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
        <h4 class="T main_bg_color" id="Rec" >Add Deals Products</h4>

        <div class="d-print-none form-group ">
            <input list="OrderProduct" id="OrderProducts">
            <datalist id="OrderProduct" style="padding: 5px"></datalist>

            <label class="lbl" >Quantity:</label> <input type="number" name="OrderQuantity" id="OrderQuantity" value="1" placeholder="Quantity" min="1" oninput="validity.valid||(value='');">
            <input type="button" name="AddButton" id="AddButton" value="Add" class="btn btn-primary">
        </div>

        <div class="table">
            <table class="wid table table-bordered table-hover"name="mytable" id="mytable">
                <thead class="text-white" style="background-color: chocolate;">
                <tr>
                    <th>Serial</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col" class="d-print-none" >Delete</th>
                </tr>
                </thead>
                <tbody id="OrderTable">

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>

 <script type="text/javascript">
 	var deal_id = getUrlVars()["deal_id"];
	function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
	}

    
    //document.getElementById("Rec").innerHTML = Product;
    //Geting data from temprory table on page load
    
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "deal_detail_get.php?deal_id="+deal_id;
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
                var id = data[i].id;
                var product_id = data[i].product_id;
                var product_quantity = data[i].product_quantity;
                var ProductName = data[i].ProductName;
                Row += "<tr id="+id+">";
                Row +="<td></td>";
                Row +="<td>"+ ProductName+ "</td>";
                Row +="<td>"+ product_quantity + "</td>";
                Row +="<td class='d-print-none'> <input type='button' id="+id+" Value='X' class='Delete btn btn-danger '> </td>";
                Row +="</tr>";

            }
            document.getElementById("OrderTable").innerHTML = Row;
        }
    }

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
                
                if (Modal != "ASSET")
                {
                d +="<option id='"+sr+"' name='"+Price+"' title='"+Stock+"' value='"+ProductName+"'>"+Price+"</option>";
            	}
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
            var product_id = $("#OrderProduct option[value='" + $('#OrderProducts').val()+ "']").attr('id');
            var selIndex = document.getElementById("OrderProduct").selectedIndex;
            var Quantity = $("#OrderQuantity").val();//Getting OrderQuantity
            //document.getElementById("OrderProduct").options[selIndex].hidden = true;


            TotalItems = TotalItems+1;
            Row += "<tr id='"+product_id+"' >";
            Row +="<td>"+ Quantity + "</td>";
            Row +="<td class='d-print-none'> <input type='button' Value='X' class='Delete btn btn-danger '> </td>";
            Row +="</tr>";

            table.append(Row);
           
            $.ajax({
            url: 'deal_detail_save.php', //url from where we get data accesing DataBase
            data: {product_id:product_id, Quantity:Quantity, deal_id:deal_id},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
	            {
	                location.reload();
	            }
        	});
            document.getElementById("OrderQuantity").value = 0;
            

        });
    });

    //Delete Function
    $(document).on('click','.Delete',function Delete(){
        var del_id= $(this).attr('id');
        var $ele = $(this).parent().parent();
        
        $ele.fadeOut().remove();
        
        $.ajax({
            url: 'deal_detail_delet.php', //url from where we get data accesing DataBase
            data: {del_id:del_id},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {
                location.reload();
            }
        });
    });
    /*Saving Inoice To DB*/
    
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