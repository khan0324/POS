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
            <label class="col-4"> Prodcut Name</label>
              <input type="text" name="EditProductName" style='text-transform:uppercase' id="EditProductName" placeholder="ProductName">
              <br>
              <label class="col-4"> Modal</label>
              <input type="text" name="EditModal" style='text-transform:uppercase'  id="EditModal" placeholder="Modal">
              <br>
               <label  class="col-4">Sale Price</label>
              <input type="number" name="EditPrice" min="1" id="EditPrice" placeholder="Price">
              <br>
              <label  class="col-4">Add Quantity</label>
              <input type="number" name="EditQuantity" id="EditQuantity" placeholder="Add Quantity">
              <br>
              <input type="hidden" name="sr" class="col-sm-2"  id="ProductSr">
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
   <h4 class="T main_bg_color">PRODUCT</h4>
      <div class="form-group fromwidth">
        <input type="text" name="ProductName" style='text-transform:uppercase' onkeyup="SearchByName()"class="col-sm-2 mr-2" placeholder="Product Name" id="ProductName" >
        <input type="text" name="Modal" style='text-transform:uppercase' onkeyup="SearchByModal()" class="col-sm-2 mr-2" placeholder="Category" id="Modal">
        <input type="number" min="1" name="SPrice" class="col-sm-1 mr-2" placeholder="SP" id="SalePrice">
        <input type="number" min="1" name="Quantity" class="col-sm-2 mr-2" placeholder="Quantity" id="Quantity">
        <button type="button" name="AddProduct" class="btn btn-primary col-sm-2 mr-2" id="btnAdd">Add</button>
      </div>
      <div class="table">
      	<table class='wid table table-bordered table-hover' style="text-align: center;">
          <thead class='text-white' style="background-color: chocolate">
              <tr>
              <th scope='col'>Product Name</th>
              <th scope='col'>Category</th>
              <th scope='col'>SP</th>
              <th scope='col'>Total Quantity</th>
              <th scope='col'>Sold Quantity</th>
              <th scope='col'>Stock</th>
              <th scope='col'>Edit</th>

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
      DisplayProduct();
      $("#btnAdd").click(function AddProduct()
      {
        //Getting Value From Input Fields
        var P = $("#ProductName").val();
        var ProductName = P.toUpperCase();
        var M = $("#Modal").val();
        var Modal = M.toUpperCase();
        var BikeName = "NA";
        var PurchasePrice = 0;
        var Price = $("#SalePrice").val();
        var Quantity = $("#Quantity").val();
        //Ajax Call to PHP Send data that we get from input fields into variable and passing to php page
        $.ajax({
          url: 'ap-SendData.php', //url from where we get data accesing DataBase
          data: {ProductName:ProductName, BikeName:BikeName, PurchasePrice:PurchasePrice,Price:Price, Quantity:Quantity,Modal:Modal},//passing data to php page in which php will send data to Database
          type: 'POST',
          success:function(data){
          //displaing received msg into div ID as #result
          alert(data);
         DisplayProduct();

          } 
        });
      }); 
  //Get Data From DB and Display it into a table
      
    function DisplayProduct() {
       var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "ap-GetData.php";
      var asyn = true;
      //Ajax open XML Request
      ajax.open(method,url,asyn);
      ajax.send();

      ajax.onreadystatechange = function ()
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
            var BikeName = data[i].BikeName;
            var Price = data[i].Price; 
            var Quantity = data[i].Quantity;
            var Sold = data[i].Sold;
            var Stock = data[i].Stock;
            var PurchasePrice = data[i].PurchasePrice;
            //Creating table 
            if(Modal !== "ASSET")
            {
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='ProductName' class='ProductName' > <a href='receipe.php?Product="+ProductName+"'>"+ ProductName + "</a></td>";
              d +="<td data-target='Modal' id='Modal' class='BikeName' >"+ Modal + "</td>";
              
              d +="<td data-target='Price' id='Price' class='Price' >"+ Price + "</td>";
              d +="<td data-target='Quantity' id=Quantity class='Quantity' >"+ Quantity + "</td>";
              d +="<td data-target='Sold' id='Sold' class='Sold' >"+ Sold + "</td>";
              d +="<td data-target='Stock' id=Stock class='Stock' >"+ Stock + "</td>";
              
              d +="<td> <a href='#' data-role='update' class='btn btn-info btn-lg' data-id='"+sr+"'><span class='glyphicon glyphicon-edit'></span>Edit</a> </td>";
              /*d +="<td> <input type='button' id='"+ProductName+"' Value='Delete' class='Delete'> </td>";*/
            d +="</tr>";
          }
          document.getElementById("ProductTable").innerHTML = d;
        }
      }
     }
  }
    $(document).on('click','a[data-role=update]',function ModleCall(){
      var id = $(this).data('id');
      //getting prices through row id to show specific data to modle
      var ProductName = $(this).parent().siblings("td:first").text();
      var Modal =  $(this).parent().siblings(":eq(1)").text(); 
      
      var BikeName =  $(this).parent().siblings(":eq(2)").text(); 
      var PurchasePrice = $(this).parent().siblings(":eq(3)").text();
      var Price = $(this).parent().siblings(":eq(4)").text();
      var Quantity =0;

      $("#EditProductName").val(ProductName);
      $('#EditModal').val(Modal); 
      $('#EditBikeName').val(BikeName);
      $('#EditPurchasePrice').val(PurchasePrice);
      $('#EditPrice').val(Price);
      $('#EditQuantity').val(Quantity);
      $('#ProductSr').val(id);
      $('#myModal').modal('toggle');
    });
    //Update Product
    $('#SaveUpdated').click(function Update(){

      var sr = $("#ProductSr").val();
      var ProductName = $("#EditProductName").val();
      var Modal = $("#EditModal").val();
      var BikeName = "NA";
      var PurchasePrice = 0;
      var Price = $("#EditPrice").val();
      var Quantity = $("#EditQuantity").val();
      
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
  input = document.getElementById("ProductName");
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
