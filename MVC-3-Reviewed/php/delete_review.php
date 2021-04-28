<?php
session_start();

include 'dbcon.php';
if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
else{

$review = $_GET['id'];
$noteid = $_GET['noteid'];

$delete=mysqli_query($con,"DELETE FROM sellernotesreviews WHERE ID=$review");
if($delete){
    header("location:../admin/note-details.php?id=$noteid");
}
else{
    echo "error";
}
}
?>
