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
              <input type="text" name="EditProductName"  id="EditProductName" placeholder="ProductName">
              <br>
              <label class="col-4"> Modal</label>
              <input type="text" name="EditModal" style=''  id="EditModal" placeholder="Modal">
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
   <h4 class="T main_bg_color">DEALS</h4>
      <div class="form-group fromwidth">
        <input type="text" name="ProductName" style='' onkeyup="SearchByName()"class="col-sm-2 mr-2" placeholder="Deal Name" id="ProductName" >
        <input type="number" min="1" name="SPrice" class="col-sm-1 mr-2" placeholder="SP" id="SalePrice">
        <button type="button" name="AddProduct" class="btn btn-primary col-sm-2 mr-2" id="btnAdd">Add</button>
      </div>
      <div class="table">
      	<table class='wid table table-bordered table-hover' style="text-align: center;">
          <thead class='text-white' style="background-color: chocolate">
              <tr>
              <th scope='col'>Name</th>
              <th scope='col'>SP</th>
              <th scope='col'>Status</th>

              </tr>
          </thead>
          <tbody id="ProductTable">
               <tbody id="Items" style="background-color: white">
          <?php
        $result = mysqli_query($con,"SELECT * FROM deal ");

        $data =array();
        while($row = mysqli_fetch_assoc($result))
        {?>
     <tr id="">
        <td> <a href="deal_details_view.php?deal_id=<?php echo $row['id'];?>"> <?php echo $row['name'];?></a></td>
        <td><?php echo $row['price'];?></td>   
        <td><?php  ($row['status'] == 1)? print_r("Active"):print_r("Expired") ;?></td>  
      </tr>
        <?php
        }
        ?>
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
        var ProductName = $("#ProductName").val();
        var Price = $("#SalePrice").val();
        var Status = 1;
        //Ajax Call to PHP Send data that we get from input fields into variable and passing to php page
        $.ajax({
          url: 'deal_save.php', //url from where we get data accesing DataBase
          data: {ProductName:ProductName, Price:Price,Status:Status},//passing data to php page in which php will send data to Database
          type: 'POST',
          success:function(data){
          //displaing received msg into div ID as #result
          alert(data);
          location.reload();

          } 
        });
      }); 
  //Get Data From DB and Display it into a table
      
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
