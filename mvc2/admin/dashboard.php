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
    <title>Notes Market Place-dashboard</title>
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
        <nav class="navbar navbar-expand-lg navbar-light fixed-top ">
            <a class="navbar-brand" href="../home-page.html">
                <img src="../images/logo/top-logo1.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.html">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>
                        <div class="dropdown-menu">
                            <a href="notes-under-review.html"><button class="dropdown-item" type="button">Notes Under Review</button></a>
                            <a href="published-notes.html"><button class="dropdown-item" type="button">Published Notes</button></a>
                            <a href="downloaded-notes.html"><button class="dropdown-item" type="button">Downloaded Notes</button></a>
                            <a href="rejected-notes.html"><button class="dropdown-item" type="button">Rejected Notes</button></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="members.html">Members</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                        <div class="dropdown-menu">
                            <a href="spam-reports.html"><button class="dropdown-item" type="button">Spam Reports</button></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="user_img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/person/user-img.png"></a>
                        <div class="dropdown-menu">
                            <a href="myProfile.html"><button class="dropdown-item" type="button">Update Profile</button></a>
                            <a href="../change_pwd.html"><button class="dropdown-item" type="button">Change Password</button></a>
                            <a href="../php/logout.php"><button class="dropdown-item" type="button"><span>LOGOUT</span></button></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="../php/logout.php" style="text-decoration: none;"><button type="button" class="btn btn-primary btn-lg btn-block btn_login">Logout</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--   dashboard   -->
    <div class="white_space"></div>
    <section class="dashboard_top">
        <div class="container">
            <div class="row">
                <div class="main_heading col-md-6">Dashboard</div>
            </div>
            <div class="row">
                <div class="boxes col-md-4">
                    <div class="for_publish_box">
                        <div class="col-md-12 sold">
                            <span class="heading">20</span><br>
                            <span class="sub_heading">Numbers of Notes in Review for Publish</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-4">
                    <div class="new_downloaded_box-admin" id="middle-box">
                        <div class="col-md-12 sold">
                            <span class="heading">103</span><br>
                            <span class="sub_heading">Numbers of New Notes Downloaded<br>(Last 7 days)</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-4">
                    <div class="new_registration_box">
                        <span class="heading">223</span><br>
                        <span class="sub_heading">Numbers of New Registration(last 7 days)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--   dashboard table up  -->
    <section class="dashboard_table">
        <div class="container">
            <div class="row">
                <div class="heading col-md-4 col-12">Published Notes</div>
                <div class="search col-md-8 col-12">
                    <div class="search-note">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-8">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-4 search_button">
                                <button type="button" class="btn btn-primary searc_btn">Search</button>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="btn-group select-month" style="float:center;">
                                    <button type="button" class="btn btn-light dropdown-toggle" id="dropdown_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 40px; background: none;">
                                        Select Month
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" type="button">January</button>
                                        <button class="dropdown-item" type="button">February</button>
                                        <button class="dropdown-item" type="button">March</button>
                                        <button class="dropdown-item" type="button">April</button>
                                        <button class="dropdown-item" type="button">May</button>
                                        <button class="dropdown-item" type="button">June</button>
                                        <button class="dropdown-item" type="button">July</button>
                                        <button class="dropdown-item" type="button">August</button>
                                        <button class="dropdown-item" type="button">September</button>
                                        <button class="dropdown-item" type="button">October</button>
                                        <button class="dropdown-item" type="button">November</button>
                                        <button class="dropdown-item" type="button">December</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row booktable">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">SR NO.</th>
                            <th scope="col" style="width: 15%;">TITLE</th>
                            <th scope="col" style="width: 10%;">category</th>
                            <th scope="col" style="width: 10%;">Attachment size</th>
                            <th scope="col" style="width: 10%;">sell type</th>
                            <th scope="col" style="width: 10%;">price</th>
                            <th scope="col" style="width: 20%;">publisher</th>
                            <th scope="col" style="width: 20%;">published date</th>
                            <th scope="col" style="width: 10%;">Number of downloads</th>
                            <th scope="col" style="width: 5%;"></th>
                        </tr>    
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="purple_text">Data Science</td>
                            <td>Science</td>
                            <td>10 KB</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>Pritesh Panchal</td>
                            <td>09-10-2020, 10:10</td>
                            <td class="purple_text">10</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Notes</button>
                                    <button class="dropdown-item" type="button">View More Details</button>
                                    <button class="dropdown-item" type="button">Unpublish</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="purple_text">Accounts</td>
                            <td>Commerce</td>
                            <td>23 MB</td>
                            <td>Paid</td>
                            <td>$22</td>
                            <td>Rahil Shah</td>
                            <td>10-10-2020, 12:30</td>
                            <td class="purple_text">21</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                    <button class="dropdown-item" type="button">View More Details</button>
                                    <button class="dropdown-item" type="button">Unpublish</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="purple_text">Social Studies</td>
                            <td>Social</td>
                            <td>3 MB</td>
                            <td>Paid</td>
                            <td>$56</td>
                            <td>Anish Patel</td>
                            <td>11-10-2020, 01:00</td>
                            <td class="purple_text">13</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                    <button class="dropdown-item" type="button">View More Details</button>
                                    <button class="dropdown-item" type="button">Unpublish</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="purple_text">AI</td>
                            <td>IT</td>
                            <td>1 MB</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>Vijay Vaishnav</td>
                            <td>12-10-2020, 10:10</td>
                            <td class="purple_text">34</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                    <button class="dropdown-item" type="button">View More Details</button>
                                    <button class="dropdown-item" type="button">Unpublish</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td class="purple_text">Lorem ipsum</td>
                            <td>Lorem</td>
                            <td>105 KB</td>
                            <td>Paid</td>
                            <td>$90</td>
                            <td>Mehul Patel</td>
                            <td>13-10-2020, 11:25</td>
                            <td class="purple_text">9</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                    <button class="dropdown-item" type="button">View More Details</button>
                                    <button class="dropdown-item" type="button">Unpublish</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--    Pagination   -->
    <section class="pages">
        <div class="container">
            <div class="row">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link page-link-icon" href="#" aria-label="Previous">
                            <img src="../images/icons/left-arrow.png">
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link page-link-icon" href="#" aria-label="Next">
                            <img src="../images/icons/right-arrow.png">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
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