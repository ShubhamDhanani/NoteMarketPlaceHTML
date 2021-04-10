<?php 
session_start();
include '../php/dbcon.php';
error_reporting(E_ALL ^ E_WARNING);
$pagename="Update_Profile";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
$user = $_SESSION['id'];
$sel = mysqli_query($con,"select * from userprofile Where UserID=$user");
$res = mysqli_fetch_assoc($sel);
if(isset($_POST['submit'])){
    $fname= mysqli_real_escape_string($con,$_POST['fname'] );
    $lname= mysqli_real_escape_string($con,$_POST['lname'] );
    $email= mysqli_real_escape_string($con,$_POST['email'] );
    $secondemail= mysqli_real_escape_string($con,$_POST['secondemail'] );
    $cc= mysqli_real_escape_string($con,$_POST['cc'] );
    $phone= mysqli_real_escape_string($con,$_POST['phone'] );
    $profilepic= $_FILES['profilepic'];
    
            if($fname!==$_SESSION['fname']){
                $updatefname = mysqli_query($con,"update users SET FirstName='$fname',ModifiedDate=CURRENT_TIMESTAMP() WHERE EmailID='$email'");
                $_SESSION['fname']=$fname;
            }
            if($lname!==$_SESSION['lname']){
                $updatelname = mysqli_query($con,"update users SET LastName='$lname',ModifiedDate=CURRENT_TIMESTAMP() WHERE EmailID='$email'");
                $_SESSION['lname']=$lname;
            }
            
            $profilepicname = $profilepic['name'];
    
            if(empty($profilepicname)){
                $update = mysqli_query($con,"UPDATE userprofile SET SecondaryEmailAddress='$secondemail',PhoneNumber_CountryCode='$cc',PhoneNumber=$phone,ModifiedDate=current_timestamp(),ModifiedBy=$user where UserID=$user");
            }
            else{
                $profilepic_ext = explode('.',$profilepicname);
                $profilepic_ext_check = strtolower(end($profilepic_ext));
                $valid_profilepic_ext = array('png','jpg','jpeg');
                if(in_array($profilepic_ext_check,$valid_profilepic_ext)){
                $profilepicnewname = "DP_".date("dmyhis").'.'.$profilepic_ext_check;
                $profilepicpath = $profilepic['tmp_name'];
                if(!is_dir("'../Member/'.$user.'/'")){
                mkdir("../Member/".$user."/",0777,true);
                }
                $profilepic_dest = '../Member/'.$user.'/'.$profilepicnewname;
                move_uploaded_file($profilepicpath,$profilepic_dest);
                }
                else{
                ?>
                <script>alert("profile pic should be in jpg,jpeg,png format only");</script>
                <?php
                }
            
            $update = mysqli_query($con,"UPDATE userprofile SET SecondaryEmailAddress='$secondemail',PhoneNumber_CountryCode='$cc',PhoneNumber=$phone,ProfilePicture='$profilepic_dest',ModifiedDate=current_timestamp(),ModifiedBy=$user where UserID=$user");
                
            }
            
            
            if($update){
                ?>
                <script>
                    alert("profile Updated SuccessFully");
                </script>
                <?php
            }
        
            
}


?>
<!DOCTYPE html>
<html lang="en">
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php include '../php/front-header-admin.php'; ?>
<div class="container">
    <!-- User Form -->
    <div class="white_space"></div>
    <div class="container form-wrap my-profile">
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="user-heading">
                <h3>My Profile</h3>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputfname">First Name *</label>
                        <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your first name" name="fname" pattern="[a-zA-Z]{3,}" title="At least three letters Required" required value="<?php echo $_SESSION['fname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputlname">Last Name *</label>
                        <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your last name" name="lname" pattern="[a-zA-Z]{3,}" title="At least three letters Required" required value="<?php echo $_SESSION['lname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email *</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address" required value="<?php echo $_SESSION['email']; ?>" readonly name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Secondary Email </label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address" name="secondemail" value="<?php echo $res['SecondaryEmailAddress'] ?>">
                    </div>
                    <div class="form-group col-md-12" style="padding: 0;">
                        <label for="exampleInputfname">Phone Number</label>
                        <div class="row">
                            <div class="col-md-3" style="width: 30%;">
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect01" name="cc">
                                   <option value="">+</option>
                                    <?php
                                    $country = "select * from countries where IsActive=1";
                                    $countryquery = mysqli_query($con,$country);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    for($i=1;$i<=$countryrows;$i++){
                                    $countryrow = mysqli_fetch_array($countryquery);
                                        ?>
                                        <option value="<?php echo $countryrow['CountryCode'] ?>" <?php if($res['PhoneNumber_CountryCode']==$countryrow['CountryCode']){echo "selected";} ?>><?php echo $countryrow['CountryCode'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                            <div class="col-md-9" style="width: 70%;">
                                <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your phone number" style="width: 100%" pattern="[0-9]{0,10}" title="Phone number must have 10 digits" name="phone" value="<?php echo $res['PhoneNumber']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputfname">Profile Picture</label>
                    <div class="upload-custom">
                        <button onclick="document.getElementById('getFile').click()">
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getFile" style="border:none;width:70%;margin-left:-7%;" name="profilepic">
                        <p class="text-center">Upload a picture</p>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-bottom-60 m-top-30" id="submit-btn-user" name="submit">UPDATE</button>
        </form>
    </div>
    </div>
 <?php include '../php/footer.php'; ?>

</html>