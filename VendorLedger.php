<?php
include('Header.php');
?>
<div class="wrapper">
	<div class="container">
	<div class="Top"><!-- Top Class Contains Customer info and all things regarding company like Logo, phone no and address -->
		<!-- <div class="logo">
			<figure>
			<img src="img/lp.png">
			<figcaption style="font-size: 12px; text-align: center;">Gov.Lic.No:LHR/8542</figcaption>
			</figure>
		</div> -->
		<div class="Nameon companydetail" style="width: 100%; margin: 10px 0px 0px 20px;text-align: center;">
            <h1 style="font-size:50px; font-family: Georgia, serif; text-decoration: underline; text-decoration-color: chocolate; text-align: center;" >CHAI JUNCTION</h1>

			<i class="fa fa-phone" style="margin: 5px 15px 15px 0px;">0322-2777719</i>
			
			<br>
			<i class="fa fa-home" style="margin: 5px 0px 15px 0px;">Block c-3 Gulberg III,Hussain Chowk, LAHORE, PAKISTAN.</i>
		</div>

	</div>
<h4 class="T main_bg_color" style="width: auto;" ><span id="accountholder"></span></h4>
	<div class="ledgerdetail" style="width: 100%;">
		<table class='table table-bordered table-hover' style="min-width: 965px;border: 1px solid black" >
            <thead class="text-white text-align: center;">
            <tr class="main_bg_color">
                <th scope='col'>Tp</th>
                <th scope='col'>Date</th>
                <th scope='col'>Number</th>
                <th scope='col'>Debit</th>
                <th scope='col'>Credit</th>
                <th scope='col'>Balance</th>
                <!-- <th scope='col'>Delete</th> -->
            </tr>
            </thead>
            <tbody id="LedgerTable" style="text-align: center;background-color: white">
            </tbody>
        </table>
		
	</div>
	<button style="float: right;" type="submit" class="btn btn-primary d-print-none royalbutton" onclick="PrintFunction()" id="Print">PRINT</button>
</div>
</body>

<script type="text/javascript">
	var name = getUrlVars()["name"];
	function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
	}
    document.body.style.background = "white";
	var TotalCredit = 0;
	
	var TotalDebit = 0;
	var Row = 0;
    //Getting data to display
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "DisplayVendorLedger.php?name="+name;
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
                var CustomerName = data[i].vendorname;
                var Dat = data[i].dat;
                var type = data[i].typ;
                var num = data[i].num;
                var Debit = data[i].debit;
                var Credit = data[i].credit;
                var Balance = data[i].balance;
                TotalDebit = parseInt(Debit)+TotalDebit;
                TotalCredit = parseInt(Credit)+TotalCredit;
                d += "<tr>";
                d +="<td data-target='type' >"+ type + "</td>";
                d +="<td data-target='Dat' >"+ Dat + "</td>";
                d +="<td data-target='num' >"+ num + "</td>";
                
                d +="<td data-target='Debit' id='Debit' >"+ Debit + "</td>";
                d +="<td data-target='Credit' id='Credit' >"+ Credit + "</td>";
                d +="<td data-target='Credit' id='Credit' >"+ Balance + "</td>";
                //d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";
                d +="</tr>";
            }
            document.getElementById("LedgerTable").innerHTML = d;
            document.getElementById("accountholder").innerHTML = CustomerName;
            var table = $("#LedgerTable");
            Row += "<tr>";
                Row +="<td data-target='type' ></td>";
                Row +="<td data-target='Dat' ></td>";
                Row +="<td data-target='num' ></td>";
                Row +="<td data-target='Debit' id='Debit' ><b>"+ TotalDebit + "</b></td>";
                Row +="<td data-target='Credit' id='Credit' ><b>"+TotalCredit  + "</b></td>";
                Row +="<td data-target='Credit' id='Credit' ><b>"+Balance  + "</b></td>";
                //d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";
                Row +="</tr>";
                table.append(Row);

        }
    }
    function PrintFunction() {
	    window.print();
	}
</script>