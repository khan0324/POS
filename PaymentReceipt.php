<?php
include('Header.php');
?>
<div class="wrapper">
    <div class="contain container mt-5">
	<h4 class="T main_bg_color">PAYMENT RECEIPT</h4>
	
	<div class="Customerinfo" style="text-align: center;">
        <input type="Date" placeholder="Select Date" class=" in" id="i-datepicker">
        <SELECT type="Text" name="Customer Name" class="CustomerName in" id="s-VendorName" placeholder="Customer Name"></SELECT>
        <input type="number" placeholder="Paid Amount" class=" in" id="i-PaidAmount">
        <input type="text" name="Cash/ChequeNo"class=" in" placeholder="Cash/Cheque No" id="i-receivedtype">
        <input type="text" name="bankname"class=" in" placeholder="Bank Name" id="i-bankname">
        <input type="Date" placeholder="Select Date" class=" in" id="i-bankdatepicker">
        <input type="text" name="being" class="in" id="i-being" placeholder="Being">
        <input type="submit" class="btn btn-primary in royalbutton" id="b-btnSave" value="SAVE" style="color: white">
	</div>
</div>
</div>
</body>
<script type="text/javascript">
	//Getting data to display
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "Vendor-DisplayData.php";
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
                var VendorName = data[i].VendorName;
                e +="<option>"+VendorName+"</option>";
            }
            document.getElementById("s-VendorName").innerHTML = e;        
        }
    }
    

</script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#b-btnSave").click(function AddDetail()
        {
            var VendorName = $("#s-VendorName").val();
            var date = $("#i-datepicker").val();
            var PaidAmount = $("#i-PaidAmount").val();
            var receivedtype = $("#i-receivedtype").val();
            var bankname = $("#i-bankname").val();
            var bankdatepicker = $("#i-bankdatepicker").val();
            var being = $("#i-being").val();
/*            alert(VendorName);
            alert(date);
            alert(PaidAmount);
            alert(receivedtype);
            alert(bankname);
            alert(bankdatepicker);
            alert(being);*/
            $.ajax({
                url:'PaidReceiptSave.php', //url from where we get data accesing DataBase
                    data: {VendorName:VendorName, PaidAmount:PaidAmount,receivedtype:receivedtype,date:date, bankdatepicker:bankdatepicker,being:being,bankname:bankname},//passing data to php page in which php will send data to Database
                    type: 'POST',
                    success:function(data){

                            callurl(data);
                            }
                            
                    });           
        });
    });
    function callurl(sr)
    {
        var url = "PrintPaidReceipt.php?id="+sr;
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