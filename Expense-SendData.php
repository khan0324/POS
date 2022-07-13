<?php
  include 'Connection.php';

  
  $Expense =  $_POST["Expense"];/*Expense, Description,Price*/
  $Description = $_POST["Description"];
  $Price =  $_POST["Price"];
  $Dat = $_POST["Dat"];
  $type = "EXP";
  $PaidAmount = 0;

    $insert = "INSERT into Expense(Expense,Description,Price,Dat) values ('$Expense','$Description',$Price,'$Dat')";
    $runinsert = mysqli_query($con,$insert);
    
    if($runinsert){
      $query = "SELECT sr From expense ORDER BY sr  DESC LIMIT 1";
            
            $srs = mysqli_query($con,$query);
            while($sr = mysqli_fetch_array($srs)) 
            {
                
                $s = $sr['sr'];
                
                }
      echo "Add Succesfuly";
    }
?>