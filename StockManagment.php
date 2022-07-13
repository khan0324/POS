<?php
	 include 'Connection.php';
        
	       $Flag = $_POST["Flag"];

        if ($Flag == 4)//Deleting Tempraroy Data
        {       
             $sr = 1;
             $TotalAmount = 0;
             $Query = "DELETE From Tem";
             $result = mysqli_query($con,$Query);



             $insert = "UPDATE TA SET TotalAmount = '$TotalAmount' WHERE Sr='$sr' ";
             $runinsert = mysqli_query($con,$insert);

        }
        else if ($Flag == 3) 
        {
             
             $Sr = $_POST["del_id"];
             $Query = "DELETE From Tem where Sr = '$Sr'";
             $result = mysqli_query($con,$Query);
            
        }

        else if($Flag == 2)//Saving Data Temprarioly
        {  
            $Product = $_POST["Product"];/*Product,OrderQuantity,Price,Total*/
            $OrderQuantity = $_POST["OrderQuantity"];
            $Price = $_POST["Price"];
            $Total = $_POST["Total"];
            $TotalAmount = $_POST["TotalAmount"];
            $Profit = $_POST["Profit"];
            $TotalProfit = $_POST["TotalProfit"];
            $Modal = $_POST["Modal"];
            $Brand = $_POST["Brand"];
            $sr = 1;
             $insert = "INSERT into tem(Product,Quantity,Rate,Total,Profit,Modal,Brand) values ('$Product','$OrderQuantity','$Price','$Total','$Profit','$Modal','$Brand')";

             $runinsert = mysqli_query($con,$insert);

              $insert = "UPDATE TA SET TotalAmount = '$TotalAmount', TotalProfit = '$TotalProfit' WHERE Sr='$sr' ";
             $runinsert = mysqli_query($con,$insert);




        }
        else if($Flag == 1)//Adding Product on canceling from Invoice
        {  
            $ProductName = $_POST["ProductName"];
            $Quantity = $_POST["ReAddQuantity"];
            $TotalAmount = $_POST["TotalAmount"];
            $TotalProfit = $_POST["TotalProfit"];
            $sr = 1;

            $query = "SELECT Stock,Sold From Product WHERE ProductName = '$ProductName'";
            
            $TotalQuantity = mysqli_query($con,$query);
            while($result = mysqli_fetch_array($TotalQuantity)) 
            {
                
              $TotalStock = $result['Stock']."<br>";
              $TotalSold = $result['Sold'];
            }

            $db = intval($TotalStock)+$Quantity;
            $Sold = intval($TotalSold)-$Quantity;

            $query1 = "UPDATE Product SET Stock=$db, Sold=$Sold WHERE ProductName='$ProductName'";
            $result=mysqli_query($con,$query1);

            $insert = "UPDATE TA SET TotalAmount = '$TotalAmount', TotalProfit = '$TotalProfit' WHERE Sr='$sr' ";
            $runinsert = mysqli_query($con,$insert);
        }
        else if($Flag == 10)
        {
          /*Product, OrderQuantity,Price,Total*/
           $Product = $_POST["Product"];
            $OrderQuantity = $_POST["OrderQuantity"];
            $Price = $_POST["Price"];
            $Total = $_POST["Total"];
            $TotalAmount = $_POST["TotalAmount"];
            $sr = 1;

             $insert = "Insert into purchasetemp(Product,Quantity,Price,Total) values ('$Product','$OrderQuantity','$Price','$Total')";

             $runinsert = mysqli_query($con,$insert);

              $insert = "UPDATE PurchaseTA SET TotalAmount = '$TotalAmount' WHERE Sr='$sr' ";
             $runinsert = mysqli_query($con,$insert);
        }
        else if ($Flag == 11)
        {
            $ProductName = $_POST["Product"];
            $OrderQuantity = $_POST["OrderQuantity"];
            
            $query = "SELECT Quantity,Stock From Product WHERE ProductName = '$ProductName'";
            
            $TotalQuantity = mysqli_query($con,$query);
            while($result = mysqli_fetch_array($TotalQuantity)) 
            {
                
                $Stock = $result['Stock']."<br>";
                $Total = $result['Quantity'];
                }

            $TQ = intval($Total)+$OrderQuantity;
            $StockUpdate = intval($Stock)+$OrderQuantity;

            $query1 = "UPDATE Product SET Quantity=$TQ, Stock=$StockUpdate WHERE ProductName='$ProductName'";
            $result=mysqli_query($con,$query1);
        }
        else if($Flag == 12)//Adding Product on canceling from Invoice
        {  
            $ProductName = $_POST["ProductName"];
            $Quantity = $_POST["ReMinusQuantity"];
            $TotalAmount = $_POST["TotalAmount"];
            $sr = 1;

            $query = "SELECT Stock,Quantity From Product WHERE ProductName = '$ProductName'";
            
            $TotalQuantity = mysqli_query($con,$query);
            while($result = mysqli_fetch_array($TotalQuantity)) 
            {
                
              $TotalStock = $result['Stock']."<br>";
              $Total = $result['Quantity'];
            }

            $db = intval($TotalStock)-$Quantity;
            $Total = intval($Total)-$Quantity;

            $query1 = "UPDATE Product SET Stock=$db, Quantity=$Total WHERE ProductName='$ProductName'";
            $result=mysqli_query($con,$query1);

            $insert = "UPDATE purchaseta SET TotalAmount = '$TotalAmount' WHERE Sr='$sr' ";
            $runinsert = mysqli_query($con,$insert);
        }
        else if ($Flag == 13) 
        {
             
             $Sr = $_POST["del_id"];
             $Query = "DELETE From purchasetemp where Sr = '$Sr'";
             $result = mysqli_query($con,$Query);
            
        }
        else if ($Flag == 14) 
        {
             
             $sr = 1;
             $TotalAmount = 0;
             $Query = "DELETE From purchasetemp";
             $result = mysqli_query($con,$Query);



             $insert = "UPDATE PurchaseTA SET TotalAmount = '$TotalAmount' WHERE Sr='$sr' ";
             $runinsert = mysqli_query($con,$insert);
 
        }
        else
        {
        	//working for flag 0
            $ProductName = $_POST["Product"];
            $Quantity = $_POST["OrderQuantity"];

           $receipe = "SELECT * From receipe WHERE product= '$ProductName' ";

           $eachingredient = mysqli_query($con,$receipe);
           while($ing = mysqli_fetch_array($eachingredient))
           {
              $ingredient = $ing['ingredient'];
              $qty = $ing['qty'];

              $totQty = intval($qty)*intval($Quantity);
           
            $query = "SELECT Stock,Sold From Product WHERE ProductName = '$ingredient'";
            
            $TotalQuantity = mysqli_query($con,$query);
            while($result = mysqli_fetch_array($TotalQuantity)) 
            {
                $TotalQuantit = $result['Stock']."<br>";
                $Sold = $result['Sold'];
            }

            $db = intval($TotalQuantit)-$totQty;
            $SoldUpdate = intval($Sold)+$totQty;

            $query1 = "UPDATE Product SET Stock=$db, Sold=$SoldUpdate WHERE ProductName='$ingredient'";
            $result=mysqli_query($con,$query1);
           } 
        }
      
?>