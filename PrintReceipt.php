<?php
include('Header.php');
?>
<div class="wrapper">
	<div class="container">
	<div class="Top" style="text-align: center;width: 100%"><!-- Top Class Contains Customer info and all things regarding company like Logo, phone no and address -->
		<div class="Nameon companydetail" style="display: inline-block; margin: 10px 0px 0px 0px;"><h1 style="font-size:50px; font-family: Georgia, serif; text-decoration: underline; text-decoration-color: #007bff; text-align: center; ">ITFAQ AUTOS</h1>

			<i class="fa fa-phone" style="margin: 5px 15px 15px 0px;">042 36367015/0303 4319049</i>
			<br>
			<i class="fa fa-home" style="margin: 5px 0px 15px 0px;"> &nbsp &nbsp 17A MONTGOMERY ROAD, Lahore, PKISTAN.</i>
		</div>

	</div>
<h4 class="T" >PAYMENT RECEIPT</h4>

		<button style="float: right; margin: -50px 0px 0px 0px;" type="submit" name="SaveInvoice" class="btn btn-primary d-print-none" onclick="PrintFunction()" id="Print">PRINT</button>
	<div class="receiptdetail" style="width: 100%; height: 350px; border: 1px solid">
		<div class="topright" style=" width:100%; float: right; margin: 5px 10px 0px 0px">
			<div style=" float: right;">
				<label>ReceiptNo:</label><span id="recno"style="text-decoration: underline;"></span><br>
				<label>Date:</label><span id="Date"style="text-decoration: underline;"></span>
			</div>
		</div>
		<div class="midledetail" style=" float: left; width: 100%; display: inline-block; margin-left: 10px">
			<label>Received From:</label> <span id="CustomerName" style="text-decoration: underline;"></span><br><br>
			<label>Received Amount:</label> <span id="receivedamount"style="text-decoration: underline;"></span>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp<label>Amount:</label><span id="amount"style="text-decoration: underline;"></span><br><br>
			<label>Being:</label><span id="being"style="text-decoration: underline;"></span><br><br>
			<label>Cash/Cheaque No:</label><span id="cashtype"style="text-decoration: underline;"></span>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp<label>Bank:</label><span id="bankname"style="text-decoration: underline;"></span><br><br>
			<label>Cheaque Date:</label><span id="cdate"style="text-decoration: underline;"></span>
		</div>
		
		</div>
		<div class="Bottom" style="margin: 30px 0px 0px 10px">
			<div class="Receiver" style="float: left; ">
				<label>Received By:___________________________</label>
			</div>
			<div class="Receiver" style="float: right; ">
				<label>Prepeard By:___________________________</label>
			</div>
			
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
	var id = getUrlVars()["id"];
	function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
	}
	var ajax = new XMLHttpRequest();
	    var method = "Get";
	    var url = "Receiptinfo.php?id="+id;
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
	            

	            for (var i = 0; i<data.length ; i++)
	            {
	                var ReceiptNo = data[i].sr;
	                var CustomerName = data[i].CustomerName;
	                var ReceivedAmount = data[i].ReceivedAmount;
	                var rtype = data[i].rtype;
	                var bankname = data[i].Bankname;
	                var Dat = data[i].dat;
	                var cdate = data[i].cdate;
	                var am = numberToEnglish(ReceivedAmount,",");
	                var b = data[i].being;
	            }
	            document.getElementById("recno").innerHTML = ReceiptNo;
	            document.getElementById("CustomerName").innerHTML = CustomerName;
	            document.getElementById("receivedamount").innerHTML = ReceivedAmount;
	            document.getElementById("cashtype").innerHTML = rtype;
	            document.getElementById("bankname").innerHTML = bankname;
	            document.getElementById("Date").innerHTML = Dat;
	            document.getElementById("cdate").innerHTML = cdate;
	      		document.getElementById("amount").innerHTML = am;
	      		document.getElementById("being").innerHTML = b;
	      			
	        }
	    }
	    function PrintFunction() {
	    window.print();
	}
</script>
<script type="text/javascript">
	
	/**
 * Convert an integer to its words representation
 * 
 * @author McShaman (http://stackoverflow.com/users/788657/mcshaman)
 * @source http://stackoverflow.com/questions/14766951/convert-digits-into-words-with-javascript
 */
function numberToEnglish(n, custom_join_character) {

    var string = n.toString(),
        units, tens, scales, start, end, chunks, chunksLen, chunk, ints, i, word, words;

    var and = custom_join_character || 'and';

    /* Is number zero? */
    if (parseInt(string) === 0) {
        return 'zero';
    }

    /* Array of units as words */
    units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

    /* Array of tens as words */
    tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    /* Array of scales as words */
    scales = ['', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion', 'Septillion', 'Octillion', 'Nonillion', 'Decillion', 'Undecillion', 'Duodecillion', 'Tredecillion', 'Quatttuor-Decillion', 'Quindecillion', 'Sexdecillion', 'Septen-Decillion', 'Octodecillion', 'Novemdecillion', 'Vigintillion', 'Centillion'];

    /* Split user arguemnt into 3 digit chunks from right to left */
    start = string.length;
    chunks = [];
    while (start > 0) {
        end = start;
        chunks.push(string.slice((start = Math.max(0, start - 3)), end));
    }

    /* Check if function has enough scale words to be able to stringify the user argument */
    chunksLen = chunks.length;
    if (chunksLen > scales.length) {
        return '';
    }

    /* Stringify each integer in each chunk */
    words = [];
    for (i = 0; i < chunksLen; i++) {

        chunk = parseInt(chunks[i]);

        if (chunk) {

            /* Split chunk into array of individual integers */
            ints = chunks[i].split('').reverse().map(parseFloat);

            /* If tens integer is 1, i.e. 10, then add 10 to units integer */
            if (ints[1] === 1) {
                ints[0] += 10;
            }

            /* Add scale word if chunk is not zero and array item exists */
            if ((word = scales[i])) {
                words.push(word);
            }

            /* Add unit word if array item exists */
            if ((word = units[ints[0]])) {
                words.push(word);
            }

            /* Add tens word if array item exists */
            if ((word = tens[ints[1]])) {
                words.push(word);
            }

            /* Add 'and' string after units or tens integer if: */
            if (ints[0] || ints[1]) {

                /* Chunk has a hundreds integer or chunk is the first of multiple chunks */
                if (ints[2] || !i && chunksLen) {
                    words.push(and);
                }

            }

            /* Add hundreds word if array item exists */
            if ((word = units[ints[2]])) {
                words.push(word + ' hundred');
            }

        }

    }

    return words.reverse().join(' ');

}
</script>