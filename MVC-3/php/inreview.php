<?php
session_start();

include 'dbcon.php';
include '../src/mail.php';

$noteid=$_GET['noteid'];
$user=$_SESSION['id'];

$update = mysqli_query($con,"update sellernotes set ActionedBy=$user,Status=8,ModifiedDate=current_timestamp(),ModifiedBy=$user where ID=$noteid");

if($update){
        header("location:../admin/notes-under-review.php");
}
else{
    echo "error";
}

?>