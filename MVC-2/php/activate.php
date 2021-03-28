<?php
session_start();

include 'dbcon.php';

if(isset($_GET['token'])){
	$token = $_GET['token'];

	$updatequery = "update users set IsEmailVerified=1 where Token='$token'";
	$query = mysqli_query($con,$updatequery);

	if($query){
		header('Location:../front/login.php');
	}
	else{
		echo "your email is not verified pls try again to register your email";
	}
}

?>