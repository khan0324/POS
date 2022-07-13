<?php
include('Headerforjitchen.php');

$time = '';
$startTimer='';
$diff='';
?>
<div class="wrapper" >
        <h4 class="T main_bg_color">Kitchen</h4>

        <div class="menu">
            <h6 class="T returnH6 main_bg_color">Pending Order</h6>
            <div class="menuitems">
                <div id="view">   </div>
                <div id="menu">
                <table class="table">
                    <thead>
                        <tr class="invoicetable main_bg_color">
                            <th>
                                Table#
                            </th>

                            <th>
                                Product
                            </th>
                            <th>
                                Qty
                            </th> 
                           
                            <th>
                                Time
                            </th>   
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="runningtable">
    <?php
    include 'Connection.php';
    date_default_timezone_set("Asia/Karachi");
     $result = mysqli_query($con,"SELECT * FROM invoicedetail Where d = CURDATE() && invoiceno = 123  order by InvoiceDetailId DESC");
              $data =array();
              while($row = mysqli_fetch_assoc($result)) /*this process is to find time from db*/
              {
                  /*get time from 'date' column in 'invoice detail' table */
                    $dbTime = $row['Date'];
                       $DBTIME = new DateTime($row['Date']);
                       
                       /*$arrayName = array('a' => 12,'b' =>23 );
                       print_r($arrayName);
                       print_r($arrayName['a']);*/
                        //strtotime('22-09-2008');
                    //$invoicetime=date($dbTime); //date('h:i:s', strtotime($dbTime));
                   // $date = date_create_from_format('Y-m-d h:i:s', $dbTime);
                    //$date->getTimestamp();
                    /* -----*/

                    /* get system time*/
                    $crnt_time= new DateTime();
                    
                   $timer = $DBTIME->diff($crnt_time);
                    $dur = $timer->h.":".$timer->i.":".$timer->s;

                     
                ?> 

    <tr id="<?php echo $row['InvoiceDetailId'];?>">
            <td><?php echo $row['Row'];?></td>
            <td><?php echo $row['ProductName'];?></td>   
            <td><?php echo $row['OrderQuantity'];?></td>
            <!-- get starting time done -->
            <td><?php echo $dur; ?></td>
<!-- 
            <td><?php  $date //= date_create_from_format('Y-m-d h:i:s', $StartTiming1);
                 //       $date->getTimestamp();$start_date = $StartTiming1 ; die();    
               //         $since_start = $date->diff(new DateTime());
            // echo $since_start->h.':'.$since_start->i.':'.$since_start->s; 
            ?></td>

 -->           <!--  <td><span class="tim"><?php # echo $d.'-'.$m.'-'.$y;?> </span></td> -->
            <td><input type='submit' style='font-size:18px;' class='Done btn-success' value='Done'  
                    id='<?php echo $row['InvoiceDetailId'];?>'>
            </td>  
    </tr>
    <?php
        }
    ?>
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        </div>
        <div class="neworder">
            <h6 class="T main_bg_color" id="neworderh6">Done Order</h6>
            <table class="table" name="mytable" id="mytable" align="center">
                <thead class="mytablethead">
                <tr class="main_bg_color">
                    <th scope="col">Item</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Table</th>
                </tr>
                </thead>

                <tbody id="OrderTable">
              <?php
                include 'Connection.php';
                 $result = mysqli_query($con,"SELECT * FROM invoicedetail Where d = CURDATE() && invoiceno = 111  order by InvoiceDetailId DESC Limit 15");

                  $data =array();
                  while($row = mysqli_fetch_assoc($result))
                  {?>
                     <tr id="<?php echo $row['InvoiceDetailId'];?>">
                        <td><?php echo $row['ProductName'];?></td>   
                        <td><?php echo $row['OrderQuantity'];?></td>
                        <td><?php echo $row['Row'];?></td>
                      </tr>
                     <?php
                        }
                    ?>    
                       </tbody>
            
            </table>

        </div>
        
</div>
</body>
</html>
<script type="text/javascript">
    $(document).on('click','.Done',function(e){
        var id = $(this).attr('id');
        $.ajax({
            url: 'KitchenManagment.php', //url from where we get data accesing DataBase
            data: {id:id},//passing data to php page in which php will send data to Database
            type: 'POST',
            success:function(data)
            {
           location.replace(location.pathname); 
            }
        });

        });

  //Script is to Hovar/Mark opened page in navbar
    $(function(){
        $('a').each(function(){
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active'); $(this).parents('li').addClass('active');
            }
        });
    });
</script>

  <script>
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (++timer < 0) {
            timer = duration;
        }
    }, 1000);
 }

 window.onload = function () {
    var fiveMinutes = 0,
        display = document.querySelector('.time');
    startTimer(fiveMinutes, display);
 };
</script> 
</html>