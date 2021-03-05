<?php 
session_start();
include '../php/dbcon.php';

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
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Buyer_Request.php">Buyer Requests</a>
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
    <!--   dashboard   -->
    <div class="white_space"></div>
    <section class="dashboard_top">
        <div class="container">
            <div class="row">
                <div class="main_heading col-md-6 col-6">Dashboard</div>
                <div class="add_btn col-md-6 col-6">
                    <a href="add_notes.php" style="text-decoration: none;"><button type="button" class="btn btn-primary add_note_btn">ADD Note</button></a>
                </div>
            </div>
            <div class="row">
                <div class="boxes col-md-2">
                    <div class="earning_box">
                        <div class="earning_img text-center">
                            <img src="../images/icons/earning-icon.svg"><br>
                            <span class="heading">My Earning</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-4">
                    <div class="sold_box">
                        <div class="col-md-6 sold">
                            <span class="heading">100</span><br>
                            <span class="sub_heading">Numbers of Notes Sold</span>
                        </div>
                        <div class="myearning">
                            <span class="heading">$10,00,000</span><br>
                            <span class="sub_heading">Money Earned</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="download_box">
                        <span class="heading">38</span><br>
                        <span class="sub_heading">My Downloads</span>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="reject_box">
                        <span class="heading">12</span><br>
                        <span class="sub_heading">My Rejected Notes</span>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="request_box">
                        <span class="heading">102</span><br>
                        <span class="sub_heading">Buyer Requests</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--   dashboard table up  -->
    <section class="dashboard_table">
        <div class="container">
            <div class="row">
                <div class="heading col-md-4 col-sm-6 col-12">In Progress Notes</div>
                <div class="col-md-8 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-8">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-4 search_button">
                                <button type="button" class="btn btn-primary search_btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row booktable">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%">Added date</th>
                            <th scope="col" style="width: 30%">title</th>
                            <th scope="col" style="width: 20%">category</th>
                            <th scope="col" style="width: 20%">status</th>
                            <th scope="col" style="width: 20%">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                       <?php
                        
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        $page =mysqli_real_escape_string($con,$page);
                        $page = htmlentities($page);
                    }else{
                        $page = 1;
                    }
                    
                    $num_per_page = 05;
                    $start_from = ($page-1) * $num_per_page;
                        
                    $user = $_SESSION['id'];
                        
                        $selectquery = "SELECT sellernotes.CreatedDate as added_date, sellernotes.Title , notecategories.Name as category, referencedata.value as Status
                        FROM sellernotes, notecategories, referencedata
                        WHERE sellernotes.Category = notecategories.ID and sellernotes.Status=referencedata.ID AND sellernotes.SellerID=$user AND sellernotes.Status IN(6,7,8)ORDER BY sellernotes.CreatedDate DESC LIMIT $start_from,$num_per_page";
                        $select = mysqli_query($con,$selectquery);
                        
                        $numquery = "SELECT * FROM sellernotes WHERE Status IN ( 6, 7, 8) AND sellernotes.SellerID=$user";
                        $noquery = mysqli_query($con,$numquery);
                        $totalrecords = mysqli_num_rows($noquery);
                        $total_pages = ceil($totalrecords / $num_per_page);
                        
                        while($result = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                            <td><?php echo $result['added_date'];?></td>
                            <td><?php echo $result['Title'];?></td>
                            <td><?php echo $result['category'];?></td>
                            <td><?php echo $result['Status'];?></td>
                            <?php if($result['Status'] == "Draft"){
                                ?>
                                <td>
                                <a href="#" class="icon"><img src="../images/icons/edit.png"></a>
                                <a href="#" class="icon"><img src="../images/icons/delete.png"></a>
                                </td>
                                <?php
                            }else{
                                ?>
                                <td><a href="#" class="icon"><img src="../images/icons/eye.png"></a></td>
                                <?php
                            }
                                ?>
                            </tr>
                            <?php
                        }
                        
                        ?>
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
                    <li class="page-item <?php if($page == 1){ echo 'disabled'; }?>">
                        <a class="page-link page-link-icon" href="dashboard.php?page=<?php echo $page-1 ; ?>" aria-label="Previous">
                            <img src="../images/icons/left-arrow.png">
                        </a>
                    </li>
                    <?php
                    
                        for($i=1;$i<=$total_pages;$i++){
                            ?>
                            <li class="page-item"><a class="page-link <?php if($page == $i) { echo 'active'; }
                                ?> " href="dashboard.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a></li>
                            <?php
                        }
                    
                    ?>
                                
                    <li class="page-item <?php if($page == $total_pages){ echo 'disabled'; }?>">
                        <a class="page-link page-link-icon" href="dashboard.php?page=<?php echo $page+1 ; ?>" aria-label="Next">
                            <img src="../images/icons/right-arrow.png">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--   dashboard table down  -->
    <section class="dashboard_table">
        <div class="container">
            <div class="row">
                <div class="heading col-md-4 col-sm-6 col-12">Published Notes</div>
                <div class="col-md-8 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-7">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-5 search_button">
                                <button type="button" class="btn btn-primary search_btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row booktable">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%">Added date</th>
                            <th scope="col" style="width: 30%">title</th>
                            <th scope="col" style="width: 20%">category</th>
                            <th scope="col" style="width: 20%">sell type</th>
                            <th scope="col" style="width: 20%">price</th>
                            <th scope="col" style="width: 20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    <?php
                        
                        if(isset($_GET['page1'])){
                        $page1 = $_GET['page1'];
                        $page1 =mysqli_real_escape_string($con,$page1);
                        $page1 = htmlentities($page1);
                    }else{
                        $page1 = 1;
                    }
                    
                    $num_per_page1 = 05;
                    $start_from1 = ($page1-1) * $num_per_page1;
                        
                    $user = $_SESSION['id'];
                        
                    $selectquery1 = "SELECT sellernotes.CreatedDate as added_date,sellernotes.Title,notecategories.Name as category, sellernotes.IsPaid,sellernotes.SellingPrice FROM sellernotes , notecategories WHERE sellernotes.Category = notecategories.ID AND sellernotes.SellerID=$user AND sellernotes.Status=9 ORDER BY sellernotes.CreatedDate DESC LIMIT $start_from1,$num_per_page1";
                        $select1 = mysqli_query($con,$selectquery1);
                        
                        $numquery1 = "SELECT * FROM sellernotes WHERE Status=9 AND sellernotes.SellerID=$user";
                        $noquery1 = mysqli_query($con,$numquery1);
                        $totalrecords1 = mysqli_num_rows($noquery1);
                        $total_pages1 = ceil($totalrecords1 / $num_per_page1);
                        
                    while($result1 = mysqli_fetch_array($select1)){
                            ?>
                            <tr>
                            <td><?php echo $result1['added_date'];?></td>
                            <td><?php echo $result1['Title'];?></td>
                            <td><?php echo $result1['category'];?></td>
                            <td><?php  if($result1['IsPaid']){echo "Paid";}else{echo "Free";}?></td>
                            <td><?php echo $result1['SellingPrice'];?></td>
                            
                            <td><a href="#" class="icon"><img src="../images/icons/eye.png"></a></td>
                                <?php
                            }
                                ?>
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
                    <li class="page-item <?php if($page1 == 1){ echo 'disabled'; }?>">
                        <a class="page-link page-link-icon" href="dashboard.php?page1=<?php echo $page1-1 ; ?>" aria-label="Previous">
                            <img src="../images/icons/left-arrow.png">
                        </a>
                    </li>
                    <?php
                    
                        for($i=1;$i<=$total_pages1;$i++){
                            ?>
                            <li class="page-item"><a class="page-link <?php if($page1 == $i) { echo 'active'; }
                                ?> " href="dashboard.php?page1=<?php echo $i ; ?>"><?php echo $i ;?></a></li>
                            <?php
                        }
                    
                    ?>
                                
                    <li class="page-item <?php if($page1 == $total_pages1){ echo 'disabled'; }?>">
                        <a class="page-link page-link-icon" href="dashboard.php?page1=<?php echo $page1+1 ; ?>" aria-label="Next">
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