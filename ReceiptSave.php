<?php
 include 'Connection.php';
		
	   /*Careof, CustomerName, ReceivedAmount, receivedtype, Bankname, date, bankdatepicker*/
		$CustomerName = $_POST["CustomerName"];
		$ReceivedAmount = $_POST["ReceivedAmount"];
		$receivedtype = $_POST["receivedtype"];
		$Bankname = $_POST["bankname"];
		$date = $_POST["date"];
		$bankdatepicker = $_POST["bankdatepicker"];
        $being = $_POST["being"];
        $type = "Rec";
        $Debit = 0;
        $des = 'None';
        $cus = 'Customer';

		$Insert = "INSERT INTO receipt (CustomerName,ReceivedAmount,rtype,Bankname,dat,cdate,being) Values ('$CustomerName',$ReceivedAmount, '$receivedtype','$Bankname','$date','$bankdatepicker','$being')";
		$RunQuery = mysqli_query($con,$Insert);
		if ($RunQuery) {

			//Update Customer on receiving
			$q = "SELECT PaidAmount,Balance FROM customer WHERE CustomerName = '$CustomerName'";
			$geting = mysqli_query($con,$q);
            while($result = mysqli_fetch_array($geting)) 
            {
                
                $P = $result['PaidAmount']."<br>";
                $B = $result['Balance'];
                
                }
                $P = intval($P)+intval($ReceivedAmount);
                $B = intval($B)-intval($ReceivedAmount);

                $query1 = "UPDATE customer SET PaidAmount=$P, Balance=$B WHERE CustomerName='$CustomerName'";
                $result=mysqli_query($con,$query1);

           

            //query for geting receiptno to call url against data
			$query = "SELECT sr From receipt ORDER BY sr DESC LIMIT 1";
            $getsr = mysqli_query($con,$query);
            while($result = mysqli_fetch_array($getsr)) 
            {
                
                $sr = $result['sr'];
                
                }
                //Saving Customer Ledger
            $Cusledger = "INSERT into customerledger(customername, dat, typ, num, description, debit, credit, balance)VALUES ('$CustomerName','$date','$type',$sr,'$des',$Debit,$ReceivedAmount,$B)";
            $runinsert = mysqli_query($con,$Cusledger);

                //Saving Company ledger
            $query1 = "SELECT balance From ledger ORDER BY sr  DESC LIMIT 1";
            
            $TQ = mysqli_query($con,$query1);
            while($r = mysqli_fetch_array($TQ)) 
            {
                
                $CompanyBalanace = $r['balance'];
                
                }
                $CB = intval($CompanyBalanace)-intval($ReceivedAmount);

            $ledger = "INSERT into ledger( date, type, number, category, debit, credit, balance ) values ('$date','$type',$sr,'$cus',$Debit,$ReceivedAmount,$CB)";
            $ri = mysqli_query($con,$ledger);

			echo $sr;
		}
?>