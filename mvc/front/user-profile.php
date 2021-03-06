<?php 
session_start();

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Notes Market Place-user profile</title>
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
            <a class="navbar-brand" href="home-page.html">
                <img src="../images/logo/top-logo1.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="search_page.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buyer_request.php">Buyer Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="user_img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/person/user-img.png"></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item active" href="user-profile.html">My Profile</a>
                            <a class="dropdown-item" href="myDownloads.html">My Downloads</a>
                            <a class="dropdown-item" href="my_sold_notes.html">My Sold Notes</a>
                            <a class="dropdown-item" href="my_rejected_notes.html">My Rejected Notes</a>
                            <a class="dropdown-item" href="change_pwd.html">Change Password</a>
                            <a class="dropdown-item" href="../php/logout.php"><span>LOGOUT</span></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="../php/logout.php" style="text-decoration: none;"><button type="button" class="btn btn-primary btn-lg btn-block btn_login">Logout</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- User Profile -->
    <div class="user-image m-top-100">
        <div class="user-text">
            <h1>User Profile</h1>
        </div>
    </div>

    <!-- User Form -->

    <div class="container form-wrap">
        <form>
            <div class="user-heading">
                <h3>Basic Profile Details</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">First Name *</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your first name" value="<?php echo $_SESSION['fname'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Last Name *</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your last name" value="<?php echo $_SESSION['lname'];?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Email *</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address" value="<?php echo $_SESSION['email'];?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Date Of Birth</label>
                    <input type="date" class="form-control" id="exampleInputDate" placeholder="Enter your date of birth">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Gender</label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect01">
                            <option selected>Select your gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Phone Number</label>
                    <div class="row">
                        <div class="col-md-3" style="width: 30%;">
                            <div class="input-group mb-3">
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option selected>+91</option>
                                    <option value="1">+92</option>
                                    <option value="2">+93</option>
                                    <option value="3">+96</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9" style="width: 70%; padding-left: 0;">
                            <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your phone number">
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
                        <input type="file" id="getFile" style="visibility: hidden;">
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
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your address">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Address Line 2</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your address">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">City *</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your city">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">State *</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your state">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">ZipCode *</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your zipcode">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Country *</label>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect01">
                            <option selected>Select your country</option>
                            <option value="1">India</option>
                            <option value="2">America</option>
                            <option value="3">Australia</option>
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
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your first name">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">College</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your last name">
                </div>
            </div>
            <button type="button" class="btn btn-primary " id="submit-btn-user">SUBMIT</button>
        </form>
    </div>
    <!--    footer  -->
    <hr>
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
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!--custom script-->
    <script type="text/javascript" src="../js/script.js"></script>

</body>

</html>