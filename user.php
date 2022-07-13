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
                <input type="text" name="EditeName" class="col"  id="EditeUserName" placeholder="UserName" style='text-transform:uppercase'>
                <br>
                <input type="Number" name="EditePhone" class="col"  id="EditePhone" placeholder="Phone">
                <br>
                <input type="text" name="EditeAddress" style='text-transform:uppercase' class="col"  id="EditeAddress" placeholder="Price">
                <br>
                <input type="text" name="EditeQuantity" class="col"  id="EditPassword" placeholder="NewPassword">
                <br>
                <input type="hidden" name="sr" class="col"  id="CustomerSr">
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
        <h4 class="T main_bg_color"> USER</h4>
        <div class="form-group">
            <input type="text" class="col-sm-2 mr-2" name="CustomerName" onkeyup="SearchByName()"placeholder="UserName" id="i-username" style='text-transform:uppercase'>
            <input type="number" class="col-sm-2 mr-2" name="PhoneNumber"  placeholder="Phone Number" id="i-phone">
            <input type="text" class="col-sm-2 mr-2" name="Address" onkeyup="SearchByAddress()" placeholder="Address" id="i-address" style='text-transform:uppercase'>
            <input type="text" class="col-sm-2 mr-2" name="Password" onkeyup="SearchByAddress()" placeholder="Password" id="i-password" style='text-transform:uppercase'>
            <select id="s-status" class="">
                <option>User</option>
                <option>Admin</option>
                <option>Kitchen</option>

            </select>
            <button type="submit" name="AddUser" class="btn btn-primary col-1 p-2 ml-1" id="b-adduser">Add</button>
        </div>

        <table class='wid table table-bordered table-hover' style="">
            <thead class='text-white' style="background-color: chocolate">
            <tr>
                <th scope='col'>User Name</th>
                <th scope='col'>Phone</th>
                <th scope='col'>Address</th>
                <th scope='col'>Password</th>
                <th scope="col">Status</th>
                <th scope='col'>Update</th>
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
        $("#b-adduser").click(function AddCustomer()
        {
            //Getting Value From Input Fields
            var UserName = $("#i-username").val();
            var PhoneNumber = $("#i-phone").val();
            var Address = $("#i-address").val();
            var Password = $("#i-password").val();
            var Status = $("#s-status").val();
            //Ajax Call to PHP Send data that we get from input fields into variable and passing to php page
            $.ajax({
                url: 'User-SendData.php', //url from where we get data accesing DataBase
                data: {UserName:UserName, PhoneNumber:PhoneNumber, Address:Address, Password:Password, Status:Status},//passing data to php page in which php will send data to Database
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
    var url = "User-DisplayData.php";
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
                var Sr = data[i].sr;
                var UserName = data[i].username;//CustomerSr,CustomerName,CustomerPhone,CustomerAddress,TotalAmount,PaidAmount
                var Password = data[i].password;
                var ContactNo = data[i].contactno;
                var Address = data[i].address;
                var Status = data[i].status;
               
                d += "<tr data-id='"+Sr+"'>";
                d +="<td data-target='CustomerName' class='CustomerName' >"+ UserName + "</a></td>";
                d +="<td data-target='CustomerPhone' id='CustomerPhone' class='CustomerPhone' >"+ ContactNo + "</td>";
                d +="<td data-target='CustomerAddress' id='CustomerAddress' class='CustomerAddress' >"+ Address + "</td>";
                d +="<td data-target='TotalAmount' id='' class='TotalAmount' >"+ Password + "</td>";
                d +="<td data-target='TotalAmount' id='TotalAmount' class='TotalAmount' >"+ Status + "</td>";
                d +="<td> <a href='#' data-role='update' data-id='"+Sr+"'>Update</a> </td>";/*Calling Model Through JS Function*/
                //d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";
                d +="</tr>";
            }
            document.getElementById("CustomerTable").innerHTML = d;
        }
    }
    //ModalCalling For Customer Update Through Update Button
    $(document).on('click','a[data-role=update]',function ModleCall(){
        var id = $(this).data('id');

        var UserName = $(this).parent().siblings("td:first").text();
        var Phone =  $(this).parent().siblings(":eq(1)").text();
        var Address = $(this).parent().siblings(":eq(2)").text();
        var Password =  $(this).parent().siblings(":eq(3)").text();
        
        $("#EditeUserName").val(UserName);
        $('#EditePhone').val(Phone);
        $('#EditeAddress').val(Address);
        $('#EditPassword').val(Password);
        
        $('#CustomerSr').val(id);
        $('#myModal').modal('toggle');
    });

    //Update Customer Using Ajax
    $('#SaveUpdated').click(function CustomerUpdate(){

        var sr = $("#CustomerSr").val();
        var Name = $("#EditeUserName").val();
        var Phone = $("#EditePhone").val();
        var Address = $("#EditeAddress").val();
        var Password = $("#EditPassword").val();
        $.ajax({
            url : 'UpdateUser.php',
            method : 'post',
            data : {sr:sr, Name:Name, Phone:Phone,Address:Address,Password:Password},
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
  input = document.getElementById("i-username");
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
  input = document.getElementById("i-address");
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