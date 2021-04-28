<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Notes Market Place-<?php echo $pagename ?></title>
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
    <!--Header-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top ">
            <a class="navbar-brand" href="dashboard.php">
                <img src="../images/logo/top-logo1.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php if($pagename=="Dashboard"){echo "active";}?>">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown <?php if($pagename=="Notes_Under_Review" or $pagename=="Published_Notes" or $pagename=="Downloaded_Notes" or $pagename=="Rejected_Notes"){echo "active";}?>">
                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>
                        <div class="dropdown-menu">
                            <a href="notes-under-review.php"><button class="dropdown-item <?php if($pagename=="Notes_Under_Review"){echo "active";}?>" type="button">Notes Under Review</button></a>
                            <a href="published-notes.php"><button class="dropdown-item <?php if($pagename=="Published_Notes"){echo "active";}?>" type="button">Published Notes</button></a>
                            <a href="downloaded-notes.php"><button class="dropdown-item <?php if($pagename=="Downloaded_Notes"){echo "active";}?>" type="button">Downloaded Notes</button></a>
                            <a href="rejected-notes.php"><button class="dropdown-item <?php if($pagename=="Rejected_Notes"){echo "active";}?>" type="button">Rejected Notes</button></a>
                        </div>
                    </li>
                    <li class="nav-item <?php if($pagename=="Members"){echo "active";}?>">
                        <a class="nav-link" href="members.php">Members</a>
                    </li>
                    <li class="nav-item dropdown <?php if($pagename=="Spam_Reports"){echo "active";}?>">
                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                        <div class="dropdown-menu">
                            <a href="spam-reports.php"><button class="dropdown-item <?php if($pagename=="Spam_Reports"){echo "active";}?>" type="button">Spam Reports</button></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?php if($pagename=="Manage_System_Config" or $pagename=="Manage_Admin" or $pagename=="Manage_Category" or $pagename=="Manage_Type" or $pagename=="Manage_Country"){echo "active";}?>">
                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                        <div class="dropdown-menu">
                           
                           <?php
                            
                            if($_SESSION['role']==1){
                                ?>
                                <a href="manage_system_configuration.php"><button class="dropdown-item <?php if($pagename=="Manage_System_Config"){echo "active";}?>" type="button">Manage System Configuration</button></a>
                                <a href="manage-administrator.php"><button class="dropdown-item <?php if($pagename=="Manage_Admin"){echo "active";}?>" type="button">Manage Administrator</button></a>
                                <?php
                            }
                            
                            ?>
                           
                            <a href="manage-category.php"><button class="dropdown-item <?php if($pagename=="Manage_Category"){echo "active";}?>" type="button">Manage Category</button></a>
                            <a href="manage-type.php"><button class="dropdown-item <?php if($pagename=="Manage_Type"){echo "active";}?>" type="button">Manage Type</button></a>
                            <a href="manage-country.php"><button class="dropdown-item <?php if($pagename=="Manage_Country"){echo "active";}?>" type="button">Manage Countries</button></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="user_img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php
                            $user = $_SESSION['id'];
                            $sel="select ProfilePicture from userprofile where Userid=$user";
                            $select=mysqli_query($con,$sel);
                            $sc =mysqli_num_rows($select);
                            $result = mysqli_fetch_assoc($select);
                            if($sc>0){
                            $path= $result['ProfilePicture'];
                            if(empty($path)){
                                echo ".."."/images/person/t1.jpg";
                            }
                            else{
                              echo $path;  
                            }
                            }
                            else{echo ".."."/images/person/t1.jpg";}
                            ?>"></a>
                        <div class="dropdown-menu">
                            <a href="update-profile.php"><button class="dropdown-item <?php if($pagename=="Update_Profile"){echo "active";}?>" type="button">Update Profile</button></a>
                            <a href="../front/change_pwd.php"><button class="dropdown-item" type="button">Change Password</button></a>
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