<?php
session_start();

include 'dbcon.php';

$admin= $_SESSION['id'];
$user = $_GET['id'];
$up = mysqli_query($con,"update users set IsActive=0 where ID=$user");
$up1 = mysqli_query($con,"UPDATE userprofile SET IsActive=0 WHERE UserID=$user");
$up2 = mysqli_query($con,"UPDATE sellernotesreviews SET IsActive=0 WHERE ReviewedByID=$user");
$up3 = mysqli_query($con,"UPDATE sellernotesreportedissues SET IsActive=0 WHERE ReportedByID=$user");
$up4 = mysqli_query($con,"UPDATE sellernotesattachements SET IsActive=0 WHERE CreatedBy=$user");
$up5 = mysqli_query($con,"UPDATE sellernotes SET Status=11,ActionedBy=$admin,IsActive=0 where SellerID=$user");
$up6 = mysqli_query($con,"UPDATE downloads SET IsActive=0 WHERE Seller=$user");




$select = mysqli_query($con,"select * from sellernotes where SellerID=$user");

while($res=mysqli_fetch_assoc($select)){
    $seller = $res['SellerID'];
    $noteid = $res['ID'];
    
    $folder_path = "../Member/".$seller."/".$noteid."/"."Attachment"."/";
        $files = glob($folder_path.'/*');

        // Deleting all the files in the list
        foreach($files as $file) {

        if(is_file($file))

        // Delete the given file
        unlink($file);
        }
        rmdir("../Member/".$seller."/".$noteid."/"."Attachment"."/");



        $folder_path1 = "../Member/".$seller."/".$noteid."/";
        $files1 = glob($folder_path1.'/*');

        // Deleting all the files in the list
        foreach($files1 as $file) {

        if(is_file($file))

        // Delete the given file
        unlink($file);
        }
        rmdir("../Member/".$seller."/".$noteid."/");
}

$folder_path2 = "../Member/".$user."/";
        $files2 = glob($folder_path2.'/*');

        // Deleting all the files in the list
        foreach($files2 as $file) {

        if(is_file($file))

        // Delete the given file
        unlink($file);
        }
rmdir("../Member/".$user."/");

if($up and $up1 and $up2 and $up3 and $up4 and $up5 and $up6){
    header("location:../admin/members.php");
}
else{
    echo "error";
}

?>