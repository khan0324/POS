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
                <input type="text" name="EditVendorName" style='text-transform:uppercase' class="col-sm-4 mr-2"  id="EditVendorName" placeholder="ProductName">
                <br>
                <input type="text" name="EditVendorPhone" style='text-transform:uppercase' class="col-sm-4 mr-2"  id="EditVendorPhone" placeholder="BikeName">
                <br>
                <input type="text" name="EditeVendorAddress" style='text-transform:uppercase'   class="col-sm-4 mr-2"  id="EditVendorAddress" placeholder="Price">
                <br>
                <input type="text" name="EditAmont" class="col-sm-4 mr-2"  id="ReceivedAmount" placeholder="Quantity">
                <br>
                <input type="text" name="EditPrice"    class="col-sm-4 mr-2"  id="EditBalance" placeholder="Price">
                <br>
                <input type="text" name="EditQuantity" class="col-sm-4 mr-2"  id="EditTotalAmount" placeholder="Quantity">
                <input type="hidden" name="sr" class="col-sm-2 mr-2"  id="VendorSr">
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
        <h4 class="T main_bg_color"> Vendor</h4>
        <div class="form-group">
            <input type="text" class="col-sm-2 mr-2" name="VendorName" onkeyup="SearchByName()" style='text-transform:uppercase' placeholder="Vendor Name" id="VendorName">
            <input type="n" class="col-sm-2 mr-2" name="PhoneNumber" style='text-transform:uppercase' placeholder="Phone Number" id="PhoneNumber">
            <input type="text" class="col-sm-2 mr-2" name="Address" onkeyup="SearchByAddress()" style='text-transform:uppercase' placeholder="Address" id="Address">
            <input type="Number" class="col-sm-2 mr-2" name="TotalAmount" placeholder="Total Amount" id="TotalAmount">
            <input type="Number" class="col-sm-2 mr-2" name="Balance" placeholder="Balance" id="Balance">

            <button type="submit" name="AddVendor" class="btn btn-primary col-1 p-2" id="btnAddVendor">Add</button>
        </div>

        <table class='wid table table-bordered table-hover' style="">
            <thead class=' text-white' style="background-color: chocolate">
            <tr>
                <th scope='col'>Vendor Name</th>
                <th scope='col'>Phone</th>
                <th scope='col'>Address</th>
                <th scope='col'>Total Payment</th>
                <th scope='col'>Paid Amaount</th>
                <th scope='col'>Balance</th>
<!--                 <th scope='col'>Update</th> -->
                <!-- <th scope='col'>Delete</th> -->
            </tr>
            </thead>
            <tbody id="VendorTable" style="background-color: white">
            </tbody>
        </table>
    </div>
</div>

</body>


<script type="text/javascript">
    //Send Data To DB
    $(document).ready(function()
    {
        $("#btnAddVendor").click(function AddVendor()
        {
            //Getting Value From Input Fields
            var VendorName = $("#VendorName").val();
            var PhoneNumber = $("#PhoneNumber").val();
            var Address = $("#Address").val();
            var TotalAmount = $("#TotalAmount").val();
            var Balance = $("#Balance").val();
            //Ajax Call to PHP Send data that we get from input fields into variable and passing to php page
            $.ajax({
                url: 'Vendor-SendData.php', //url from where we get data accesing DataBase
                data: {VendorName:VendorName, PhoneNumber:PhoneNumber, Address:Address, TotalAmount:TotalAmount, Balance:Balance},//passing data to php page in which php will send data to Database
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
    var url = "Vendor-DisplayData.php";
    var asyn = true;
    //Ajax open XML Request
    ajax.open(method,url,asyn);
    ajax.send();
    //ajax call for display
    ajax.onreadystatechange = function VendorDisplay()
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
                var Balance = data[i].Balance;

                d += "<tr data-id='"+VendorSr+"'>";
                d +="<td data-target='VendorName' class='VendorName' ><a href='VendorLedger.php?name="+VendorName+"'>"+ VendorName + "</a></td>";
                d +="<td data-target='VendorPhone' id='VendorPhone' class='VendorPhone' >"+ VendorPhone + "</td>";
                d +="<td data-target='VendorAddress' id='VendorAddress' class='VendorAddress' >"+ VendorAddress + "</td>";
                d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ TotalAmount + "</td>";
                d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ PaidAmount + "</td>";
                d +="<td data-target='Balance' id='Balance' class='Balance' >"+ Balance + "</td>";
               /* d +="<td> <a href='#' data-role='update' data-id='"+VendorSr+"'>Update</a> </td>";*//*Calling Model Through JS Function*/
                //d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";
                d +="</tr>";
            }
            document.getElementById("VendorTable").innerHTML = d;
        }
    }
    //ModalCalling For Customer Update Through Update Button
    $(document).on('click','a[data-role=update]',function ModleCall(){
        var id = $(this).data('id');

        var VendorName = $(this).parent().siblings("td:first").text();
        var VendorPhone =  $(this).parent().siblings(":eq(1)").text();
        var VendorAddress = $(this).parent().siblings(":eq(2)").text();
        var TotalAmount =  $(this).parent().siblings(":eq(3)").text();
        var Balance = $(this).parent().siblings(":eq(4)").text();
        var ReceivedAmount = 0;

        $("#EditVendorName").val(VendorName);
        $('#EditVendorPhone').val(VendorPhone);
        $('#EditVendorAddress').val(VendorAddress);
        $('#ReceivedAmount').val(ReceivedAmount);
        $('#EditBalance').val(Balance);
        $('#EditTotalAmount').val(TotalAmount);

        $('#VendorSr').val(id);
        $('#myModal').modal('toggle');
    });

    //Update Customer Using Ajax
    $('#SaveUpdated').click(function VendorUpdate(){

        var sr = $("#VendorSr").val();
        var VendorName = $("#EditVendorName").val();
        var VendorPhone = $("#EditVendorPhone").val();
        var VendorAddress = $("#EditVendorAddress").val();
        var ReceivedAmount = $("#ReceivedAmount").val();
        var Balance = $("#EditBalance").val();
        var TotalAmount = $("#EditTotalAmount").val();

        $.ajax({
            url : 'UpdateVendor.php',
            method : 'post',
            data : {sr:sr, VendorName:VendorName, VendorPhone:VendorPhone, VendorAddress:VendorAddress, ReceivedAmount:ReceivedAmount,Balance:Balance, TotalAmount:TotalAmount},
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
                url:'Vendor-Delete.php',
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
  input = document.getElementById("VendorName");
  filter = input.value.toUpperCase();
  table = document.getElementById("VendorTable");
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
  table = document.getElementById("VendorTable");
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