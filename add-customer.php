<?php
include('Header.php');
?>

<!-- Modal Start -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title T">Edit</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="EditeProductName" class="col-sm-4 mr-2"  id="EditeCustomerName" placeholder="ProductName" style='text-transform:uppercase'>
                <br>
                <input type="Number" name="EditeBikeName" class="col-sm-4 mr-2"  id="EditeCustomerPhone" placeholder="BikeName">
                <br>
                <input type="text" name="EditePrice" style='text-transform:uppercase' class="col-sm-4 mr-2"  id="EditeCustomerAddress" placeholder="Price">
                <br>
                <input type="number" name="EditeQuantity" class="col-sm-4 mr-2"  id="ReceivedAmount" placeholder="ReceivedAmount">
                <br>
                <input type="number" name="EditePrice"    class="col-sm-4 mr-2"  id="EditeBalance" placeholder="Price">
                <br>
                <input type="number" name="EditeQuantity" class="col-sm-4 mr-2"  id="EditeTotalAmount" placeholder="Quantity">
                <input type="hidden" name="sr" class="col-sm-2 mr-2"  id="CustomerSr">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-right" value="Save" id="SaveUpdated"> Save</button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal End -->

<div class="wrapper">
    <div class="container mt-5">
        <h4 class="T main_bg_color"> CUSTOMER</h4>
        <div class="form-group">
            <input type="text" class="col-sm-2 mr-2" name="CustomerName" onkeyup="SearchByName()"placeholder="Customer Name" id="CustomerName" style='text-transform:uppercase'>
            <input type="number" class="col-sm-2 mr-2" name="PhoneNumber"  placeholder="Phone Number" id="PhoneNumber">
            <input type="text" class="col-sm-2 mr-2" name="Address" onkeyup="SearchByAddress()" placeholder="Address" id="Address" style='text-transform:uppercase'>
            <input type="number" class="col-sm-2 mr-2" name="Address" placeholder="Total Amount" id="TotalAmount">
            <input type="number" class="col-sm-2 mr-2" name="Address" placeholder="Balance" id="Balance">

            <button type="submit" name="AddCustomer" class="btn btn-primary" id="btnAddCustomer">Add</button>
        </div>

        <table class='wid table table-bordered table-hover' style="">
            <thead class='text-white' style="background-color: chocolate">
            <tr>
                <th scope='col'>User Name</th>
                <th scope='col'>Phone</th>
                <th scope='col'>Address</th>
                <th scope='col'>Total Payment</th>
                <th scope='col'>Paid Amaount</th>
                <th scope='col'>Balance</th>
<!--                 <th scope='col'>Update</th> -->
                <!-- <th scope='col'>Delete</th> -->
            </tr>
            </thead>
            <tbody id="CustomerTable" style="background-color: white">
            </tbody>
        </table>
    </div>
</div>
</body>


<script type="text/javascript">
    //Send Data To DB
    $(document).ready(function()
    {
        $("#btnAddCustomer").click(function AddCustomer()
        {
            //Getting Value From Input Fields
            var CustomerName = $("#CustomerName").val();
            var PhoneNumber = $("#PhoneNumber").val();
            var Address = $("#Address").val();
            var TotalAmount = $("#TotalAmount").val();
            var Balance = $("#Balance").val();
            //Ajax Call to PHP Send data that we get from input fields into variable and passing to php page
            $.ajax({
                url: 'Customer-SendData.php', //url from where we get data accesing DataBase
                data: {CustomerName:CustomerName, PhoneNumber:PhoneNumber, Address:Address, TotalAmount:TotalAmount, Balance:Balance},//passing data to php page in which php will send data to Database
                type: 'POST',
                success:function(data){
                    //displaing received msg into div ID as #result
                    alert(data);
                    location.reload();

                }
            });
        });
    });
    //Display Function For Customer
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "Customer-DisplayData.php";
    var asyn = true;
    //Ajax open XML Request
    ajax.open(method,url,asyn);
    ajax.send();
    //ajax call for display
    ajax.onreadystatechange = function CustomerDisplay()
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
                var Balance = data[i].Balance;

                d += "<tr data-id='"+CustomerSr+"'>";
                d +="<td data-target='CustomerName' class='CustomerName' ><a href='Ledger.php?name="+CustomerName+"'>"+ CustomerName + "</a></td>";
                d +="<td data-target='CustomerPhone' id='CustomerPhone' class='CustomerPhone' >"+ CustomerPhone + "</td>";
                d +="<td data-target='CustomerAddress' id='CustomerAddress' class='CustomerAddress' >"+ CustomerAddress + "</td>";
                d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ TotalAmount + "</td>";
                d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ PaidAmount + "</td>";
                d +="<td data-target='Balance' id='Balance' class='Balance' >"+ Balance + "</td>";
/*                d +="<td> <a href='#' data-role='update' data-id='"+CustomerSr+"'>Update</a> </td>";*//*Calling Model Through JS Function*/
                //d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";
                d +="</tr>";
            }
            document.getElementById("CustomerTable").innerHTML = d;
        }
    }
    //ModalCalling For Customer Update Through Update Button
    $(document).on('click','a[data-role=update]',function ModleCall(){
        var id = $(this).data('id');

        var CustomerName = $(this).parent().siblings("td:first").text();
        var CustomerPhone =  $(this).parent().siblings(":eq(1)").text();
        var CustomerAddress = $(this).parent().siblings(":eq(2)").text();
        var TotalAmount =  $(this).parent().siblings(":eq(3)").text();
        var Balance = $(this).parent().siblings(":eq(4)").text();
        var ReceivedAmount = 0;

        $("#EditeCustomerName").val(CustomerName);
        $('#EditeCustomerPhone').val(CustomerPhone);
        $('#EditeCustomerAddress').val(CustomerAddress);
        $('#ReceivedAmount').val(ReceivedAmount);
        $('#EditeBalance').val(Balance);
        $('#EditeTotalAmount').val(TotalAmount);

        $('#CustomerSr').val(id);
        $('#myModal').modal('toggle');
    });

    //Update Customer Using Ajax
    $('#SaveUpdated').click(function CustomerUpdate(){

        var sr = $("#CustomerSr").val();
        var CustomerName = $("#EditeCustomerName").val();
        var CustomerPhone = $("#EditeCustomerPhone").val();
        var CustomerAddress = $("#EditeCustomerAddress").val();
        var ReceivedAmount = $("#ReceivedAmount").val();
        var Balance = $("#EditeBalance").val();
        var TotalAmount = $("#EditeTotalAmount").val();

        $.ajax({
            url : 'UpdateCustomer.php',
            method : 'post',
            data : {sr:sr, CustomerName:CustomerName, CustomerPhone:CustomerPhone, CustomerAddress:CustomerAddress, ReceivedAmount:ReceivedAmount,Balance:Balance, TotalAmount:TotalAmount},
            success : function(response){
                //console.log(response);
                alert(response);
                location.reload();
            }
        });
    });
    //Delete Customer Using Ajax
    $(document).on('click','.Delete',function Delete(){

        var Conf = confirm("Do You Realy Want To Delete?");
        if(Conf == true)
        {
            var del_id= $(this).attr('id'); //id Getting From Delete Button For Specific Row
            var $ele = $(this).parent().parent();

            $.ajax({
                type:'POST',
                url:'Customer-Delete.php',
                data:{'del_id':del_id},
                success: function(data){
                    alert(data);
                    $ele.fadeOut().remove();
                }

            });
        }

    });
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
<script type="text/javascript">
    function SearchByName() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("CustomerName");
  filter = input.value.toUpperCase();
  table = document.getElementById("CustomerTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function SearchByAddress() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("Address");
  filter = input.value.toUpperCase();
  table = document.getElementById("CustomerTable");
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
</html>