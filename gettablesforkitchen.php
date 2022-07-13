<?php
 include 'Connection.php';

$sr = $_POST["sr"];
 


	$tables = mysqli_query($con,"SELECT tables FROM invoice Where sr = $sr");

    $result=mysqli_query($con,$tables);

    echo $result;
?>