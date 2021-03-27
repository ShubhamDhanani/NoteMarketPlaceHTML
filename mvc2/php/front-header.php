   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Notes Market Place-<?php echo $pagename;?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/icons/favicon.ico">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!--bootstrap css-->
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/datatable.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!--Responsive CSS-->
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>
   <?php if($pagename=="Home"){
    if(!isset($_SESSION['fname'])){
        ?>
        <section id="nav-bar" class="home_navbar">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="#">
                <img class="logo" src="../images/logo/top-logo1.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_notes.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" style="text-decoration: none;"><button type="button" class="btn btn-primary btn-lg btn-block btn_login">Login</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <?php
    }
    else{
        ?>
    <section id="nav-bar" class="home_navbar">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="#">
                <img class="logo" src="../images/logo/top-logo1.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sellnotes.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Buyer_Request.php">Buyer Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="user_img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php
                            $user = $_SESSION['id'];
                            $sel="select ProfilePicture from userprofile where Userid=$user";
                            $select=mysqli_query($con,$sel);
                            $sc =mysqli_num_rows($select);
                            $result = mysqli_fetch_assoc($select);
                            if($sc>0){
                            $path= $result['ProfilePicture'];
                            echo $path;}
                            else{echo ".."."/images/person/t1.jpg";}
                            ?>"></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="user-profile.php">My Profile</a>
                            <a class="dropdown-item" href="myDownloads.php">My Downloads</a>
                            <a class="dropdown-item" href="my_sold_notes.php">My Sold Notes</a>
                            <a class="dropdown-item" href="my_rejected_notes.php">My Rejected Notes</a>
                            <a class="dropdown-item" href="change_pwd.php">Change Password</a>
                            <a class="dropdown-item" href="../php/logout.php"><span>LOGOUT</span></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="../php/logout.php" style="text-decoration: none;"><button type="button" class="btn btn-primary btn-lg btn-block btn_login">Logout</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <?php
    }
    ?>
<?php 
}
    else{
        if(!isset($_SESSION['fname'])){
        ?>
        <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand" href="home-page.php">
                <img src="../images/logo/top-logo1.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php if($pagename=="SearchNotes"){echo "active";}?>">
                        <a class="nav-link" href="search.php">Search Notes</a>
                    </li>
                    <li class="nav-item <?php if($pagename=="SellNotes"){echo "active";}?>">
                        <a class="nav-link" href="sellnotes.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item" <?php if($pagename=="FAQ"){echo "active";}?>>
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item" <?php if($pagename=="ContactUs"){echo "active";}?>>
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" style="text-decoration: none;"><button type="button" class="btn btn-primary btn-lg btn-block btn_login">Login</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php
    }
    else{
        ?>
        <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand" href="home-page.php">
                <img src="../images/logo/top-logo1.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php if($pagename=="SearchNotes"){echo "active";}?>">
                        <a class="nav-link" href="search.php">Search Notes</a>
                    </li>
                    <li class="nav-item <?php if($pagename=="SellNotes"){echo "active";}?>">
                        <a class="nav-link" href="sellnotes.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item <?php if($pagename=="BuyerRequests"){echo "active";}?>">
                        <a class="nav-link" href="Buyer_Request.php">Buyer Requests</a>
                    </li>
                    <li class="nav-item <?php if($pagename=="FAQ"){echo "active";}?>">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item <?php if($pagename=="ContactUs"){echo "active";}?>">
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="user_img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php
                            $user = $_SESSION['id'];
                            $sel="select ProfilePicture from userprofile where Userid=$user";
                            $select=mysqli_query($con,$sel);
                            $sc =mysqli_num_rows($select);
                            $result = mysqli_fetch_assoc($select);
                            if($sc>0){
                            $path= $result['ProfilePicture'];
                            echo $path;}
                            else{echo ".."."/images/person/t1.jpg";}
                            ?>"></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item <?php if($pagename=="Profile"){echo "active";}?>" href="user-profile.php">My Profile</a>
                            <a class="dropdown-item <?php if($pagename=="MyDownloads"){echo "active";}?>" href="myDownloads.php">My Downloads</a>
                            <a class="dropdown-item <?php if($pagename=="MySoldNotes"){echo "active";}?>" href="my_sold_notes.php">My Sold Notes</a>
                            <a class="dropdown-item <?php if($pagename=="MyRejectedNotes"){echo "active";}?>" href="my_rejected_notes.php">My Rejected Notes</a>
                            <a class="dropdown-item <?php if($pagename=="ChangePassword"){echo "active";}?>" href="change_pwd.php">Change Password</a>
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
        <?php
    }
    ?>
<?php    }
    
?>
    
        
        
        