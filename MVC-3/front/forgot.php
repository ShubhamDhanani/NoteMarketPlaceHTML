<?php 
session_start();
?>
<?php 
    include '../php/dbcon.php';
    include '../src/mail.php';

   if(isset($_POST['submit'])){
       $email= mysqli_real_escape_string($con,$_POST['email'] );

       $tokenpass = bin2hex(random_bytes(4))."Nmp@1";
       
       
       $emailquery= "select * from users where EmailID='$email' AND IsActive=1";
        $query= mysqli_query($con,$emailquery);
       $emailcount= mysqli_num_rows($query);
       if($emailcount>0){
           $user = mysqli_fetch_assoc($query);
           $fname = $user['FirstName'];
           
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
            <br>
            <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                <td class='text-1'>Temp Password Generation</td>
            </tr>
            <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                <td class='text-2'>Dear $fname,</td>
            </tr>
            <tr style='height: 60px;'>
                <td class='text-3'>
                    Pls Click on below Button and Generate Your New Password,
                </td>
            </tr>
            <tr style='height: 60px;'>
                <td class='text-3'>
                    Regards <br>
                    NotesMarketPlace
                </td>
            </tr>
            <tr style='height: 120px;font-size: 16px;font-weight: 400;line-height: 22px;color: #333333;margin-bottom: 50px;'>
                <td style='text-align: center;'>
                    <button class='btn btn-verify' style='width: 100% !important;height:50px;font-family: Open Sans; font-size: 18px;font-weight: 600;line-height: 22px;color: #fff;background-color: #6255a5;border-radius: 3px;'><a href='http://localhost/NoteMarketPlaceHTML/php/temp_password.php?tokenpass=$tokenpass&email=$email' style='text-decoration:none !important;color:white !important;'>GET YOUR NEW PASSWORD</a></button>
                </td>
            </tr>
        </tbody>
    </table>";   //Email body
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email
 
    $mail->send();
           
           ?>
            <script>alert("New Password Generation Link sent on your email");</script>
            <script>location.replace("login.php");</script>
            <?php
           
       }
       else{
           ?>
            <script>
                alert("email is invalid");
            </script>
           <?php
       }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Notes Market Place-forgot password</title>
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
        <div class="container-login" style="background-image: url('../images/posters/banner-with-overlay-11.jpg');">
            <div class="wrap-login">
                <span class="login-form-title">
                    <img src="../images/logo/top-logo.png">
                </span>
                <form class="login-form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <div class="heading">
                        <h4 class="text-center">Forgot Password?</h4>
                        <p class="text-center">Enter your email to reset your password</p>
                    </div>
                    <div class="form-group m-bottom-30">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="submit-btn" name="submit">SUBMIT</button>
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