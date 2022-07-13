 
<!DOCTYPE html>

<title></title>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<link rel="shortcut icon" href="img/OT.ico" />
     <title>TPOS</title>

    <!-- Bootstrap core CSS -->
    <script src="jquery-3.3.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pooper.js"></script>
    <link href="css/fontsgooglappies.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link type="text/javascript" href="css/jquery-ui.css" >
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <link href="css/Newcss.css" rel="stylesheet">
 	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<style>
	body{
		padding:0px;
		overflow-x: hidden;
	}
	body div:first-child{
		margin-top: 60px;
	}
	#b-login{
		width: 100%; 
	}
	input{
		border-radius: 15px;
	}
	.main_bg_color{
		background-color: chocolate;
	}

</style>

<body >
<div class="container">
	<div class="row">
		<div class="Logo col-7" id="logoindex">
			<img id="" src="img/Logo1.jpg" id="logoimg">
		</div>
		<div class="LoginInfo col-5 text-left">
			<h1>Member Login</h1>
			<input type="text" class="col-8 m-1 p-2 text-center" name="login" placeholder="LOGIN" id="i-username"><br>
			<input type="password" class="col-8 m-1 p-2 text-center" name="password" placeholder="PASSWORD" id="i-password"><br>
			<input type="button" name="login" value="LOGIN" id="b-login" class="col-8 m-1 p-2 text-center main_bg_color">
		</div>
	</div>
</body>
<script type="text/javascript">
	
$(document).ready(function()
{
	$("#b-login").click(function login()
	{
		var Username = $("#i-username").val();
		var Password = $("#i-password").val();

		$.ajax({
			url: 'logincheck.php',
			data: {Username:Username, Password:Password},
			type: 'POST',
			success:function(data)
			{
				window.location.href = "home.php";
			}
		});
	});
});
</script>

</html>