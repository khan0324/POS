<?php
include('Header.php');
?>
<div class="container">
    <div class="dates" style="margin:auto">
        <div class="from" style="width: 100%;margin: 20px 0px 0px 0px">
            <input class="" style="width: 20%;padding: 10px" type="date" id="from" value="<?php echo date('Y-m-d');?>" name="Calender" >
            <input style="width: 20%;padding: 10px" type="date" id="to" value="<?php echo date('Y-m-d');?>" name="Calender" >
            <input type="button" name="Submit" id="ok" style="width: 10%;padding: 10px"  class="btn btn-primary" value="GO">
        </div>
    </div>
</div>

<script type="text/javascript">

        $(document).ready(function()

        {
            $("#ok").click(function Order()//Function to Select Product And Quantity
            {
            var from = $("#from").val();
            var to = $("#to").val();

            var url = "LedgerBetween.php?from="+from+"&to="+to;
                            window.location.href = url;
            
            });
        });

</script>
</html>