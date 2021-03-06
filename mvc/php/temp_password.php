<?php
session_start();

include 'dbcon.php';

if(isset($_GET['tokenpass'])){
	$tokenpass = $_GET['tokenpass'];
    $email= $_GET['email'];
    
    $sec_pass= password_hash($tokenpass, PASSWORD_BCRYPT);

	$updatequery = "update users set Password='$sec_pass' where EmailID='$email'";
	$query = mysqli_query($con,$updatequery);

	if($query){
		echo $tokenpass;
	}
	else{
		echo "error in getting new password";
	}
}

?>