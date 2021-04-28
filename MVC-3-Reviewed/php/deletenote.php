<?php
session_start();

include 'dbcon.php';

$id = $_GET['id'];
$user = $_SESSION['id'];

$selc=mysqli_query($con,"select * from sellernotes where ID=$id");
$resc=mysqli_fetch_assoc($selc);
if(!isset($_SESSION['fname']) or $resc['SellerID']!==$_SESSION['id']){
    header("location:../front/login.php");
}
else{
$delete= "delete from sellernotes where ID=$id";
$delquery= mysqli_query($con,$delete);
if($delquery){
    $folder_path = "../Member/".$user."/".$id."/"."Attachment"."/";
    $files = glob($folder_path.'/*');

    // Deleting all the files in the list
    foreach($files as $file) {

    if(is_file($file))

    // Delete the given file
    unlink($file);
    } 
    rmdir("../Member/".$user."/".$id."/"."Attachment"."/");
    
    
    
    $folder_path1 = "../Member/".$user."/".$id."/";
    $files1 = glob($folder_path1.'/*');

    // Deleting all the files in the list
    foreach($files1 as $file) {

    if(is_file($file))

    // Delete the given file
    unlink($file);
    } 
    rmdir("../Member/".$user."/".$id."/");
    ?>
    <script>
            alert("deleted successfully");
            location.replace("../front/sellnotes.php");
    </script>
    <?php
}
else{
    ?>
    <script>
            alert("delete failed");
            location.replace("../front/sellnotes.php");
    </script>
    <?php
}
}
?>