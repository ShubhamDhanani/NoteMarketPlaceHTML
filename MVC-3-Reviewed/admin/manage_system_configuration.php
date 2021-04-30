<?php 
session_start();
include '../php/dbcon.php';
$pagename="Manage_System_Config";
$textp="";
$textn="";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3 or $_SESSION['role']==2){
    header("location:../front/login.php");
}

if(isset($_POST['submit'])){
    $semail= mysqli_real_escape_string($con,$_POST['semail'] );
    $sphone= mysqli_real_escape_string($con,$_POST['sphone'] );
    $emails= mysqli_real_escape_string($con,$_POST['emails'] );
    $furl= mysqli_real_escape_string($con,$_POST['furl'] );
    $turl= mysqli_real_escape_string($con,$_POST['turl'] );
    $lurl= mysqli_real_escape_string($con,$_POST['lurl'] );
    $np= $_FILES['np'];
    $pp= $_FILES['pp'];
    
    
                
    
                $ppname = $pp['name'];
                $pp_ext = explode('.',$ppname);
                $pp_ext_check = strtolower(end($pp_ext));
                $valid_pp_ext = array('jpg');
                if(in_array($pp_ext_check,$valid_pp_ext)){
                $folder_path1 = "../images/person/";
                $files1 = glob($folder_path1.'/*');

                // Deleting all the files in the list
                foreach($files1 as $file) {

                if(is_file($file))

                // Delete the given file
                unlink($file);
                }
                
                $ppnewname = 't1.'.$pp_ext_check;
                $pppath = $pp['tmp_name'];
                if(!is_dir("../images/person/")){
                mkdir("../images/person/",0777,true);
                }
                $pp_dest = '../images/person/'.$ppnewname;
                move_uploaded_file($pppath,$pp_dest);
                }
                else{
                    $textp="profile pic should be in jpg format only";
                
                }
    
    
                
    
                $npname = $np['name'];
                $np_ext = explode('.',$npname);
                $np_ext_check = strtolower(end($np_ext));
                $valid_np_ext = array('jpg');
                if(in_array($np_ext_check,$valid_np_ext)){
                $folder_path2 = "../images/note/";
                $files2 = glob($folder_path2.'/*');

                // Deleting all the files in the list
                foreach($files2 as $file) {

                if(is_file($file))

                // Delete the given file
                unlink($file);
                }
                    
                $npnewname = 'example.'.$np_ext_check;
                $nppath = $np['tmp_name'];
                if(!is_dir("../images/note/")){
                mkdir("../images/note/",0777,true);
                }
                $np_dest = '../images/note/'.$npnewname;
                move_uploaded_file($nppath,$np_dest);
                }
                else{
                $textn="Note pic should be in jpg format only";
                }
    
                
    
                $up1 = mysqli_query($con,"update systemconfigurations SET Value='$semail' where ID=1");
                $up2 = mysqli_query($con,"update systemconfigurations SET Value='$sphone' where ID=2");
                $up3 = mysqli_query($con,"update systemconfigurations SET Value='$emails' where ID=3");
                $up4 = mysqli_query($con,"update systemconfigurations SET Value='$furl' where ID=4");
                $up5 = mysqli_query($con,"update systemconfigurations SET Value='$turl' where ID=5");
                $up6 = mysqli_query($con,"update systemconfigurations SET Value='$lurl' where ID=6");
            
                if($up1 and $up2 and $up3 and $up4 and $up5 and $up6 and $textp=="" and $textn==""){
                    header("location:dashboard.php");
                }
}

$sel1 = mysqli_query($con,"select Value from systemconfigurations Where ID=1");
$sel2 = mysqli_query($con,"select Value from systemconfigurations Where ID=2");
$sel3 = mysqli_query($con,"select Value from systemconfigurations Where ID=3");
$sel4 = mysqli_query($con,"select Value from systemconfigurations Where ID=4");
$sel5 = mysqli_query($con,"select Value from systemconfigurations Where ID=5");
$sel6 = mysqli_query($con,"select Value from systemconfigurations Where ID=6");
$re1 = mysqli_fetch_assoc($sel1);
$re2 = mysqli_fetch_assoc($sel2);
$re3 = mysqli_fetch_assoc($sel3);
$re4 = mysqli_fetch_assoc($sel4);
$re5 = mysqli_fetch_assoc($sel5);
$re6 = mysqli_fetch_assoc($sel6);

?>
<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header-admin.php'; ?>


<!-- User Form -->
<div class="white_space"></div>
<div class="container">
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <div class="user-heading">
            <h3>Manage System Configuration</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Support emails address *</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email address" required name="semail" value="<?php echo $re1['Value'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputfname">Support phone number *</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter phone number" required name="sphone" pattern="[0-9]{0,10}" title="Phone number must have 10 digits" value="<?php echo $re2['Value'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email Address(es) (for various events system will send notification to these users) *</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email address" required multiple name="emails" value="<?php echo $re3['Value'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputfname">Facebook URL</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter facebook url" name="furl" value="<?php echo $re4['Value'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputfname">Twitter URL</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter twitter url" name="turl" value="<?php echo $re5['Value'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputfname">Linkedin URL</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter linkedin url" name="lurl" value="<?php echo $re6['Value'] ?>">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputfname">Default image for notes (if seller do not upload)*</label>
                            <small class="form-text text-muted text-left">
                            <p style="color:red;margin-top:-10px;"><?php echo $textn; ?></p>
                            </small>
                        <div class="upload-custom">
                            <button onclick="document.getElementById('getnote').click()">
                                <img src="../images/icons/upload-file.png">
                            </button>
                            <input type="file" id="getnote" style="border:none;width:70%;margin-left:-7%;" required name="np">
                            <p class="text-center">Upload a picture</p>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputfname">Default profile picture (if seller do not upload)*</label>
                        <small class="form-text text-muted text-left">
                            <p style="color:red;margin-top:-10px;"><?php echo $textp; ?></p>
                            </small>
                        <div class="upload-custom">
                            <button onclick="document.getElementById('getprofile').click()">
                                <img src="../images/icons/upload-file.png">
                            </button>
                            <input type="file" id="getprofile" style="border:none;width:70%;margin-left:-7%;" required name="pp">
                            <p class="text-center">Upload a picture</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary " id="submit-btn-user" name="submit">SUBMIT</button>
    </form>
</div>

<?php include '../php/footer.php'; ?>

</html>