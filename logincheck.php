<?php
include 'Connection.php';

	$username = $_POST["Username"];
	$password = $_POST["Password"];

	$check = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
	$query = mysqli_query($con,$check);

	$rows = mysqli_num_rows($query);
	if($rows == 1)
	{
		while ($row=mysqli_fetch_assoc($query))
  		{
  		session_start();
	    $_SESSION['username'] = $row['username'];
	    $_SESSION['password'] = $row['password'];
	    $_SESSION['status'] = $row['status'];
	    
	     
	    	 
		}
	    
		echo $username;
	}
	else{
		echo "No";
	}

?>