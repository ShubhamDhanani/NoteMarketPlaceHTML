<?php 
session_start();
?>
<?php
include '../php/dbcon.php';
$text="";
$text1="";


if(isset($_POST['submit'])){
    $email= mysqli_real_escape_string($con,$_POST['email']);
    $pass= mysqli_real_escape_string($con,$_POST['password']);

    $email_search = "select * from users where EmailID='$email' AND IsActive=1";
    $query = mysqli_query($con,$email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
        $email_pass = mysqli_fetch_assoc($query);
        
        $_SESSION['id'] = $email_pass['ID'];
        $_SESSION['fname'] = $email_pass['FirstName'];
        $_SESSION['lname'] = $email_pass['LastName'];
        $_SESSION['email'] = $email_pass['EmailID'];
        $_SESSION['password'] = $email_pass['Password'];

        $dbpass = $email_pass['Password'];
        $email_verification = $email_pass['IsEmailVerified'];
        $roleid = $email_pass['RoleID'];
        $_SESSION['role']=$roleid;

        $pass_decode = password_verify($pass, $dbpass);
        $x = $pass_decode;
        

        if($pass_decode){
            if($email_verification == 1 && $roleid == 3){
                $user = $_SESSION['id'];
                echo $user;
                $sel = "select * from userprofile where UserID=$user";
                $select = mysqli_query($con,$sel);
                $selcount = mysqli_num_rows($select);
                if($selcount>0){
                    header("location:search.php");
                }
                else{
                    header("location:user-profile.php");
                }
                
            }
            elseif($email_verification == 1 && $roleid == 2){
                header("location:../admin/dashboard.php");
            }
            elseif($email_verification == 1 && $roleid == 1){
                header("location:../admin/dashboard.php");
            }
            else{
                $text1 = "your email verification is in panding, pls check your mailbox and do verification";
                ?>
<!--
            <script>
                alert("your email verification is in panding,pls check your mailbox and do verification");
            </script>
-->
<?php
            }
        }
        else{
            $text = "Password Incorrect";
            ?>
<!--
            <script>
                alert("Password Incorrect");
            </script>
-->
<?php
        }
        
        if($pass_decode){
            if(isset($_POST['rememberme'])){
                setcookie('emailcookie',$email,time()+86400);
                setcookie('passcookie',$pass,time()+86400);
            }
        }
        
    }else{
        $em = mysqli_query($con,"select * from users where EmailID='$email'");
        $c_em = mysqli_num_rows($em);
        if($c_em>0){
            $text1="Your Account Has Been Blocked";
        }
        else{
          $text1 = "Invalid Email.";  
        }
        
        ?>
<!--
            <script>
                alert("Invalid Email.");
            </script>
-->
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
    <title>Notes Market Place-Login</title>
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
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <div class="main-wrap">
        <div class="container-login" style="background-image: url('../images/posters/banner-with-overlay-11.jpg');">
            <div class="wrap-login">
                <span class="login-form-title">
                    <a href="home-page.php"><img src="../images/logo/top-logo.png"></a>
                </span>
                <form class="login-form" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <div class="heading">
                        <h4 class="text-center">Login</h4>
                        <p class="text-center">Enter your email address and passwod to login</p>
                    </div>
                    <div class="form-group m-bottom-30">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php if(isset($_COOKIE['emailcookie'])){echo $_COOKIE['emailcookie'];} ?>" required>
                        <small id="password-help" class="form-text text-muted"><span><?php echo $text1; ?></span></small>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6" style="width: 30%;">
                                <label for="exampleInputPassword1" style="display: inline-block;">Password</label>
                            </div>
                            <div class="col-md-6" style="width: 70%;">
                                <label for="exampleInputPassword1" class="text-right"><span><a href="forgot.php" style="text-decoration: none !important; color: #6255a5;">Forgot Password?</a></span></label>
                            </div>
                        </div>
                        <div class="inputContainer">
                            <input type="password" id="password-field" class="form-control" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['passcookie'])){echo $_COOKIE['passcookie'];} ?>" required>
                            <span toggle="#password-field" class="eye field-icon toggle-password"><img src="../images/icons/eye.png">
                            </span>
                        </div>
                        <small id="password-help" class="form-text text-muted"><span><?php echo $text; ?></span></small>
                    </div>
                    <div class="form-group login-checkbox">
                        <input type="checkbox" id="exampleCheck1" name="rememberme">
                        <label for="exampleCheck1">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" id="login-btn" name="submit">LOGIN</button>
                    <p class="text-center" id="not-account">Don't have an account?<a href="signup.php" style="text-decoration: none !important; color: #6255a5;">Sign Up</a></p>
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