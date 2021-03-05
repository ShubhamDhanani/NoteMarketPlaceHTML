<?php 
    include '../php/dbcon.php';
    include '../src/mail.php';

   if(isset($_POST['submit'])){
       $username= mysqli_real_escape_string($con,$_POST['username'] );
       $email= mysqli_real_escape_string($con,$_POST['email'] );
       $subject= mysqli_real_escape_string($con,$_POST['subject'] );
       $comment= mysqli_real_escape_string($con,$_POST['comment'] );
       
       $mail->setFrom($config_email, 'NotesMarketPlace'); // This email address and name will be visible as sender of email

       $mail->addAddress('sndhanani43@gmail.com', 'Receiver name'); // This email is where you want to send the email
       $mail->addReplyTo($config_email, 'Sender name'); // If receiver replies to the email, it will be sent to this email address

       // Setting the email content
       $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
       $mail->Subject = "$username - $subject"; //subject line of email
       $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
           <thead>
               <th>
                   <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
               </th>
           </thead>
           <tbody>
               <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                   <td class='text-2'>Hello,</td>
               </tr>
               <tr style='height: 60px;'>
                   <td class='text-3'>
                       $comment
                   </td>
               </tr>
               <tr style='height: 60px;'>
                   <td class='text-3'>
                       Regards, <br>
                       $username, <br>
                       $email.
                       
                   </td>
               </tr>
           </tbody>
       </table>"; //Email body
       $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

       $mail->send();
       ?>
        <script>
            alert("query sent successfully");
        </script>
<?php
       }    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Notes Market Place-FAQ</title>
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

    <!--Header-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand" href="#">
                <img src="../images/logo/top-logo1.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="search_page.html">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="contact_us.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" style="text-decoration: none;"><button type="button" class="btn btn-primary btn-lg btn-block btn_login">Login</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- User Profile -->
    <div class="user-image m-top-100">
        <div class="user-text">
            <h1>Contact Us</h1>
        </div>
    </div>

    <!-- User Form -->

    <div class="container form-wrap">
        <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="contact-heading">
                <h3>Get in Touch</h3>
                <p>Let us know how to get back to you</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputfname">Full Name *</label>
                        <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your first name" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputfname">Email Address *</label>
                        <input type="email" class="form-control" id="exampleInputfname" placeholder="Enter your Email Address" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputfname">Subject *</label>
                        <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your subject" name="subject">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Comments / Questions *</label>
                    <textarea class="form-control" id="exampleInputfname" placeholder="Enter your comment or query" style="height: 89%" name="comment"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-top-30" id="submit-btn-user" name="submit">SUBMIT</button>
            <div class="m-bottom-60">
            </div>
        </form>
    </div>
    <hr>
    <!--    footer  -->
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 footer_content">
                    <p>Copyright © <a href="https://www.tatvasoft.com/">TatvaSoft</a> All Rights Reserved.</p>
                </div>
                <div class="col-md-6 footer_social text-right">
                    <ul class="social-list">
                        <li><a href="#">
                                <img src="../images/icons/facebook.png">
                            </a></li>
                        <li><a href="#">
                                <img src="../images/icons/twitter.png">
                            </a></li>
                        <li><a href="#">
                                <img src="../images/icons/linkedin.png">
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Js -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <!--    popper Js  -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap Js -->
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <!--custom script-->
    <script type="text/javascript" src="../js/script.js"></script>


</body>

</html>
