<?php
include 'Connection.php';  
  $Address =  $_POST["Address"]; /* Address, DDY, TotalAmount, PaidAmount,ClaimAmount,Balance */
  $DDY =  $_POST["DDY"];
  $Time =  $_POST["Time"];
  $TotalAmount = $_POST["TotalAmount"];
  $PaidAmount =  $_POST["PaidAmount"];  
  $InvoiceID = $_POST["InvoiceNo"];
  $ClaimAmount =  $_POST["ClaimAmount"];  
  $Balance = $_POST["Balance"];
  $type = 'INV';
  $des = 'none';
  $cus = 'VENDOR';
  $VendorName = $_POST["VendorName"];
 /* function Random()
    {
      $InvoiceID = rand(1,100000);
    }
  echo $InvoiceID;
  */

   /*VENDOR Amounts Bellow*/
  $query = "SELECT TotalAmount,Balance From vendor WHERE VendorName = '$VendorName'";
            
            $TotalQuantity = mysqli_query($con,$query);
            while($result = mysqli_fetch_array($TotalQuantity)) 
            {
                
                $TA = $result['TotalAmount']."<br>";
                $B = $result['Balance']."<br>";
                
                }
                $TA = intval($TA)+intval($TotalAmount);
                $B = intval($B)+intval($Balance);

  /*VENDOR Amounts Above*/
   /*Company Amount Bellow*/

  $query1 = "SELECT balance From ledger ORDER BY sr  DESC LIMIT 1";
            
            $TQ = mysqli_query($con,$query1);
            while($r = mysqli_fetch_array($TQ)) 
            {
                
                $CompanyBalanace = $r['balance'];
                
                }
                $CB = intval($CompanyBalanace)+intval($Balance);

  /*Company Amounts Above*/
 
  $SaveInvoice = "SELECT * from purchaseinvoice where InvoiceNo = '$InvoiceID'";
  
  $Run = mysqli_query($con,$SaveInvoice);
  $Check = mysqli_num_rows($Run);

  if($Check == 1)
  {
    echo "Not Added";
  }
  else{
    $insert = "Insert into purchaseinvoice(InvoiceNo,VendorAddress,BillAmount,Date,Paid,Balance,Claim,Time) values ('$InvoiceID','$Address','$TotalAmount','$DDY','$PaidAmount','$Balance','$ClaimAmount','$Time')";
    $runinsert = mysqli_query($con,$insert);
    if ($runinsert) {

       $getSr = "SELECT * From purchaseinvoice where InvoiceNo = $InvoiceID";
          $res = mysqli_query($con,$getSr);
          while($result = mysqli_fetch_array($res))
        {

            $sr = $result['sr'];
        }
          $Cusledger = "INSERT into vendorLedger(vendorname, dat, typ, num, description, debit, credit, balance)VALUES ('$VendorName','$DDY','$type',$sr,'$des',$TotalAmount,$PaidAmount,$B)";
          $runinsert = mysqli_query($con,$Cusledger);


          $ledger = "INSERT into ledger( date, type, number, category, debit, credit, balance ) values ('$DDY','$type',$sr,'$cus',$TotalAmount,$PaidAmount,$CB)";
          $ri = mysqli_query($con,$ledger);


      echo "t";
    }
     
  }
?>