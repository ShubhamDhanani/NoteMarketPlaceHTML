<?php
session_start();
?>
<?php 
    include '../php/dbcon.php';
    include '../src/mail.php';

   if(isset($_POST['submit'])){
       $fname= mysqli_real_escape_string($con,$_POST['fname'] );
       $lname= mysqli_real_escape_string($con,$_POST['lname'] );
       $email= mysqli_real_escape_string($con,$_POST['email'] );
       $pass= mysqli_real_escape_string($con,$_POST['pass'] );
       $cpass= mysqli_real_escape_string($con,$_POST['cpass'] );
       
       $sec_pass= password_hash($pass, PASSWORD_BCRYPT);

       $token = bin2hex(random_bytes(15));
       
       $emailquery= "select * from users where EmailID='$email'";
        $query= mysqli_query($con,$emailquery);
       $emailcount= mysqli_num_rows($query);
       if($emailcount>0){
        ?>
           <center>
            <p style="color: red;">email is already exist.</p>
           </center>
        <?php
       }
       else{
           if($pass===$cpass){
               $insertquery= "insert into users(RoleID,FirstName,LastName,EmailID,Password,Token) values ('3','$fname','$lname','$email','$sec_pass','$token')";
               $iquery= mysqli_query($con,$insertquery);
               
            if($iquery){
              $mail->setFrom($config_email, 'NotesMarketPlace');  // This email address and name will be visible as sender of email

    $mail->addAddress('sndhanani43@gmail.com', 'Receiver name');  // This email is where you want to send the email
    $mail->addReplyTo($config_email, 'Sender name');   // If receiver replies to the email, it will be sent to this email address
 
    // Setting the email content
    $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
    $mail->Subject = "varification of NotesMarketPlace account";       //subject line of email
    $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
        <thead>
            <th>
                <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
            </th>
        </thead>
        <tbody>
            <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                <td class='text-1'>Email Verification</td>
            </tr>
            <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                <td class='text-2'>Dear $fname,</td>
            </tr>
            <tr style='height: 60px;'>
                <td class='text-3'>
                    Thanks for Signing up! <br>
                    Simply click below for email verification.
                </td>
            </tr>
            <tr style='height: 120px;font-size: 16px;font-weight: 400;line-height: 22px;color: #333333;margin-bottom: 50px;'>
                <td style='text-align: center;'>
                    <button class='btn btn-verify' style='width: 100% !important;height:50px;font-family: Open Sans; font-size: 18px;font-weight: 600;line-height: 22px;color: #fff;background-color: #6255a5;border-radius: 3px;'><a href='http://localhost/NoteMarketPlaceHTML/php/activate.php?token=$token' style='text-decoration:none !important;color:white !important;'>VERIFY EMAIL ADDRESS</a></button>
                </td>
            </tr>
        </tbody>
    </table>";   //Email body
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email
 
    $mail->send();
    echo 'Email message sent.';
        }
        else{
            ?>
            <script>
                alert("Not inserted your entry");
            </script>
            <?php
        }
           }
           else{
               echo "password is not matched";
           }
       }
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Notes Market Place-signup</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/icons/favicon.ico">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!--bootstrap css-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!--Responsive CSS-->
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>

    <div class="main-wrap">
        <div class="container-login" style="background-image: url('../images//posters/banner-with-overlay-11.jpg');">
            <div class="wrap-login">
                <span class="login-form-title">
                    <img src="../images//logo/top-logo.png">
                </span>
                <form class="login-form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']
                );?>">
                    <div class="signup-heading">
                        <h4 class="text-center">Create an Account</h4>
                        <p class="text-center">Enter your details to signup</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputfname">First Name *</label>
                        <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your first name" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputlname">Last Name *</label>
                        <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your last name" name="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email *</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address" name="email" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputPassword1">Password</label>
                            </div>
                        </div>
                        <div class="inputContainer">
                            <input type="password" id="password-field" class="form-control" placeholder="Enter your password" name="pass" required>
                            <span toggle="#password-field" class="eye field-icon toggle-password"><img src="../images//icons/eye.png">
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-bottom-30">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputPassword1">Confirm Password</label>
                            </div>
                        </div>
                        <div class="inputContainer">
                            <input type="password" id="confirm-password-field" class="form-control" placeholder="Re-enter your Password" name="cpass" required>
                            <span toggle="#confirm-password-field" class="eye field-icon toggle-password"><img src="../images//icons/eye.png">
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="login-btn" name="submit">SIGN UP</button>
                    <p class="text-center" id="not-account">Already have an account? <span><a href="login.php">Login</a></span></p>
                </form>
            </div>
        </div>
    </div>
    <!-- Jquery Js -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <!--    popper Js  -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap Js -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!--custom script-->
    <script type="text/javascript" src="../js/script.js"></script>

</body>

</html>