<?php
session_start();
if($_SESSION['username']==true)
{
    $username = $_SESSION['username'];
    $status = $_SESSION['status'];
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
    <script src="js/pooper.js"></script>
<!-- <script src="Functions.js"></script>     -->
    <link href="css/fontsgooglappies.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link type="text/javascript" href="css/jquery-ui.css" >
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <link href="css/Newcss.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/home.css">

    <meta http-equiv="refresh" content="10" > 
  

  <style type="text/css">
    body{background-image: url('img/back.jpg');
  }
  .container{
    width: 100%;
    padding: 0px;
    margin: 0px auto;
  }
  thead th {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index: 999; 
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
  background-color: #D4AE6E;
}
nav{
  height: 30px;
  margin-bottom: 10px;
  height: auto;
}
.menu{
  width: 52%; 
  float: left;
  background-color: #1b775e;
  min-height: 500px;
  color: white;
  border-radius: 10px;
  box-shadow: inset 1px 1px 9px rgba(24, 29, 14, 0.35);
  margin-left: 10px;
  padding: 0px 5px;
}
.neworder{
  float: right;
  background-color: #19653b; 
  width: 45%;
  max-width: 675px;
  color: white;    
  border-radius: 10px;
  min-height: 500px;
  box-shadow: inset 1px 1px 9px rgba(24, 29, 14, 0.35);
  margin-right: 10px;
  margin-bottom: 10px;
}
.main_color{
  color: chocolate;
}
.main_bg_color{
  background-color:chocolate; 
}

@media only screen and (max-width:1285px) {
  #show-logout {
    min-width: 100%;
    text-align: right;
  }

  .HideInTab{
    display: none !important;
  }
/*  .printhide{
    display: none !important;
  }
  #hidenavbar ul{
    display: none !important;
  }*/
   #show-logout{
      width: 20%;
    }
}
@media only screen and (max-width:1100px) { /*small tab with  horizontal*/
  #Received,#discount{
    width: 90%;
  }
/*  #hidenavbar ul{
      display: none !important;
  }*/
    #show-logout{
      width: 30%;
    }
      #neworderh6{
    font-size: 17px;
    letter-spacing: 2px;
  }
}
@media only screen and (max-width:800px) {
  #show-logout{
  width: 30%;
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

}
@media only screen and (max-width:600px) { /*small tab with vertical*/
  #show-logout{
  width: 40%;

}

  </style>
  </head>


  
   <nav class="navbar navbar-expand-lg navbar-dark main_bg_color">
    <div class="container-fluid">  
  <!--     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

     
    <div id="show-logout" class="col-12 text-right">
      <span>Hello, &nbsp </span>
      <span id="s-username"></span>
      <a href="logout.php" class="fa fa-sign-out btn btn-danger" 
         style="background-color:red;font-size:14px;margin-left: 5px">Logout</a>
        </div>
    </div>
  </nav>
  <script>
    var username = "<?php echo $username?>";
    var status = "<?php echo $status?>";
    if (status != "Admin" ) {
      document.getElementById("a-vendor").style.display="none";
      document.getElementById("a-salereport").style.display="none";
      document.getElementById("a-user").style.display="none";
    }
    document.getElementById("s-username").innerHTML = username;
</script>
