<?php 
session_start();

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
?>
<?php
include '../php/dbcon.php';
include '../src/mail.php';

if(isset($_POST['save'])){
       $title= mysqli_real_escape_string($con,$_POST['title'] );
       $category= mysqli_real_escape_string($con,$_POST['category'] );
       $displaypic= $_FILES['displaypic'];
       $uploadnote= $_FILES['uploadnote'];
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
       $preview= $_FILES['preview'];
    
        $_SESSION['title'] = $title;
        $_SESSION['category'] = $category;
        $_SESSION['displaypic'] = $displaypic;
        $_SESSION['uploadnote'] = $uploadnote;
        $_SESSION['type'] = $type;
        $_SESSION['pages'] = $pages;
        $_SESSION['description'] = $description;
        $_SESSION['country'] = $country;
        $_SESSION['institution'] = $institution;
        $_SESSION['course'] = $course;
        $_SESSION['coursecode'] = $coursecode;
        $_SESSION['professor'] = $professor;
        $_SESSION['sellfor'] = $sellfor;
        $_SESSION['preview'] = $preview;
    
    if($sellfor==0){
        $price = 0;
    }
        $_SESSION['price'] = $price;
        
        $user = $_SESSION['id'];
    
        $displaypicname = $displaypic['name'];
        $displaypic_ext = explode('.',$displaypicname);
        $displaypic_ext_check = strtolower(end($displaypic_ext));
        $valid_displaypic_ext = array('png','jpg','jpeg');
        $displaypicnewname = "DP_".date("dmyhis").'.'.$displaypic_ext_check;
        
    
        $previewname = $preview['name'];
        $preview_ext = explode('.',$previewname);
        $preview_ext_check = strtolower(end($preview_ext));
        $valid_preview_ext = array('pdf');
        $previewnewname = "Preview_".date("dmyhis").'.'.$preview_ext_check;
    
        $countfiles = count($uploadnote['name']);
        for($i=0;$i<$countfiles;$i++){
        $uploadnotename = $uploadnote['name'][$i];
        $uploadnote_ext = explode('.',$uploadnotename);
        $uploadnote_ext_check = strtolower(end($uploadnote_ext));
        $valid_uploadnote_ext = array('pdf');
        }
    
        if(in_array($displaypic_ext_check,$valid_displaypic_ext) && in_array($preview_ext_check,$valid_preview_ext) && in_array($uploadnote_ext_check,$valid_uploadnote_ext)){
            
            $insertquery = "INSERT INTO sellernotes(SellerID, Status,ActionedBy,Title,Category,DisplayPicture, NoteType, NumberofPages, Description, UniversityName,Country, Course, CourseCode, Professor, IsPaid, SellingPrice,NotesPreview,CreatedBy,ModifiedBy) VALUES ('$user','6','$user','$title','$category','$displaypicnewname','$type','$pages','$description','$institution','$country','$course','$coursecode','$professor',$sellfor,'$price','$previewnewname','$user','$user')";
       $iquery= mysqli_query($con,$insertquery);
        $noteid = mysqli_insert_id($con);
            $_SESSION['noteid'] = $noteid;
            $_SESSION['notetitle'] = $title;
    
        $displaypicpath = $displaypic['tmp_name'];
        if(!is_dir("'../Member/'.$user.'/'.$noteid.'/'")){
            echo "dir not exist";
            mkdir("../Member/".$user."/".$noteid."/",0777,true);
        }
        $displaypic_dest = '../Member/'.$user.'/'.$noteid.'/'.$displaypicnewname;
        move_uploaded_file($displaypicpath,$displaypic_dest);
    
        $previewpath = $preview['tmp_name'];
        $preview_dest = '../Member/'.$user.'/'.$noteid.'/'.$previewnewname;
        move_uploaded_file($previewpath,$preview_dest);
            
            
        for($i=0;$i<$countfiles;$i++){
        
            $uploadnotenewname = "Attachment_[$i]_".date("dmyhis").'.'.$uploadnote_ext_check;
        $uploadnotepath = $uploadnote['tmp_name'];
    
        
        if(!is_dir("'../Member/'.$user.'/'.$noteid.'/Attachment'.'/'")){
            echo "dir not exist";
            mkdir("../Member/".$user."/".$noteid."/Attachment"."/",0777,true);
        }
        $uploadnote_dest = '../Member/'.$user.'/'.$noteid.'/Attachment'.'/'.$uploadnotenewname;
        move_uploaded_file($uploadnotepath[$i],$uploadnote_dest);
            
            
        
                $insertquery1 ="INSERT INTO sellernotesattachements(NoteID, FileName, FilePath,CreatedBy, ModifiedBy) VALUES ('$noteid','$uploadnotenewname','$uploadnote_dest','$user','$user')";
                $iquery1= mysqli_query($con,$insertquery1);
                $attachmentid = mysqli_insert_id($con);
            
        }
                
                        if($iquery && $iquery1){
                        ?>
                        <script>
                            alert("data inserted");
                        </script>
                        <?php
                        }
                    else{
                        ?>
                        <script>
                            alert("data not inserted");
                        </script>
                        <?php
                    }
           
            
        
        }
        else{
            ?>
<script>
    alert("Display pic should be in jpeg,jpg,png formate only && Preview note,Uploadnote should be in pdf formate");

</script>
<?php
        }      
}

if(isset($_POST['publish'])){
?>
<script>
    if (confirm('Do You want to publish this book?')) {
        <?php 
    $noteid = $_SESSION['noteid'];
    $title = $_SESSION['notetitle'];
    $seller = $_SESSION['fname'];
    $query2 = "UPDATE sellernotes SET Status = 7 WHERE ID =$noteid";
    $uquery = mysqli_query($con, $query2);
    
    
    $mail->setFrom($config_email, 'NotesMarketPlace');  // This email address and name will be visible as sender of email

    $mail->addAddress('sndhanani43@gmail.com', 'Receiver name');  // This email is where you want to send the email
    $mail->addReplyTo($config_email, 'Sender name');   // If receiver replies to the email, it will be sent to this email address
 
    // Setting the email content
    $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
    $mail->Subject = "varification of NotesMarketPlace account";       //subject line of email
    $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
        <thead>
            <th>
                <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
            </th>
        </thead>
        <tbody>
            <br>
            <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                <td class='text-1'>New Note Published</td>
            </tr>
            <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                <td class='text-2'>Hello Admin,</td>
            </tr>
            <tr style='height: 60px;'>
                <td class='text-3'>
                        We want to inform you that, <b> $seller </b> sent his note <br>
                      <b> $title </b> for review. Please look at the notes and take required actions.
                </td>
            </tr>
            <tr style='height: 60px;'>
                <td class='text-3'>
                    Regards <br>
                    NotesMarketPlace
                </td>
            </tr>
        </tbody>
    </table>";   //Email body
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email
 
    $mail->send();
    }
    ?>
        </script>
}
<?php
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
                        <a class="nav-link" href="search_page.html">Search Notes</a>
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
                        <a class="nav-link" href="contact_us.html">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="user_img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/person/user-img.png"></a>
                        <div class="dropdown-menu">
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

    <!-- Add Notes -->
    <div class="add-note-image m-top-100">
        <div class="user-text">
            <h1>Add Notes</h1>
        </div>
    </div>

    <!-- User Form -->

    <div class="container form-wrap">
        <form method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <div class="user-heading">
                <h3>Basic Note Details</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Title *</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your notes title" name="title" required <?php if(isset($_POST['save'])){                  echo "value="."'".$_SESSION['title']."'" ; }?> >
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
                            <option value="<?php echo $categoryrow['ID'];?>" <?php if(isset($_POST['save'])){if($categoryrow['ID']==$_SESSION['category']){echo "selected";}}?>><?php echo $categoryrow['Name'] ?></option>
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
                        <button onclick="document.getElementById('getdisplaypic').click()">
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getdisplaypic" name="displaypic" style="border:none;width:70%;margin-left:-7%;" <?php if(isset($_POST['save'])){                  echo "disabled" ; }?>>
                        <p class="text-center">Upload a picture</p>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Upload notes *</label>
                    <div class="upload-custom">
                        <button onclick="document.getElementById('getnote').click()">
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getnote" name="uploadnote[]" style="border:none;width:70%;margin-left:-7%;" <?php if(isset($_POST['save'])){                  echo "disabled" ; }?>  required multiple>
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
                            <option value="<?php echo $typerow['ID'] ?>" <?php if(isset($_POST['save'])){if($typerow['ID']==$_SESSION['type']){echo "selected";}}?>><?php echo $typerow['Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Number of Pages</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter number of pages" name="pages" <?php if(isset($_POST['save'])){                  echo "value="."'".$_SESSION['pages']."'" ; }?>>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleInputfname">Description *</label>
                    <textarea class="form-control" id="exampleInputfname" placeholder="Enter your notes title" rows="5" required name="description"><?php if(isset($_POST['save'])){                  echo $_SESSION['description']; }?></textarea>
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
                            <option value="<?php echo $countryrow['ID'] ?>" <?php if(isset($_POST['save'])){if($countryrow['ID']==$_SESSION['country']){echo "selected";}}?>><?php echo $countryrow['Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Institution Name</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your institution name" name="institution" <?php if(isset($_POST['save'])){                  echo "value="."'".$_SESSION['institution']."'" ; }?>>
                </div>
            </div>
            <div class="user-heading">
                <h3>Course Details</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Course Name</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your course name" name="course" <?php if(isset($_POST['save'])){                  echo "value="."'".$_SESSION['course']."'" ; }?>>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Course Code</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your course code" name="coursecode" <?php if(isset($_POST['save'])){                  echo "value="."'".$_SESSION['coursecode']."'" ; }?>>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Professor / Lecturer</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your professor name" name="professor" <?php if(isset($_POST['save'])){                  echo "value="."'".$_SESSION['professor']."'" ; }?>>
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
                            <input class="form-check-input" type="radio" name="sellfor" value="0" required <?php if(isset($_POST['save'])){if($_SESSION['sellfor']==0){echo "checked"; } }?>>
                            <label class="form-check-label" for="inlineRadio1" style="margin-left: 10px;">Free</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sellfor" id="inlineRadio2" value="1" <?php if(isset($_POST['save'])){if($_SESSION['sellfor']==1){echo "checked"; } }?>>
                            <label class="form-check-label" for="inlineRadio2" style="margin-left: 10px;">Paid</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputfname">Sell Price *</label>
                            <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your price" name="price" required <?php if(isset($_POST['save'])){                  echo "value="."'".$_SESSION['price']."'" ; }?>>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Note Preview*</label>
                    <div class="upload-custom-add-notes">
                        <button onclick="document.getElementById('getpreview').click()">
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getpreview" name="preview" style="border:none;width:70%;margin-left:-7%;" required <?php if(isset($_POST['save'])){                  echo "disabled" ; }?>>
                        <p class="text-center">Upload a file</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="submit-btn-user" name="save" <?php if(isset($_POST['save'])){echo "disabled";}?>>SAVE</button>
            <button type="submit" class="btn btn-primary btn-right" name="publish" id="submit-btn-user" <?php if(!isset($_POST['save'])){echo "disabled";}?> >PUBLISH</button>
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
