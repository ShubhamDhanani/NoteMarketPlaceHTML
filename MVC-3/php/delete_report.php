<?php
session_start();

include 'dbcon.php';

$reportid = $_GET['id'];

$del = mysqli_query($con,"DELETE FROM sellernotesreportedissues WHERE ID=$reportid;");

if($del){
    header("location:../admin/spam-reports.php");
}
else{
    echo "error";
}

?>
