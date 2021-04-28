<?php
session_start();

include 'dbcon.php';

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
else{

$reportid = $_GET['id'];

$del = mysqli_query($con,"DELETE FROM sellernotesreportedissues WHERE ID=$reportid;");

if($del){
    header("location:../admin/spam-reports.php");
}
else{
    echo "error";
}
}
?>
