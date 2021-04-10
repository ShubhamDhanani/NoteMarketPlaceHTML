<?php 
session_start();
include '../php/dbcon.php';
include '../src/mail.php';
$pagename="Add_Admin";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3 or $_SESSION['role']==2){
    header("location:../front/login.php");
}
$mem=$_SESSION['id'];

if(isset($_GET['editadmin'])){
    $user = $_GET['editadmin'];
    $_SESSION['user']=$user;
    $selec = mysqli_query($con,"select * from users where ID=$user");
    $res_u = mysqli_fetch_assoc($selec);
    $selecp = mysqli_query($con,"select PhoneNumber_CountryCode as cc,PhoneNumber as phone from userprofile where UserID=$user");
    $res_p=mysqli_fetch_assoc($selecp);
}
    if(isset($_POST['update'])){
    $user =$_SESSION['user'];
    $fname= mysqli_real_escape_string($con,$_POST['fname'] );
    $lname= mysqli_real_escape_string($con,$_POST['lname'] );
    $email= mysqli_real_escape_string($con,$_POST['email'] );
    $ccode= mysqli_real_escape_string($con,$_POST['ccode'] );
    $phone= mysqli_real_escape_string($con,$_POST['phone'] );        
        
        $update1 = mysqli_query($con,"UPDATE users SET FirstName='$fname',LastName='$lname',EmailID='$email',ModifiedDate=current_timestamp(),ModifiedBy=$mem where ID=$user");
        
        if($update1){
            echo "update1"."<br>";
        }
        
        $update2 = mysqli_query($con,"UPDATE userprofile SET PhoneNumber_CountryCode='$ccode',PhoneNumber=$phone,ModifiedDate=current_timestamp(),ModifiedBy=$mem where UserID=$user");
        
        if($update1 and $update2){
            header("location:manage-administrator.php");
        }
        unset($_SESSION['user']);
        
    }
    
    if(isset($_POST['submit'])){
    $fname= mysqli_real_escape_string($con,$_POST['fname'] );
    $lname= mysqli_real_escape_string($con,$_POST['lname'] );
    $email= mysqli_real_escape_string($con,$_POST['email'] );
    $ccode= mysqli_real_escape_string($con,$_POST['ccode'] );
    $phone= mysqli_real_escape_string($con,$_POST['phone'] );

    $sel = mysqli_query($con,"select * from users where EmailID='$email'");
    $count= mysqli_num_rows($sel);
    if($count>0){
        ?>
        <script>
            alert("Email Already Exist In Database Pls Try With Different Email");
        </script>
        <?php
    }
    else{
        $tokenpass = bin2hex(random_bytes(4))."@Nmp1";
        $sec_pass= password_hash($tokenpass, PASSWORD_BCRYPT);
        
        $insert1 = mysqli_query($con,"INSERT INTO users(FirstName,LastName,EmailID,RoleID,Password,IsEmailVerified) values ('$fname','$lname','$email',2,'$sec_pass',1)");
    
        $sel2= mysqli_query($con,"select * from users where EmailID='$email'");
        $re = mysqli_fetch_assoc($sel2);
        $userid=$re['ID'];
        
        $insert2 = mysqli_query($con,"INSERT INTO userprofile(UserID,PhoneNumber_CountryCode,PhoneNumber,AddressLine1,AddressLine2,City,State,ZipCode,Country) values ($userid,'$ccode',$phone,' ',' ',' ',' ',' ',' ')");
        
        if($insert1 and $insert2){
        
        
            $mail->setFrom($config_email, 'NotesMarketPlace'); // This email address and name will be visible as sender of email

            $mail->addAddress('sndhanani43@gmail.com', 'Receiver name'); // This email is where you want to send the email
            $mail->addReplyTo($config_email, 'Sender name'); // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
            $mail->Subject = "Now You Are Admin !!!"; //subject line of email
            $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                <thead>
                    <th>
                        <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
                    </th>
                </thead>
                <tbody>
                    <br>
                    <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                        <td class='text-1'>Now You Are Admin</td>
                    </tr>
                    <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                        <td class='text-2'>Dear $fname,</td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            Now You are Admin Of NotesMarketPlace,<br>
                            Your Credentials is below,<br>
                            username : $email <br>
                            Password : $tokenpass
                        </td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            Regards <br>
                            NotesMarketPlace
                        </td>
                    </tr>
                    
                </tbody>
            </table>"; //Email body
            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

            $mail->send();


            header("location:manage-administrator.php");
            }
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
    <!-- User Form -->
    <div class="white_space"></div>
    <div class="container form-wrap">
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="user-heading">
                <h3>Add Administrator</h3>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputfname">First Name *</label>
                        <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your first name" pattern="[a-zA-Z]{3,}" title="At least three letters Required and all character must be alphabets" required name="fname" <?php if(isset($_GET['editadmin'])){echo 'Value='.$res_u['FirstName'];} ?>  >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputlname">Last Name *</label>
                        <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your last name" pattern="[a-zA-Z]{3,}" title="At least three letters Required and all character must be alphabets" required name="lname" <?php if(isset($_GET['editadmin'])){echo 'Value='.$res_u['LastName'];} ?> >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email *</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address" name="email" <?php if(isset($_GET['editadmin'])){echo 'Value='.$res_u['EmailID'];} ?> >
                    </div>
                    <div class="form-group col-md-12" style="padding: 0;">
                        <label for="exampleInputfname">Phone Number*</label>
                        <div class="row">
                            <div class="col-md-3" style="width: 30%;">
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect01" name="ccode" required>
                                   <option value="">+</option>
                                    <?php
                                    $country = "select * from countries where IsActive=1";
                                    $countryquery = mysqli_query($con,$country);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    for($i=1;$i<=$countryrows;$i++){
                                    $countryrow = mysqli_fetch_array($countryquery);
                                        ?>
                                        <option value="<?php echo $countryrow['CountryCode'] ?>" <?php if(isset($_GET['editadmin'])){if($countryrow['CountryCode']==$res_p['cc']){echo "selected";}} ?> ><?php echo $countryrow['CountryCode'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                            <div class="col-md-9" style="width: 70%;">
                                <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Phone number must have 10 digits" required name="phone" <?php if(isset($_GET['editadmin'])){echo 'Value='.$res_p['phone'];} ?>>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-top-30 m-bottom-60" id="submit-btn-user" name="<?php if(isset($_GET['editadmin'])){echo "update";}
            else{echo "submit";}?>">
            <?php if(isset($_GET['editadmin'])){echo "UPDATE";}
            else{echo "SUBMIT";}?></button>
        </form>
    </div>

 <?php include '../php/footer.php'; ?>

</html>