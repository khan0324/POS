<?php
include 'Connection.php';
date_default_timezone_set("Asia/Karachi");
session_start();
if($_SESSION['username']==true)
{
    $username = $_SESSION['username'];
    $status = $_SESSION['status'];
    // if ($status == "Kitchen") {
    //   header('location:Kitchen.php');  
    // }
    
}
else{
    header('location:index.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
     <link rel="shortcut icon" href="img/OT.ico" />
     <title>TPOS</title>

    <!-- Bootstrap core CSS -->
    <script src="jquery-3.3.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="js/pooper.js"></script>
 -->


<!--  <link href="toast/toastr.css" rel="stylesheet" />
    <link href="toast/style.css" rel="stylesheet" />
 -->    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js" data-semver="3.0.0" data-require="jquery"></script> -->
  <!--  <script src="toast/toastr.js"></script>
    <script src="toast/toastscript.js"></script>
<!- toaster popup -->



  
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/javascript" href="css/jquery-ui.css" >
    <!-- Custom styles for this template -->
    <link href="css/Newcss.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" href="datatables.net-bs/css/dataTables.bootstrap.min.css">

   <link href="pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="pagination/css/A_green.css" rel="stylesheet" type="text/css" />
</head>
  

  <style type="text/css">
  
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
    body{background-image: url('img/back.jpg');
  }
  .container{
    width: 100%;
    padding: 0px;
    margin: 0px auto;
  }
  .main_bg_color{
    background-color:chocolate;
  }
  .dropdown ul{
    padding-left: 5px;
  }
  thead th {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index: 999;
  
    color: white;
}
.navbar-dark .navbar-nav .nav-link{
  color: white;
}
    input{
      padding: 10px;
      box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    }
    button{
      box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    }
    select{
      padding: 10px;
      box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    }
    table{
      max-width: 688px;
      text-align: center;
      box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    }
    body{font-family: arial}
    @page{margin: 50px 0px 0px 0px ;}
    label{margin-left: 10px;font-weight: 600}
    .OrderTable td, .OrderTable th{ border: 1px solid black; border-top: 1px solid black;border-collapse: separate; border-spacing:0;}
    label{
      font-weight: bold;
    }
  .in{
      width: 50%;
      border-radius: 10px;
      margin-bottom: 10px;
      padding: 10px;
      text-align: center;
    }
    .T{
    margin: 0 auto;
    width: 25%;
    margin-top: 20px;
    border: 1px;
    border-style: solid;
    border-radius: 15px;
    margin-bottom: 10px;
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 5px;
    box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
    }
    .dis{
      display: none;
    }
    #OrderQuantity,#PurchasePrice{
      width: 13%;

    }
    #AddButton{
      min-width: 12%;
      padding: 1%;
      min-height: 50px;
      margin-left: 1%;
      letter-spacing: 2px;
    }
    #SaveButton{
      width: 37%;
      letter-spacing: 2px;
      padding: 2%;
      min-height: 50px;
    }

    /*Styling for Sale/Purcase Order pages*/
    #OrderTable {
            counter-reset: rowNumber;
        }

        #OrderTable tr {
            counter-increment: rowNumber;
        }

        #OrderTable tr td:first-child::before {
            content: counter(rowNumber);
            min-width: 1em;
            margin-right: 0.5em;
        }
        #nav_bar .active {
    color:            #F8F8F8;
    background-color: #4f81bd;
}
.wid
{
  width: 100%;
}
.verticalline {
    border-left: 1px solid black;
    height: 160px;
    float: left;
    margin: 0px 5px 0px 5px;
}
.btn{
  border-color: blue;
}
#btnAdd {
    padding: 1%;
}
nav{
  height: 30px;
  margin-bottom: 10px;

}
.menu{
  width: 47%; 
  float: left;
  background-color: #1b775e;
  min-height: 500px;
  color: white;
  border-radius: 10px;
  box-shadow: inset 1px 1px 9px rgba(24, 29, 14, 0.35);
  margin-left: 10px;
}
.neworder{
  float: right;
  background-color: #19653b; 
  width: 50%;
  max-width: 675px;
  color: white;    
  border-radius: 10px;
  min-height: 500px;
  box-shadow: inset 1px 1px 9px rgba(24, 29, 14, 0.35);
  margin-right: 10px;
  margin-bottom: 10px;
}
.navbar-expand-lg{
    height: 55px;
  }
.navbar-expand-lg .navbar-collapse{
  font-size: 14pt;
}
 
li .dropdown button{
  letter-spacing: 1px;
  margin-top: 2px;
}
li .dropdown li a{
  padding: 1%;
  letter-spacing: 1px;
}
.brHide{
  display: none;
}
figure{ 
  background: rgba(230, 230, 230, 0.4);
  text-align: center;
  padding: 7%;
  font-weight: bold;
  letter-spacing: 2px;
  font-size: 15pt;
  margin:0;
}
#homeBlock{
  padding: 2%;
}

.titleH1{
  font-size: 3vw;
}
#pagingg ul li:nth-child(1){
  color: white;
  margin-top: 5px;
  letter-spacing: 2px;
}
.navbar-nav .dropdown-menu{
  width: 170px;
  padding-right: 10px;
}
.nav-item .dropdown-menu li{
  border-bottom: 1px solid white;
}
.nav-item .dropdown-menu li:hover{
    border-bottom-color: chocolate;
}
.nav-item .dropdown-menu li a:hover{
  text-decoration: none;
}


@media only screen and (max-width:1200px) {
.navbar-expand-lg .navbar-collapse{
  font-size: 11pt;
  letter-spacing: 0.5px;
}
  figure{
    background: rgba(230, 230, 230, 0.4);
  }
}


@media only screen and (max-width:1100px) { /*small tab with  horizontal*/

#homeBlock .col-md-12{
  text-align: center;
  margin-bottom: 1%;
}

.brHide{
  display: inline-block;
}

   #show-logout {
    width: 100%;
    text-align: right;
  }

  .HideInTab{
    display: none !important;
  }
  #Received,#discount{
    width: 90%;
  }
/*  #hidenavbar ul{
      display: none !important;
  }*/

  #neworderh6{
    font-size: 17px;
    letter-spacing: 2px;
  }
  .HomeBlock{
    width: 90%;
    margin: 0 auto;
    padding: 1%;
  }
  .printhide{
		display: block;
	}
}


@media only screen and (max-width:800px) {

	.printhide{
		display: none;
	}
  figure{
    background: rgba(230, 230, 230, 0.4);
  }
  #show-logout{
    width: 100%;
  }
  .menu ,.neworder{
    min-width: 100%;
    margin: 0 auto;
    float: left;
  }
  .neworder{
    margin-top: 1%;
    margin-bottom: 2%;
  }
  .titleH1{
    font-size: 18pt;
  }

}
  </style>
  </head>

<body>
  
   <nav class="navbar navbar-expand-lg navbar-dark main_bg_color">
    <div class="container-fluid">  
  <!--     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto HideInTab">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="a-Product" href="add-product.php">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="a-Product" href="deals.php">Deals</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" id="a-Product" href="fixedasset.php">ASSET</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" id="a-Product" href="table.php">Table</a>
          </li>
          <li class="nav-item" id="a-user">
            <a class="nav-link" href="user.php">User</a>
          </li>
          
          <li class="nav-item" id="a-vendor">
            <a class="nav-link" href="add-vendor.php">Vendor</a>
          </li>
          <li class="nav-item" id="a-paymentreceipt">
            <a class="nav-link" id="a-paymentreceipt" href="PaymentReceipt.php">Payment Receipt</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Kitchen.php">Kitchen</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="Expensis.php">Expense</a>
          </li>
        
                   
          
          <li class="nav-item">
             <div class="dropdown">
                <button style="" class="btn dropdown-toggle" type="button" data-toggle="dropdown">Invoices
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="invoice.php" >Sale Invoice</a></li>
                  <li><a id="a-purchaseinvoice" href="purchaseinvoice.php">Purchase Invoice</a></li>
                </ul>
              </div> 
          </li>
          <li class="nav-item">
             <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" style="margin-left: 15px">Reports
                <span class="caret"></span></button>
                <ul class="dropdown-menu" style="margin-left: 15px">
                  <li><a  href="daily.php" id="a-salereport">Sale Reports</a></li>
                  <li><a id="a-purchasereports" href="PurchaseReports.php">Purchase Reports</a></li>
                  <li><a  id="a-paymentreceiptreports" href="PaidReceiptsReport.php">Payment Receipts</a></li>
                  <li><a href="StockReport.php" class="dropdownbg">StockReport</a></li>
                  <li><a href="salesummery.php" class="dropdownbg">Sale Summery</a></li>
                  <li><a  href="PL.php" class="dropdownbg">Profit/Loss</a></li>
                  <!--  -->
                </ul>
              </div> 
          </li>
          <li class="nav-item">
              
          </li>
          <li class="nav-item">
              
          </li>
          <li class="nav-item">
              
          </li>
        </ul>
      </div>
      <div id="show-logout">
    <span>Hello, &nbsp </span>
    <span id="s-username"><?php echo $username?></span>
    <a href="logout.php" class="fa fa-sign-out btn btn-danger" 
       style="background-color:red;font-size:14px;margin-left: 5px">Logout</a>
      </div>
    </div>
  </nav>
  
     <div class="loader"></div> 
  <script>
    var username = "<?php echo $username?>";
    var status = "<?php echo $status?>";
    if (status != "Admin" ) {
      document.getElementById("a-vendor").style.display="none";
      document.getElementById("a-salereport").style.display="none";
      document.getElementById("a-user").style.display="none";
    }
    /*if(status == "Kitchen");
    {
      window.location = "Kitchen.php";
    }*/
    //document.getElementById("s-username").innerHTML = username;
</script>

<script>
jQuery(function(){
   jQuery('#AutoPrintClick').click();
});
</script>