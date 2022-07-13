<?php
	 include 'Connection.php';

	    $sr = $_POST["sr"];
      $ProductName = $_POST["ProductName"];
      $Modal = $_POST["Modal"];
      $BikeName = $_POST["BikeName"];
      $Price = $_POST["Price"];
      $QuantityGet = $_POST["Quantity"];
      $PurchasePrice = $_POST["PurchasePrice"];

      $query = "SELECT * From Product WHERE sr=$sr";
            
            $TotalQuantity = mysqli_query($con,$query);
            while($result = mysqli_fetch_array($TotalQuantity)) 
            {
                $Quantity = $result['Quantity'];
                $Stock = $result['Stock'];
                }
            $Stock = intval($Stock)+intval($QuantityGet);
            $Quantity = intval($Quantity)+intval($QuantityGet);
         
      $query = "UPDATE Product SET ProductName='$ProductName' ,BikeName='$BikeName',Price=$Price,Quantity=$Quantity, Stock=$Stock,PurchasePrice=$PurchasePrice,Modal='$Modal' WHERE sr=$sr";
      $result=mysqli_query($con,$query);
      if($result)
      {
            echo "Updated Succesfully";	
      }
      else
      {
            echo "Not Updated";
      }
      
?>