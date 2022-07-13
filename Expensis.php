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
              <input type="text" name="EditProductName"  class="in"  id="EditProductName" placeholder="ProductName">
              <br>
              <label>Unit</label>
              <input type="text" name="EditBikeName"  class="in"  id="EditBikeName" placeholder="BikeName">
              <br>
              <label>Update Purchase Price</label>
              <input type="text" name="EditPurchasePrice" class="in"  id="EditPurchasePrice" placeholder="PurchasePrice">
              <br>
              <label>Update Sale Price</label>
              <input type="text" name="EditPrice"    class="in"  id="EditPrice" placeholder="Price">
              <br>
              <label>Add Quantity</label>
              <input type="text" name="EditQuantity" class="in"  id="EditQuantity" placeholder="Quantity">
              <br>
              <input type="hidden" name="sr" class="in"  id="ProductSr">
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
   <h4 class="T main_bg_color">EXPENSIS</h4>
      <div class="form-group" style="text-align: center;">
        <input type="text" name="Expense" class="in" placeholder="Expense" id="Expense">
        <input type="text" name="Expenses" class="in" placeholder="Description" id="Description" >
        <input type="number" name="Price" class="in" placeholder="Price" id="Price">
        <input class="in" type="date" id="Calender" value="<?php echo date('Y-m-d');?>" name="Calender" >
        <button type="button" name="AddProduct" class="btn btn-primary in" id="btnAdd">SAVE</button>
      </div>
      <div class="table">
      	<table class='wid table table-bordered table-hover' style="text-align: center;">
          <thead>
              <tr class="main_bg_color">
              <th scope='col'>Expense</th>
              <th scope='col'>Description</th>
              <th scope='col'>Price</th>
              <th scope="col">Date</th>
              <!-- <th scope='col'>Delete</th> -->
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
        var Expense = $("#Expense").val();
        var Description = $("#Description").val();
        var Price = $("#Price").val();
        var Dat = $("#Calender").val();
        //Ajax Call to PHP Send data that we get from input fields into variable and passing to php page
        $.ajax({
          url: 'Expense-SendData.php', //url from where we get data accesing DataBase
          data: {Expense:Expense, Description:Description,Price:Price,Dat:Dat},//passing data to php page in which php will send data to Database
          type: 'POST',
          success:function(data){
          //displaing received msg into div ID as #result
          alert(data);
          location.reload();

          } 
        });
      }); 
  //Get Data From DB and Display it into a table
      
      var ajax = new XMLHttpRequest();
      var method = "Get";
      var url = "Expense-GetData.php";
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
            var Expense = data[i].expense;
            var Description = data[i].Description;
            var Price = data[i].Price; 
            var Dat = data[i].Dat;
            //Creating table 
            d += "<tr data-id='"+sr+"'>";
              d +="<td data-target='ProductName' class='ProductName' >"+ Expense + "</td>";
              d +="<td data-target='BikeName' id='BikeName' class='BikeName' >"+ Description + "</td>";
              d +="<td data-target='PurchasePrice' id='PurchasePrice' class='PurchasePrice' >"+ Price + "</td>";
              d +="<td data-target='Price' id='Price' class='Price' >"+ Dat + "</td>";
              
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
      var BikeName =  $(this).parent().siblings(":eq(1)").text(); 
      var PurchasePrice = $(this).parent().siblings(":eq(2)").text();
      var Price = $(this).parent().siblings(":eq(3)").text();
      var Quantity =0;

      $("#EditProductName").val(ProductName);
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
      var BikeName = $("#EditBikeName").val();
      var PurchasePrice = $("#EditPurchasePrice").val();
      var Price = $("#EditPrice").val();
      var Quantity = $("#EditQuantity").val();
      
      $.ajax({
        url : 'UpdateProduct.php',
        method : 'post',
        data : {sr:sr, ProductName:ProductName, BikeName:BikeName,PurchasePrice:PurchasePrice, Price:Price, Quantity:Quantity},
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
