<?php
      include('Header.php');
?>
   
     <!-- Modal Start -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title T">Edit</h4>
          </div>
          <div class="modal-body">
            <label> Prodcut Name</label>
              <input type="text" name="EditProductName" style='text-transform:uppercase'  class="col-sm-4 mr-2"  id="EditProductName" placeholder="ProductName">
              <br>
              <label>Add Quantity</label>
              <input type="number" name="EditQuantity" class="col-sm-4 mr-2"  id="EditQuantity" placeholder="Add Quantity">
              <br>
              <input type="hidden" name="sr" class="col-sm-2 mr-2"  id="ProductSr">
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
   <h4 class="T main_bg_color">Tables</h4>
      <div class="form-group fromwidth">
        <input type="text" name="Table" style='text-transform:uppercase' onkeyup="SearchByName()"class="col-sm-2 mr-2" placeholder="Table" id="i-table" >
        <button type="button" name="AddProduct" class="btn btn-primary col-sm-2 mr-2" id="btnAdd">Add</button>
      </div>
      <div class="table">
      	<table class='wid table table-bordered table-hover' style="text-align: center;">
          <thead class='text-white' style="background-color: chocolate">
              <tr>
              <th scope='col'>Tables</th>
              </tr>
          </thead>
          <tbody id="ProductTable">
          </tbody>  
        </table>
      </div>
        <div id="result"></div>
    </div>
    </div>
  </body>
 
  <script type="text/javascript">
    //Send Data To DB
    $(document).ready(function()
    {
      $("#btnAdd").click(function AddProduct()
      {
        //Getting Value From Input Fields
        var table = $("#i-table").val();

        if (table != "") 
        {


        $.ajax({
          url: 'table-SendData.php', //url from where we get data accesing DataBase
          data: {table:table},//passing data to php page in which php will send data to Database
          type: 'POST',
          success:function(data){
          //displaing received msg into div ID as #result
          alert(data);
          location.reload();

          } 
        });
      }
      else
      {
        alert("Write Table No");
      }
      }); 
  //Get Data From DB and Display it into a table
      
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "table-GetData.php";
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
            var table = data[i].tableno;
            //Creating table
            
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='ProductName' class='ProductName' >"+ table + "</td>";
              /*d +="<td> <input type='button' id='"+ProductName+"' Value='Delete' class='Delete'> </td>";*/
            d +="</tr>";
          
          }
          document.getElementById("ProductTable").innerHTML = d;
        }
      }
  
    $(document).on('click','a[data-role=update]',function ModleCall(){
      var id = $(this).data('id');
      //getting prices through row id to show specific data to modle
      var ProductName = $(this).parent().siblings("td:first").text();
      var Modal =  $(this).parent().siblings(":eq(1)").text();  
      var Quantity =0;

      $("#EditProductName").val(ProductName);
      $('#EditQuantity').val(Quantity);
      $('#ProductSr').val(id);
      $('#myModal').modal('toggle');
    });
    //Update Product
    $('#SaveUpdated').click(function Update(){

      var sr = $("#ProductSr").val();
      var ProductName = $("#EditProductName").val();
      var Modal = "ASSET";
      var BikeName = "NA";
      var PurchasePrice = 0;
      var Quantity = $("#EditQuantity").val();
      var Price = 0;
      $.ajax({
        url : 'UpdateProduct.php',
        method : 'post',
        data : {sr:sr, ProductName:ProductName, BikeName:BikeName,PurchasePrice:PurchasePrice, Price:Price, Quantity:Quantity,Modal:Modal},
        success : function(response){
          //console.log(response);
          alert(response);
          location.reload();
        }
      });
    });

    $(document).on('click','.Delete',function Delete(){
        
        var Conf = confirm("Do You Realy Want To Delete?");
        if(Conf == true)
        {

        var del_id= $(this).attr('id');
        var $ele = $(this).parent().parent();
            $.ajax({
            type:'POST',
            url:'ap-DeleteData.php',
            data:{'del_id':del_id},
            success: function(data){
                    $ele.fadeOut().remove();
                 }

            });
          }
        });
  });
function SearchByName() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("i-table");
  filter = input.value.toUpperCase();
  table = document.getElementById("ProductTable");
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
function SearchByModal() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("Modal");
  filter = input.value.toUpperCase();
  table = document.getElementById("ProductTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function SearchByBrand() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("BikeName");
  filter = input.value.toUpperCase();
  table = document.getElementById("ProductTable");
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
