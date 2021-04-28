<?php
session_start();

include 'dbcon.php';

if(isset($_POST['noteid'])){
    $user = $_POST['user'];
    $noteid = $_POST['noteid'];
    
    $update = mysqli_query($con,"UPDATE downloads SET IsAttachmentDownloaded=1,AttachmentDownloadedDate=current_timestamp(),ModifiedDate=current_timestamp(),ModifiedBy=$user where Downloader=$user and NoteID=$noteid");
    
}

?>