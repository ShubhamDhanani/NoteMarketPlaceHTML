<?php 
session_start();
include '../php/dbcon.php';
$pagename= "ChangePassword";

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}

$dbpass = $_SESSION['password'];

if(isset($_POST['submit'])){
    $oldpass= mysqli_real_escape_string($con,$_POST['oldpass'] );
    $newpass= mysqli_real_escape_string($con,$_POST['newpass'] );
    $cpass= mysqli_real_escape_string($con,$_POST['cpass'] );
    
    $pass_decode = password_verify($oldpass, $dbpass);
    $id = $_SESSION['id'];
    if($pass_decode){
        if($newpass==$cpass){
            $sec_pass= password_hash($newpass, PASSWORD_BCRYPT);
            $updatequery= "UPDATE users SET Password='$sec_pass' WHERE ID=$id AND IsActive=1";
            $update= mysqli_query($con,$updatequery);
            
            if($update){
                ?>
                <script>
                    alert("Your Password Changed Successfully");
                </script>
                <script>location.replace("login.php");</script>
                <?php
            }
            
        }else{
            ?>
            <script>
                alert("Your ConfirmPassword Not Matched");
            </script>
            <?php
        }
        
    }else{
        ?>
        <script>
            alert("Your Old Password is 'InCorrect'");
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
    <title>Notes Market Place-change password</title>
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
                        <h4 class="text-center">Change Password</h4>
                        <p class="text-center">Enter your new password to change your password</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Old Password</label>
                        <div class="inputContainer">
                            <input type="password" id="old-password-field" class="form-control" placeholder="Password" name="oldpass" required>
                            <span toggle="#old-password-field" class="eye field-icon toggle-password"><img src="../images/icons/eye.png">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <div class="inputContainer">
                            <input type="password" id="new-password-field" class="form-control" placeholder="Password" name="newpass" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="Password shoud have atlest one capital,small,special character,number and 6 to 24 character long" required>
                            <span toggle="#new-password-field" class="eye field-icon toggle-password"><img src="../images/icons/eye.png">
                            </span>
                        </div>
                    </div>
                    <div class="form-group m-bottom-30">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <div class="inputContainer">
                            <input type="password" id="confirm-password-field" class="form-control" placeholder="Password" name="cpass" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="Confirm Password shoud have atlest one capital,small,special character,number and 6 to 24 character long" required>
                            <span toggle="#confirm-password-field" class="eye field-icon toggle-password"><img src="../images/icons/eye.png">
                            </span>
                        </div>
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