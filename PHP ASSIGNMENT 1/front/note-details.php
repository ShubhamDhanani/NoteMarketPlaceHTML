<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Notes Market Place-note details</title>
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
                        <a class="nav-link" href="search_page.html">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Add_Notes.html">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Buyer_Request.html">Buyer Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_us.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="user_img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/person/user-img.png"></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="user-profile.html">My Profile</a>
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


    <!--    notes-details   -->
    <div class="white_space"></div>
    <section class="notes_details">
        <div class="container">
            <div class="row">
                <div class="col-md-12 small_heading">
                    Notes Details
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="book_left">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <img src="../images/books/computer-science.png">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <h2>Computer Science</h2>
                                <h5>Computer Science</h5>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum ab, vitae, quo neque, ut iure inventore id veritatis dicta omnis voluptatum quis voluptatibus .
                                </p>
                                <div class="download_button">
                                <?php if(isset($_SESSION['fname'])){
                                ?>
                                <button type="button" class="btn btn-primary btn_download" data-toggle="modal" data-target="#exampleModal">Download / $15</button>
                                <?php
                                }  ?>
                                <?php if(!isset($_SESSION['fname'])){
                                ?>
                                <button type="button" class="btn btn-primary btn_download" data-toggle="modal" data-target="#exampleModal" onclick="location.href = 'login.php';">Download / $15</button>
                                <?php
                                }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 book_right">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-4">
                            <div class="note-text-left">
                                <h5>Institution:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-8">
                            <div class="note-text-right">
                                <h5>University of California</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-left">
                                <h5>Course Name:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-right">
                                <h5>Computer Engineering</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-left">
                                <h5>Course Code:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-right">
                                <h5>248705</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-left">
                                <h5>Professor:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-right">
                                <h5>Mr. Richard Brown</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-left">
                                <h5>Number of Pages:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-right">
                                <h5>277</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-left">
                                <h5>Approved Date:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <div class="note-text-right">
                                <h5>November 25 2020</h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4">
                            <div class="note-text-left">
                                <h5>Rating:</h5>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6 col-8">
                            <div class="note-text-right">
                                <div class="rate" style="padding-left:20% !important; margin-top: -5px;">
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star3" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 star</label>
                                </div>
                                <h5>100 reviews</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <span class="col-md-12 red_text" style="padding-left:0;">
                            5 Users marked this note as inappropriate
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>

    <!--    notes-review and preview   -->
    <section class="notes_details_down">
        <div class="container">
            <div class="row">
                <div class="small_heading col-md-5 col-sm-12 col-12">
                    <h4>Notes Preview</h4>
                    <div class="col-md-12 book_left">
                        <iframe src="../images/sample.pdf">
                        </iframe>
                    </div>
                </div>
                <div class="small_heading col-md-7 col-sm-12 col-12">
                    <h4>Customer Reviews</h4>
                    <div class="col-md-12 book_right">
                        <div class="customer_img col-md-1 col-2">
                            <img src="../images/person/reviewer-1.png">
                        </div>
                        <div class="customer col-md-11 col-12">
                            Richard Brown<br><span class="down-rate">
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="far">☆</i>
                            </span><br>
                            <p class="customer_review"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum beatae, nemo culpa</p>
                        </div>
                        <hr>
                        <div class="customer_img col-md-1 col-2">
                            <img src="../images/person/reviewer-2.png">
                        </div>
                        <div class="customer col-md-11">
                            Alice Ortiaz<br><span class="down-rate">
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="far">☆</i>
                            </span><br>
                            <p class="customer_review"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum beatae, nemo culpa</p>
                        </div>
                        <hr>
                        <div class="customer_img col-md-1 col-2">
                            <img src="../images/person/reviewer-3.png">
                        </div>
                        <div class="customer col-md-11">
                            Sara Passmore<br><span class="down-rate">
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="fas">★</i>
                                <i class="far">☆</i>
                            </span><br>
                            <p class="customer_review"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum beatae, nemo culpa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-close">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal_img text-center">
                        <img src="../images/icons/SUCCESS.png"><br>
                        <span class="modal_heading text-center">Thank you for purchasing!</span>
                    </div>
                    <div class="modal_inside">
                        <span class="title">Dear Smith,</span>
                        <p class="modal_text">As this is paid notes - you need to pay to seller Rahil Shah offline. We will send him an email that you want to download this note. He may contact you further for payment process completion.</p>
                        <p class="modal_text">In case, you have urgency,<br>
                            Please contact us on +9195377345959.</p>
                        <p class="modal_text">Once he receives the payment and acknowledge us - selected notes you can see over my download tab for download.</p>
                        <p class="modal_text">Have a good day.</p>
                    </div>
                </div>
            </div>
        </div>
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