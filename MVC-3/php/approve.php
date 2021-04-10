<?php
session_start();

include 'dbcon.php';
include '../src/mail.php';

$user=$_SESSION['id'];

if(isset($_GET['noteid'])){
    
    $noteid=$_GET['noteid'];


    $update = mysqli_query($con,"update sellernotes set ActionedBy=$user,Status=9,PublishedDate=current_timestamp() where ID=$noteid");

    if($update){
        header("location:../admin/notes-under-review.php");
    }
    else{
    echo "error";
    }
    
}
if(isset($_GET['id'])){
    $noteid=$_GET['id'];


    $update = mysqli_query($con,"update sellernotes set ActionedBy=$user,Status=9,PublishedDate=current_timestamp() where ID=$noteid");

    if($update){
        header("location:../admin/rejected-notes.php");
    }
    else{
    echo "error1";
    }
}


?>