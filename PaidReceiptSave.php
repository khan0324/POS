<?php
 include 'Connection.php';
		
	   /*Careof, CustomerName, ReceivedAmount, receivedtype, Bankname, date, bankdatepicker*/
		$VendorName = $_POST["VendorName"];
		$PaidAmount = $_POST["PaidAmount"];
		$receivedtype = $_POST["receivedtype"];
		$Bankname = $_POST["bankname"];
		$date = $_POST["date"];
		$bankdatepicker = $_POST["bankdatepicker"];
        $being = $_POST["being"];
        $type = "Rec";
        $credit = 0;
        $des = 'None';
        $cus = 'Vendor';

		$Insert = "INSERT INTO paidreceipt (vendorname,PaidAmount,rtype,Bankname,dat,cdate,being) Values ('$VendorName',$PaidAmount, '$receivedtype','$Bankname','$date','$bankdatepicker','$being')";
		$RunQuery = mysqli_query($con,$Insert);
		if ($RunQuery) {

			//Update Customer on receiving
			$q = "SELECT PaidAmount,Balance FROM vendor WHERE VendorName = '$VendorName'";
			$geting = mysqli_query($con,$q);
            while($result = mysqli_fetch_array($geting)) 
            {
                
                $P = $result['PaidAmount']."<br>";
                $B = $result['Balance'];
                
                }
                $P = intval($P)+intval($PaidAmount);
                $B = intval($B)-intval($PaidAmount);

                $query1 = "UPDATE vendor SET PaidAmount=$P, Balance=$B WHERE VendorName='$VendorName'";
                $result=mysqli_query($con,$query1);

           

            //query for geting receiptno to call url against data
			$query = "SELECT sr From paidreceipt ORDER BY sr DESC LIMIT 1";
            $getsr = mysqli_query($con,$query);
            while($result = mysqli_fetch_array($getsr)) 
            {
                
                $sr = $result['sr'];
                
                }
                //Saving Customer Ledger
            $Cusledger = "INSERT into vendorledger(vendorname, dat, typ, num, description, debit, credit, balance)VALUES ('$VendorName','$date','$type',$sr,'$des',$PaidAmount,$credit,$B)";
            $runinsert = mysqli_query($con,$Cusledger);

                //Saving Company ledger
            $query1 = "SELECT balance From ledger ORDER BY sr  DESC LIMIT 1";
            
            $TQ = mysqli_query($con,$query1);
            while($r = mysqli_fetch_array($TQ)) 
            {
                
                $CompanyBalanace = $r['balance'];
                
                }
                $CB = intval($CompanyBalanace)+intval($PaidAmount);

            $ledger = "INSERT into ledger( date, type, number, category, debit, credit, balance ) values ('$date','$type',$sr,'$cus',$PaidAmount,$credit,$CB)";
            $ri = mysqli_query($con,$ledger);

			echo $sr;
		}
?>