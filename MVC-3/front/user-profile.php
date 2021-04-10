<?php 
session_start();
$pagename="Profile";
include '../php/dbcon.php';
error_reporting(E_ALL ^ E_WARNING);

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
$user = $_SESSION['id'];
$s= mysqli_query($con,"select * from userprofile where UserID=$user AND IsActive=1");
$scount=mysqli_num_rows($s);
if($scount>0){
$res = mysqli_fetch_assoc($s);
$date = $res['DOB'];
$timestamp = strtotime($date);
$new_date = date("Y-m-d", $timestamp);
$_SESSION['dob'] = $new_date;   
$_SESSION['gender'] = $res['Gender'];
$_SESSION['countrycode'] = $res['PhoneNumber_CountryCode'];
$_SESSION['phone'] = $res['PhoneNumber'];
$_SESSION['profilepic_dest'] = $res['ProfilePicture'];
$_SESSION['add1'] = $res['AddressLine1'];
$_SESSION['add2'] = $res['AddressLine2'];
$_SESSION['city'] = $res['City'];
$_SESSION['state'] = $res['State'];
$_SESSION['zipcode'] = $res['ZipCode'];
$_SESSION['country'] = $res['Country'];
$_SESSION['university'] = $res['University'];
$_SESSION['college'] = $res['College'];
}
if(isset($_POST['submit'])){
    $fname= mysqli_real_escape_string($con,$_POST['fname'] );
    $lname= mysqli_real_escape_string($con,$_POST['lname'] );
    $email= mysqli_real_escape_string($con,$_POST['email'] );
    $dob= mysqli_real_escape_string($con,$_POST['dob'] );
    $gender= mysqli_real_escape_string($con,$_POST['gender'] );
    $countrycode= mysqli_real_escape_string($con,$_POST['countrycode'] );
    $phone= mysqli_real_escape_string($con,$_POST['phone'] );
    $profilepic= $_FILES['profilepic'];
    $add1= mysqli_real_escape_string($con,$_POST['add1'] );
    $add2= mysqli_real_escape_string($con,$_POST['add2'] );
    $city= mysqli_real_escape_string($con,$_POST['city'] );
    $state= mysqli_real_escape_string($con,$_POST['state'] );
    $zipcode= mysqli_real_escape_string($con,$_POST['zipcode'] );
    $country= mysqli_real_escape_string($con,$_POST['country'] );
    $university= mysqli_real_escape_string($con,$_POST['university'] );
    $college= mysqli_real_escape_string($con,$_POST['college'] );
    
    
            
            if($fname!==$_SESSION['fname']){
                $updatefname = mysqli_query($con,"update users SET FirstName='$fname',ModifiedDate=CURRENT_TIMESTAMP() WHERE EmailID='$email'");
                $_SESSION['fname']=$fname;
            }
            if($lname!==$_SESSION['lname']){
                $updatelname = mysqli_query($con,"update users SET LastName='$lname',ModifiedDate=CURRENT_TIMESTAMP() WHERE EmailID='$email'");
                $_SESSION['lname']=$lname;
            }
    
        
    $select = "select * from userprofile Where UserID=$user AND IsActive=1";
    $selectquery = mysqli_query($con,$select);
    $selectcount = mysqli_num_rows($selectquery);
    if($selectcount>0){
        
        $result= mysqli_fetch_assoc($selectquery);
        $path = $result['ProfilePicture'];
        
        $profilepicname = $profilepic['name'];
        if(!$profilepicname){
            $profilepic_dest = "$path";  
        }else{
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
        }
        
        $update = "UPDATE userprofile SET DOB='$dob',Gender='$gender' , PhoneNumber_CountryCode='$countrycode', PhoneNumber='$phone', ProfilePicture='$profilepic_dest',AddressLine1='$add1', AddressLine2='$add2',City='$city',State='$state',ZipCode='$zipcode', Country='$country', University='$university', College='$college',ModifiedDate=CURRENT_TIMESTAMP(), ModifiedBy='$user' where UserID='$user'  "; 
        $updatequery = mysqli_query($con,$update);
    
        if($updatequery){
        $_SESSION['dob'] = $dob;
        $_SESSION['gender'] = $gender;
        $_SESSION['countrycode'] = $countrycode;
        $_SESSION['phone'] = $phone;
        $_SESSION['profilepic_dest'] = $profilepic_dest;
        $_SESSION['add1'] = $add1;
        $_SESSION['add2'] = $add2;
        $_SESSION['city'] = $city;
        $_SESSION['state'] = $state;
        $_SESSION['zipcode'] = $zipcode;
        $_SESSION['country'] = $country;
        $_SESSION['university'] = $university;
        $_SESSION['college'] = $college;
        ?>
        <script>alert("profile updated successfully");</script>
        <?php
        }
        else{
        ?>
        <script>alert("profile not updated ");</script>
        <?php
        }
    }
    else{
        
        $profilepicname = $profilepic['name'];
        if(!$profilepicname){
            $profilepic_dest = "../images/person/t1.jpg";  
        }else{
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
        }
        
        $insert = "INSERT INTO userprofile(UserID, DOB, Gender, PhoneNumber_CountryCode, PhoneNumber,ProfilePicture,AddressLine1, AddressLine2, City, State, ZipCode, Country, University, College, CreatedBy) VALUES ($user,'$dob',$gender,'$countrycode',$phone,'$profilepic_dest','$add1','$add2','$city','$state','$zipcode','$country','$university','$college','$user')";
        $insertquery = mysqli_query($con,$insert);
        if($insertquery){
        $_SESSION['dob'] = $dob;
        $_SESSION['gender'] = $gender;
        $_SESSION['countrycode'] = $countrycode;
        $_SESSION['phone'] = $phone;
        $_SESSION['profilepic_dest'] = $profilepic_dest;
        $_SESSION['add1'] = $add1;
        $_SESSION['add2'] = $add2;
        $_SESSION['city'] = $city;
        $_SESSION['state'] = $state;
        $_SESSION['zipcode'] = $zipcode;
        $_SESSION['country'] = $country;
        $_SESSION['university'] = $university;
        $_SESSION['college'] = $college;
        ?>
        <script>alert("profile created successfully");</script>
        <?php
        }
        else{
        ?>
        <script>alert("profile not created");</script>
        <?php
        }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header.php'; ?>

    <!-- User Profile -->
    <div class="user-image m-top-100">
        <div class="user-text">
            <h1>User Profile</h1>
        </div>
    </div>

    <!-- User Form -->

    <div class="container form-wrap">
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="user-heading">
                <h3>Basic Profile Details</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">First Name *</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your first name" value="<?php echo $_SESSION['fname'];?>" name="fname" pattern="[a-zA-Z]{3,}" title="At least three letters Required" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Last Name *</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your last name" value="<?php echo $_SESSION['lname'];?>" name="lname" pattern="[a-zA-Z]{3,}" title="At least three letters Required" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Email *</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address" value="<?php echo $_SESSION['email'];?>" readonly name="email"> 
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Date Of Birth</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="Enter your date of birth" name="dob" value="<?php if(isset($_SESSION['dob'])){echo $_SESSION['dob'];}?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Gender</label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect01" name="gender">
                            <option selected value="">Select your gender</option>
                            <option value="1" <?php if(isset($_SESSION['gender'])){if($_SESSION['gender']==1){echo "selected";}}?> >Male</option>
                            <option value="2" <?php if(isset($_SESSION['gender'])){if($_SESSION['gender']==2){echo "selected";}}?> >Female</option>
                            <option value="3" <?php if(isset($_SESSION['gender'])){if($_SESSION['gender']==3){echo "selected";}}?> >Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Phone Number*</label>
                    <div class="row">
                        <div class="col-md-3" style="width: 30%;">
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect01" name="countrycode" required>
                                   <option value="">+</option>
                                    <?php
                                    $country = "select * from countries where IsActive=1";
                                    $countryquery = mysqli_query($con,$country);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    for($i=1;$i<=$countryrows;$i++){
                                    $countryrow = mysqli_fetch_array($countryquery);
                                        ?>
                                        <option value="<?php echo $countryrow['CountryCode'] ?>" <?php if(isset($_SESSION['countrycode'])){ if($_SESSION['countrycode']==$countryrow['CountryCode']){echo "selected";} }?>><?php echo $countryrow['CountryCode'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9" style="width: 70%; padding-left: 0;">
                            <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your phone number" name="phone" pattern="[0-9]{10}" title="Phone number must have 10 digits" required value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone']; }?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
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
            <div class="user-heading">
                <h3>Address Details</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Address Line 1 *</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your address" name="add1" pattern="[a-zA-Z0-9 / -- :,]{5,}" title="add1 should have atleast 5 character" required value="<?php if(isset($_SESSION['add1'])){echo $_SESSION['add1']; }?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Address Line 2*</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your address" name="add2" pattern="[a-zA-Z0-9 / -- :,]{5,}" title="add2 should have atleast 5 character" required value="<?php if(isset($_SESSION['add2'])){ echo $_SESSION['add2']; }?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">City *</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your city" name="city" pattern="[a-zA-Z]{3,}" title="At least three letters Required" required value="<?php if(isset($_SESSION['city'])){echo $_SESSION['city'];} ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">State *</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your state" name="state" pattern="[a-zA-Z]{3,}" title="At least three letters Required" required value="<?php if(isset($_SESSION['state'])){ echo $_SESSION['state']; }?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">ZipCode *</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your zipcode" name="zipcode" pattern="[0-9--]{3,}" title="At least three digits Required" required value="<?php if(isset($_SESSION['zipcode'])){ echo $_SESSION['zipcode'];} ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Country *</label>
                    <div class="input-group mb-3">
                       
                        <select class="custom-select" id="inputGroupSelect01" name="country" required>
                            <option value="">Select your country</option>
                            <?php
                            $country = "select * from countries where IsActive=1";
                            $countryquery = mysqli_query($con,$country);
                            $countryrows = mysqli_num_rows($countryquery);
                            for($i=1;$i<=$countryrows;$i++){
                                $countryrow = mysqli_fetch_array($countryquery);
                            ?>
                            <option value="<?php echo $countryrow['Name'] ?>"<?php if(isset($_SESSION['country'])){if($_SESSION['country']==$countryrow['Name']){echo "selected";}} ?> ><?php echo $countryrow['Name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="user-heading">
                <h3>University and College Information</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">University</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your first name" name="university" pattern="[a-zA-Z]{1,}" title="It Should not be numeric value" value="<?php if(isset($_SESSION['university'])){ echo $_SESSION['university'];}?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">College</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your last name" name="college" pattern="[a-zA-Z]{3,}" title="It Should not be numeric value and minimum length must be 3" value="<?php if(isset($_SESSION['college'])){echo $_SESSION['college'];}?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary " id="submit-btn-user" name="submit">SUBMIT</button>
        </form>
    </div>
    <?php include '../php/footer.php'; ?>

</html>