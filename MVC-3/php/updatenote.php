<?php 
session_start();
include '../php/dbcon.php';
include '../src/mail.php';

if(!isset($_SESSION['fname'])){
    header("location:login.php");
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
        
        $update = " update sellernotes set Title='$title', Category=$category, NoteType=$type, NumberofPages=$pages, Description='$description', Country=$country, UniversityName='$institution' , Course='$course', CourseCode='$coursecode', Professor='$professor', IsPaid=$sellfor , SellingPrice=$price where ID=$ids ";
        $updatequery = mysqli_query($con,$update);
    
        if($updatequery){
            ?>
            <script>
                alert("note details updated");
                location.replace("../front/sellnotes.php");
            </script>
            
            <?php
            $noteid = $ids;
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
                        <input type="file" id="getdisplaypic" name="displaypic" style="border:none;width:70%;margin-left:-7%;"  disabled>
                        <p class="text-center">Upload a picture</p>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Upload notes </label>
                    <div class="upload-custom">
                        <button >
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getnote" name="uploadnote[]" style="border:none;width:70%;margin-left:-7%;" multiple disabled>
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
                    <textarea class="form-control" id="exampleInputfname" placeholder="Enter your notes title" rows="5" required name="description" maxlength="255"><?php echo $result['Description'] ?></textarea>
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
                            <input class="form-check-input" type="radio" name="sellfor" value="5" required <?php if($result['IsPaid']==5){echo "checked"; } ?>>
                            <label class="form-check-label" for="inlineRadio1" style="margin-left: 10px;">Free</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sellfor" id="inlineRadio2" value="4" <?php if($result['IsPaid']==4){echo "checked"; } ?>>
                            <label class="form-check-label" for="inlineRadio2" style="margin-left: 10px;">Paid</label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputfname">Sell Price *</label>
                            <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your price" name="price" required value="<?php echo $result['SellingPrice']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputfname">Note Preview</label>
                    <div class="upload-custom-add-notes">
                        <button>
                            <img src="../images/icons/upload-file.png">
                        </button>
                        <input type="file" id="getpreview" name="preview" style="border:none;width:70%;margin-left:-7%;" disabled>
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
