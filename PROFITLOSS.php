<?php
include('Header.php');
?>
<div class="wrapper">
	<div class="container">
	<div class="Top"><!-- Top Class Contains Customer info and all things regarding company like Logo, phone no and address -->
		<div class="logo">
			<figure>
			<!--<img src="img/Logo.png">
			 <figcaption style="font-size: 12px; text-align: center;">Gov.Lic.No:LHR/8542</figcaption> -->
			</figure>
		</div>
		<div class="Nameon companydetail" style="width: 100%; margin: 10px 0px 0px 20px;text-align: center;">
            <h1 style="font-size:50px; font-family: Georgia, serif; text-decoration: underline; text-decoration-color: chocolate; text-align: center;color: white ">Bake <span class="main_color">&</span> Take Pizza <span class="main_color">&</span> Burger Hut</h1>	
		</div>

	</div>
<h4 class="T" style="width: auto;" ><span id="from"></span><span>&nbsp TO &nbsp</span><span id="to"></span></h4>
	<div class="ledgerdetail" style="width: 100%;">
		<table class='table table-bordered table-hover' id="table" style="min-width: 965px;border: 1px solid black" >
            <thead class='text-white' style="background-color: #007bff; text-align: center;">
            <tr>
                <th scope='col'>Tp</th>
                <th scope='col'>Date</th>
                <th scope='col'>Number</th>
                <th scope='col'>Category</th>     
                <th scope='col'>sale</th>
                <th scope='col'>purchase</th>
                <th scope='col'>expense</th>
                <!-- <th scope='col'>Delete</th> -->
            </tr>
            </thead>
            <tbody id="LedgerTable" style="text-align: center;background: white">
            </tbody>
        </table>	
	</div>
    <div style="width: 30%;float: right;text-align: right; font-size: 30px;color: white">
        <span ><b>PROFIT/LOSS : <span id="s-profitloss"></span></b></span><br><br>
        <button style="float: right;margin-top: 10px;" type="submit" class="btn btn-primary d-print-none royalbutton" onclick="PrintFunction()" id="Print">PRINT</button>    
    </div>
	
</div>
</body>

<script type="text/javascript">
	
    var from = getUrlVars()["from"];
	function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
	}
	var to = getUrlVars()["to"];
	function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
	}
    
    displayinvoice();
    /*this is to get data from invoice table*/
	function displayinvoice()
    {
    var Totalsale = 0;
    //Getting data to display
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "inovoice-for-profit-loss.php?from="+from+"&to="+to;
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
                var Dat = data[i].d;
                var type = "Inv";
                var Cat = "Customer";
                var num = data[i].sr;
                var Amount = data[i].Amount;
                var discount = data[i].discount;
                Amount = parseFloat(Amount)-parseFloat(discount);
                d += "<tr>";
                d +="<td data-target='type' >"+ type + "</td>";
                d +="<td data-target='Dat' >"+ Dat + "</td>";
                d +="<td data-target='num' >"+ num + "</td>";
                d +="<td data-target='Cat' >"+ Cat + "</td>";
                
                
                d +="<td data-target='Debit' id='Debit' >"+ Amount + "</td>";
                d +="<td data-target='Credit' id='Credit' >"+0+"</td>";
                d +="<td data-target='Credit' id='Credit' >"+0+"</td>";
                d +="</tr>";
            }
            document.getElementById("LedgerTable").innerHTML = d;
            document.getElementById("from").innerHTML = from;
            document.getElementById("to").innerHTML = to;
            displaypurchaseinvoice();
        }

    }
    
    }
    /*above we got data from sale invoice and display it into ledger table*/
    /*this is to get data from purchase invoice*/
    function displaypurchaseinvoice()
    {
        var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "purchase-invoice-for-profit-loss.php?from="+from+"&to="+to;
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
            var Row = "";

            for (var i = 0; i<data.length ; i++)
            {
                var Dat = data[i].Date;
                var type = "Inv";
                var Cat = "Vendor";
                var num = data[i].sr;
                var BillAmount = data[i].BillAmount;
                /*Totalsale = parseInt(sale)+Totalsale;
                Totalpurchase = parseInt(purchase)+Totalpurchase;
                */
                Row += "<tr>";
                Row +="<td data-target='type' >"+ type + "</td>";
                Row +="<td data-target='Dat' >"+ Dat + "</td>";
                Row +="<td data-target='num' >"+ num + "</td>";
                Row +="<td data-target='Cat' >"+ Cat + "</td>";
                
                
                Row +="<td data-target='Credit' id='sale' >"+0+"</td>";
                Row +="<td data-target='Debit' id='BillAmount' >"+ BillAmount + "</td>";
                Row +="<td data-target='Credit' id='Credit'>"+0+"</td>";
                //d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";
                Row +="</tr>";
            }
            var table = $("#LedgerTable");
            table.append(Row);
            displayexpense();
        }
    }
    
    }

/*this is to get data from expense*/
function displayexpense()
{
    var ajax = new XMLHttpRequest();
    var method = "Get";
    var url = "expense-for-profit-loss.php?from="+from+"&to="+to;
    var asyn = true;
    var Rowe = '';
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
                var Dat = data[i].Dat;
                var type = "Exp";
                var Cat = "Expense";
                var num = data[i].sr;
                var Price = data[i].Price;
                /*Totalsale = parseInt(sale)+Totalsale;
                Totalpurchase = parseInt(purchase)+Totalpurchase;
                */
                Rowe += "<tr>";
                Rowe +="<td data-target='type' >"+ type + "</td>";
                Rowe +="<td data-target='Dat' >"+ Dat + "</td>";
                Rowe +="<td data-target='num' >"+ num + "</td>";
                Rowe +="<td data-target='Cat' >"+ Cat + "</td>";
                
                
                
                Rowe +="<td data-target='Credit' id='sale' >"+0+"</td>";
                Rowe +="<td data-target='Credit' id='Credit'> "+0+"</td>";
                Rowe +="<td data-target='Debit' id='expense-pl' >"+ Price + "</td>";

                //d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";
                Rowe +="</tr>";
            }
            var table = $("#LedgerTable");
            table.append(Rowe);
            TotalAmountCalculator();
        }
    }
}
    

    //funtions start
    function PrintFunction() {
	    window.print();
	}
      function TotalAmountCalculator()
    {
        var ts = 0;
        var tp=0;
        var te=0;
        var TotalRows = document.getElementById("LedgerTable").rows.length;
        var R = "";
        var TotalSale=0;
        var TotalPurchase=0;
        var TotalExpense=0;
        for( i = 0; i<TotalRows; i++)
        {
            TotalSale = document.getElementById("LedgerTable").rows[i].cells.item(4).innerHTML;
            TotalPurchase= document.getElementById("LedgerTable").rows[i].cells.item(5).innerHTML;
            TotalExpense=document.getElementById("LedgerTable").rows[i].cells.item(6).innerHTML;
            ts = parseInt(TotalSale)+ts;
            tp = parseInt(TotalPurchase)+tp;
            te = parseInt(TotalExpense)+te;
        }
        R += "<tr>";
                R +="<td data-target='type' ></td>";
                R +="<td data-target='Dat' ></td>";
                R +="<td data-target='num' ></td>";
                R +="<td data-target='Cat' ></td>";
                
                
                R +="<td data-target='Credit' id='sale' > <b>"+ts+" </b></td>";
                R +="<td data-target='Debit' id='BillAmount'> <b>"+tp+" </b></td>";
                R +="<td data-target='Credit' id='Credit'> <b>"+te+" </b></td>";
                //d +="<td> <input type='button' id='"+CustomerName+"' Value='Delete' class='Delete'> </td>";
                R +="</tr>";
            var PL = ts-tp-te;
            document.getElementById("s-profitloss").innerHTML = PL;
            var table = $("#LedgerTable");
            table.append(R);
            sortByDate();
    }
    function convertDate(d) {
    var p = d.split("-");
    return +(p[2]+p[1]+p[0]);
    }

    function sortByDate() {
      var tbody = document.querySelector("#table tbody");
      // get trs as array for ease of use
      var rows = [].slice.call(tbody.querySelectorAll("tr"));
      
      rows.sort(function(a,b) {
        return convertDate(a.cells[1].innerHTML) - convertDate(b.cells[1].innerHTML);
      });
      
      rows.forEach(function(v) {
        tbody.appendChild(v); // note that .appendChild() *moves* elements
      });
    }



</script>
