<?php
include('Header.php');
?>
<div class="wrapper">
    <div class="contain container mt-5">
	<h4 class="T main_bg_color">RECEIVE PAYMENT RECEIPT</h4>
	
	<div class="Customerinfo" style="text-align: center;">
        <input type="Date" placeholder="Select Date" class=" in" id="datepicker">
        <SELECT type="Text" name="Customer Name" class="CustomerName in" id="CustomerName" placeholder="Customer Name"></SELECT>
        <input type="number" placeholder="Received Amount" class=" in" id="ReceivedAmount">
        <input type="text" name="Cash/ChequeNo"class=" in" placeholder="Cash/Cheque No" id="receivedtype">
        <input type="text" name="bankname"class=" in" placeholder="Bank Name" id="i-bankname">
        <input type="Date" placeholder="Select Date" class=" in" id="bankdatepicker">
        <input type="text" name="being" class="in" id="being" placeholder="Being">
        <input type="submit" class="btn btn-primary in royalbutton" id="btnSave" value="SAVE" style="color: white">
	</div>
</div>
</div>
</body>
<script type="text/javascript">
	//Getting data to display
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "Customer-DisplayData.php";
    var asyn = true;
    //Ajax open XML Request
    ajax.open(method,url,asyn);
    ajax.send();
    var e = "";
    ajax.onreadystatechange = function display()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);
            console.log(data);

            for (var i = 0; i<data.length ; i++)
            {
                var CustomerName = data[i].CustomerName;
                e +="<option>"+CustomerName+"</option>";
            }
            document.getElementById("CustomerName").innerHTML = e;        
        }
    }
    

</script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#btnSave").click(function AddDetail()
        {
            var CustomerName = $("#CustomerName").val();
            var date = $("#datepicker").val();
            var ReceivedAmount = $("#ReceivedAmount").val();
            var receivedtype = $("#receivedtype").val();
            var bankname = $("#i-bankname").val();
            var bankdatepicker = $("#bankdatepicker").val();
            var being = $("#being").val();
            $.ajax({
                url:'ReceiptSave.php', //url from where we get data accesing DataBase
                    data: {CustomerName:CustomerName, ReceivedAmount:ReceivedAmount,receivedtype:receivedtype,date:date, bankdatepicker:bankdatepicker,being:being,bankname:bankname},//passing data to php page in which php will send data to Database
                    type: 'POST',
                    success:function(data){

                            callurl(data);
                            }
                            
                    });           
        });
    });
    function callurl(sr)
    {
        var url = "PrintReceipt.php?id="+sr;
        window.location.href = url;
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