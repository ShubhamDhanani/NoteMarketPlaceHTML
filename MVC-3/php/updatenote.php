<?php 
session_start();
include '../php/dbcon.php';
include '../src/mail.php';
$pagename = "UpdateNote";
if(isset($_GET['id'])){
$id = $_GET['id'];
$_SESSION['noteid']=$id;
}


if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
$noteid = $_SESSION['noteid'];
$selectq = "select * from sellernotes where ID=$noteid";
$selectque = mysqli_query($con,$selectq);
$resu = mysqli_fetch_array($selectque);
$selfile = mysqli_query($con,"select * from sellernotesattachements where NoteID=$noteid");
$res = mysqli_fetch_assoc($selfile);
echo $resu['Title']."<br>";
echo $resu['Title']."<br>";
echo $resu['Title']."<br>";
echo $resu['Title']."<br>";
echo $resu['Title']."<br>";
echo $resu['Title']."<br>";
echo $resu['Title']."<br>";
echo $resu['Title']."<br>";


if(isset($_POST['update'])){
        $noteid = $_SESSION['noteid'];
        $user = $_SESSION['id'];
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
       $displaypic= $_FILES['displaypic'];
       $uploadnote= $_FILES['uploadnote'];
       $preview= $_FILES['preview'];
    
        if(!$type){
            $type = 4;
        }
        if(!$pages OR !is_numeric($pages)){
            $pages = "NA";
        }
        if(!$institution){
            $institution = "NA";
        }
        if(!$course){
            $course = "NA";
        }
        if(!$coursecode){
            $coursecode = "NA";
        }
        if(!$professor){
            $professor = "NA";
        }

        if($sellfor==5){
            $price = 0;
        }
    
        $displaypicname = $displaypic['name'];
        if($displaypicname!==""){            
            $displaypic_ext = explode('.',$displaypicname);
            $displaypic_ext_check = strtolower(end($displaypic_ext));
            $valid_displaypic_ext = array('png','jpg','jpeg');
            
            if(in_array($displaypic_ext_check,$valid_displaypic_ext)){
                
            $file1 = '../Member/'.$user.'/'.$noteid.'/'.$resu['DisplayPicture'];
            unlink($file1);
            $displaypicnewname = "DP_".date("dmyhis").'.'.$displaypic_ext_check;
            $displaypic_dest = '../Member/'.$user.'/'.$noteid.'/'.$displaypicnewname;
            $displaypicpath = $displaypic['tmp_name'];
            move_uploaded_file($displaypicpath,$displaypic_dest);
            
            $updatedp = mysqli_query($con,"update sellernotes set DisplayPicture='$displaypicnewname',ModifiedDate=current_timestamp(),ModifiedBy=$user where ID=$noteid");  
                
            }
            else{
                ?>
                <script>
                    alert("Display Profile Pic must be in jpg,jpeg,png format");
                </script>
                <?php
            }
            
        }
        
        $previewname = $preview['name'];
        if($previewname!==""){
            $preview_ext = explode('.',$previewname);
            $preview_ext_check = strtolower(end($preview_ext));
            $valid_preview_ext = array('pdf');
            
            if(in_array($preview_ext_check,$valid_preview_ext)){
                
            $file2 = '../Member/'.$user.'/'.$noteid.'/'.$resu['NotesPreview'];
            unlink($file2);    
            $previewnewname = "Preview_".date("dmyhis").'.'.$preview_ext_check;
            $previewpath = $preview['tmp_name'];
            $preview_dest = '../Member/'.$user.'/'.$noteid.'/'.$previewnewname;
                move_uploaded_file($previewpath,$preview_dest);
                $updatepn = mysqli_query($con,"update sellernotes set NotesPreview='$previewnewname',ModifiedDate=current_timestamp(),ModifiedBy=$user where ID=$noteid");
                
            }
            else{
                ?>
                <script>
                    alert("Preview Note must be in pdf format");
                </script>
                <?php
            }
            
        }
    
        $uploadnotename = $uploadnote['name'][0];
        if($uploadnotename!==""){
            
            $countfiles = count($uploadnote['name']);
            for($i=0;$i<$countfiles;$i++){
            $uploadnotename = $uploadnote['name'][$i];
            $uploadnote_ext = explode('.',$uploadnotename);
            $uploadnote_ext_check = strtolower(end($uploadnote_ext));
            $valid_uploadnote_ext = array('pdf');
            if(in_array($uploadnote_ext_check,$valid_uploadnote_ext)){$v=1;}
            else{$vn=1;}
            }
            if($vn!==1){
                $file3 = '../Member/'.$user.'/'.$noteid.'/Attachment/'.$res['FileName'];
                unlink($file3);
            }
            else{}
            
            
            
            if($countfiles>1 and $v==1 and $vn!==1){
            $zip = new ZipArchive();
            $zip_name = "../Member/$user/$noteid/Attachment/"."Attachment_".date('dmyhis').".zip";
            $uploadnotenewname = "Attachment_".date('dmyhis').".zip";
            // Create a zip target
            if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
            ?>
            <script>
                alert("Sorry ZIP creation is not working currently");
            </script>
            <?php
        }
        for($i=0;$i<$countfiles;$i++) {
        
            if ($_FILES['uploadnote']['tmp_name'][$i] == '') {
                continue;
            }
            
            // Moving files to zip.
            $zip->addFromString($_FILES['uploadnote']['name'][$i], file_get_contents($_FILES['uploadnote']['tmp_name'][$i]));
            
        }
        $zip->close();
        
        // Create HTML Link option to download zip
        $success = basename($zip_name);
        $uploadnote_dest= $zip_name;
        
        
            $updatenote = mysqli_query($con,"UPDATE sellernotesattachements set FileName='$uploadnotenewname',FilePath='$uploadnote_dest',ModifiedDate=current_timestamp(),ModifiedBy=$user where NoteID=$noteid");
        
        }
        elseif($countfiles==1 and $v==1 and $vn!==1){
        for($i=0;$i<$countfiles;$i++){
        
        $uploadnotenewname = "Attachment_[$i]_".date("dmyhis").'.'.$uploadnote_ext_check;
        $uploadnotepath = $uploadnote['tmp_name'];
    
        
        $uploadnote_dest = '../Member/'.$user.'/'.$noteid.'/Attachment'.'/'.$uploadnotenewname;
        move_uploaded_file($uploadnotepath[$i],$uploadnote_dest);
            
        }
        }
        else{
                ?>
                <script>
                    alert("Upload Note must be in pdf format");
                </script>
                <?php
            }
            
        }
    
        
        $update = " update sellernotes set Title='$title', Category=$category, NoteType=$type, NumberofPages=$pages, Description='$description', Country=$country, UniversityName='$institution' , Course='$course', CourseCode='$coursecode', Professor='$professor', IsPaid=$sellfor , SellingPrice=$price,ModifiedDate=current_timestamp(),ModifiedBy=$user where ID=$noteid ";
        $updatequery = mysqli_query($con,$update);
    
        if($updatequery){
            ?>
            <script>
                alert("note details updated");
                location.replace("../front/sellnotes.php");
            </script>
            
            <?php
            $seller = $_SESSION['fname'];
            $query2 = "UPDATE sellernotes SET Status = 7 WHERE ID =$noteid";
            $uquery = mysqli_query($con, $query2);


            $mail->setFrom($config_email, 'NotesMarketPlace'); // This email address and name will be visible as sender of email

            $mail->addAddress('sndhanani43@gmail.com', 'Receiver name'); // This email is where you want to send the email
            $mail->addReplyTo($config_email, 'Sender name'); // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
            $mail->Subject = "varification of NotesMarketPlace account"; //subject line of email
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
            </table>"; //Email body
            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

            $mail->send();
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

<!DOCTYPE html>
<html lang="en">

<?php
    include '../php/front-header.php';
?>

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
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your notes title" name="title" required value="<?php echo $resu['Title'];?>" >
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
                            <option value="<?php echo $categoryrow['ID'];?>" <?php if($categoryrow['ID']==$resu['Category']){echo "selected";}?>><?php echo $categoryrow['Name'] ?></option>
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
                        <input type="file" id="getdisplaypic" name="displaypic" style="border:none;width:70%;margin-left:-7%;" >
                        <p class="text-center">Upload a picture</p>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Upload notes </label>
                    <div class="upload-custom">
                        <button >
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getnote" name="uploadnote[]" style="border:none;width:70%;margin-left:-7%;" multiple>
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
                            <option value="<?php echo $typerow['ID'] ?>" <?php if($typerow['ID']==$resu['NoteType']){echo "selected";}?>><?php echo $typerow['Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Number of Pages</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter number of pages" name="pages" value="<?php echo $resu['NumberofPages']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="exampleInputfname">Description *</label>
                    <textarea class="form-control" id="exampleInputfname" placeholder="Enter your notes title" rows="5" required name="description" maxlength="255"><?php echo $resu['Description'] ?></textarea>
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
                            <option value="<?php echo $countryrow['ID'] ?>" <?php if($countryrow['ID']==$resu['Country']){echo "selected";}?>><?php echo $countryrow['Name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Institution Name</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your institution name" name="institution" value="<?php echo $resu['UniversityName']; ?>">
                </div>
            </div>
            <div class="user-heading">
                <h3>Course Details</h3>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Course Name</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your course name" name="course" value="<?php echo $resu['Course']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputlname">Course Code</label>
                    <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your course code" name="coursecode" value="<?php echo $resu['CourseCode']; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Professor / Lecturer</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your professor name" name="professor" value="<?php echo $resu['Professor']; ?>">
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
                            <input class="form-check-input" type="radio" name="sellfor" value="5" required <?php if($resu['IsPaid']==5){echo "checked"; } ?>>
                            <label class="form-check-label" for="inlineRadio1" style="margin-left: 10px;">Free</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sellfor" id="inlineRadio2" value="4" <?php if($resu['IsPaid']==4){echo "checked"; } ?>>
                            <label class="form-check-label" for="inlineRadio2" style="margin-left: 10px;">Paid</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputfname">Sell Price *</label>
                            <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your price" name="price" required value="<?php echo $resu['SellingPrice']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Note Preview</label>
                    <div class="upload-custom-add-notes">
                        <button>
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getpreview" name="preview" style="border:none;width:70%;margin-left:-7%;">
                        <p class="text-center">Upload a file</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="submit-btn-user" name="update">Update</button>
            <div class="m-bottom-60">
            </div>
        </form>
    </div>

<?php
    include '../php/footer.php';
?>

</html>
