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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Notes Market Place - add notes</title>
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
                        <a class="nav-link" href="../front/search_page.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../front/dashboard.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../front/buyer_request.php">Buyer Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../front/faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../front/contact_us.html">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="user_img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/person/user-img.png"></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../front/user-profile.html">My Profile</a>
                            <a class="dropdown-item" href="../front/myDownloads.html">My Downloads</a>
                            <a class="dropdown-item" href="../front/my_sold_notes.html">My Sold Notes</a>
                            <a class="dropdown-item" href="../front/my_rejected_notes.html">My Rejected Notes</a>
                            <a class="dropdown-item" href="../front/change_pwd.html">Change Password</a>
                            <a class="dropdown-item" href="logout.php"><span>LOGOUT</span></a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" style="text-decoration: none;"><button type="button" class="btn btn-primary btn-lg btn-block btn_login">Logout</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Add Notes -->
    <div class="add-note-image m-top-100">
        <div class="user-text">
            <h1>Add Notes</h1>
        </div>
    </div>

    <!-- User Form -->

    <div class="container form-wrap">
        <form method="post"  action="">
            <div class="user-heading">
                <h3>Basic Note Details</h3>
            </div>
 <?php


$id = $_GET['id'];
$selectq = "select * from sellernotes where ID=$id";
$selectque = mysqli_query($con,$selectq);
$result = mysqli_fetch_array($selectque);


if(isset($_POST['update'])){
        $ids = $_GET['id'];
       $title= mysqli_real_escape_string($con,$_POST['title'] );
       $category= mysqli_real_escape_string($con,$_POST['category'] );
       $type= mysqli_real_escape_string($con,$_POST['type'] );
       $pages= mysqli_real_escape_string($con,$_POST['pages'] );
       $description= mysqli_real_escape_string($con,$_POST['description'] );
       $country= mysqli_real_escape_string($con,$_POST['country'] );
       $institution= mysqli_real_escape_string($con,$_POST['institution'] );
       $course= mysqli_real_escape_string($con,$_POST['course'] );
       $coursecode= mysqli_real_escape_string($con,$_POST['coursecode'] );
       $professor= mysqli_real_escape_string($con,$_POST['professor'] );
       $sellfor= mysqli_real_escape_string($con,$_POST['sellfor'] );
       $price= mysqli_real_escape_string($con,$_POST['price'] );
        
        $update = " update sellernotes set Title='$title', Category=$category, NoteType=$type, NumberofPages=$pages, Description='$description', Country=$country, UniversityName='$institution' , Course='$course', CourseCode='$coursecode', Professor='$professor', IsPaid=$sellfor , SellingPrice=$price, ModifiedDate=CURRENT_TIMESTAMP() where ID=$ids ";
        $updatequery = mysqli_query($con,$update);
    
        if($updatequery){
            ?>
            <script>
                alert("note details updated");
                location.replace("../front/dashboard.php");
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("note details not updated");
            </script>
            <?php
        }
    
    
        
}

?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Title *</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your notes title" name="title" required value="<?php echo $result['Title'];?>" >
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Category *</label>
                    <?php
                    $category = "select * from notecategories where IsActive=1";
                        $categoryquery = mysqli_query($con,$category);
                        $categoryrows = mysqli_num_rows($categoryquery);
                    ?>
                    <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect01" name="category" required>
                            <option value="">Select your category</option>
                            <?php
                            for($i=1;$i<=$categoryrows;$i++){
                                $categoryrow = mysqli_fetch_array($categoryquery);
                            ?>
                            <option value="<?php echo $categoryrow['ID'];?>" <?php if($categoryrow['ID']==$result['Category']){echo "selected";}?>><?php echo $categoryrow['Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Display Picture</label>
                    <div class="upload-custom">
                        <button >
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getdisplaypic" name="displaypic" style="border:none;width:70%;margin-left:-7%;" disabled>
                        <p class="text-center">Upload a picture</p>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Upload notes *</label>
                    <div class="upload-custom">
                        <button >
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getnote" name="uploadnote[]" style="border:none;width:70%;margin-left:-7%;"  required multiple disabled>
                        <p class="text-center">Upload your notes</p>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Type</label>
                    <?php
                    $type = "select * from notetypes where IsActive=1";
                        $typequery = mysqli_query($con,$type);
                        $typerows = mysqli_num_rows($typequery);
                    ?>
                    <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect01" name="type">
                            <option value="">Select your note type</option>
                            <?php
                            for($i=1;$i<=$typerows;$i++){
                                $typerow = mysqli_fetch_array($typequery);
                            ?>
                            <option value="<?php echo $typerow['ID'] ?>" <?php if($typerow['ID']==$result['NoteType']){echo "selected";}?>><?php echo $typerow['Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Number of Pages</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter number of pages" name="pages" value=<?php echo $result['NumberofPages']; ?>>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleInputfname">Description *</label>
                    <textarea class="form-control" id="exampleInputfname" placeholder="Enter your notes title" rows="5" required name="description"><?php echo $result['Description'] ?></textarea>
                </div>
            </div>
            <div class="user-heading">
                <h3>Institution Information</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Country *</label>
                    <?php
                    $country = "select * from countries where IsActive=1";
                        $countryquery = mysqli_query($con,$country);
                        $countryrows = mysqli_num_rows($countryquery);
                    ?>
                    <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect01" name="country" required>
                            <option value="">Select your country</option>
                            <?php
                            for($i=1;$i<=$countryrows;$i++){
                                $countryrow = mysqli_fetch_array($countryquery);
                            ?>
                            <option value="<?php echo $countryrow['ID'] ?>" <?php if($countryrow['ID']==$result['Country']){echo "selected";}?>><?php echo $countryrow['Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Institution Name</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your institution name" name="institution" value="<?php echo $result['UniversityName']; ?>">
                </div>
            </div>
            <div class="user-heading">
                <h3>Course Details</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Course Name</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your course name" name="course" value="<?php echo $result['Course']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Course Code</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your course code" name="coursecode" value="<?php echo $result['CourseCode']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Professor / Lecturer</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your professor name" name="professor" value="<?php echo $result['Professor']; ?>">
                </div>
            </div>
            <div class="user-heading">
                <h3>Selling Information</h3>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputfname">Sell For*</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sellfor" value="0" required <?php if($result['IsPaid']==0){echo "checked"; } ?>>
                            <label class="form-check-label" for="inlineRadio1" style="margin-left: 10px;">Free</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sellfor" id="inlineRadio2" value="1" <?php if($result['IsPaid']==1){echo "checked"; } ?>>
                            <label class="form-check-label" for="inlineRadio2" style="margin-left: 10px;">Paid</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputfname">Sell Price *</label>
                            <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your price" name="price" required value="<?php echo $result['SellingPrice']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Note Preview*</label>
                    <div class="upload-custom-add-notes">
                        <button>
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getpreview" name="preview" style="border:none;width:70%;margin-left:-7%;" required disabled>
                        <p class="text-center">Upload a file</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="submit-btn-user" name="update">Update</button>
            <div class="m-bottom-60">
            </div>
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
