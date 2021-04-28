<?php 
session_start();
$pagename="AddNotes";
$table= "no";
error_reporting(E_ALL ^ E_WARNING);

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
        if(empty($price)){
            $price = "0";
        }
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



        if($sellfor==5){
            $price = 0;
        }
            $_SESSION['price'] = $price;

            $user = $_SESSION['id'];

            $displaypicname = $displaypic['name'];
            if(!$displaypicname){
                $displaypicname = "example.jpg";
                $_SESSION['dp'] = 1;
            }
            $displaypic_ext = explode('.',$displaypicname);
            $displaypic_ext_check = strtolower(end($displaypic_ext));
            $valid_displaypic_ext = array('png','jpg','jpeg');
            if($_SESSION['dp']==1){
                $displaypicnewname="";
            }
            else{
                $displaypicnewname = "DP_".date("dmyhis").'.'.$displaypic_ext_check;
            }


            $previewname = $preview['name'];
            $preview_ext = explode('.',$previewname);
            $preview_ext_check = strtolower(end($preview_ext));
            $valid_preview_ext = array('pdf');
            $previewnewname = "Preview_".date("dmyhis").'.'.$preview_ext_check;

            $countfiles = count($uploadnote['name']);
            $vn=0;
            for($i=0;$i<$countfiles;$i++){
            $uploadnotename = $uploadnote['name'][$i];
            $uploadnote_ext = explode('.',$uploadnotename);
            $uploadnote_ext_check = strtolower(end($uploadnote_ext));
            $valid_uploadnote_ext = array('pdf');
            if(in_array($uploadnote_ext_check,$valid_uploadnote_ext)){
                $v=1;
            }
            else{
                $vn=1;
            }
                
            }

            if(in_array($displaypic_ext_check,$valid_displaypic_ext) && in_array($preview_ext_check,$valid_preview_ext) && $v==1 && $vn!==1){

                $insertquery = "INSERT INTO sellernotes(SellerID, Status,ActionedBy,Title,Category,DisplayPicture, NoteType, NumberofPages, Description, UniversityName,Country, Course, CourseCode, Professor, IsPaid, SellingPrice,NotesPreview,CreatedBy,ModifiedBy) VALUES ('$user','6','$user','$title','$category','$displaypicnewname','$type','$pages','$description','$institution','$country','$course','$coursecode','$professor',$sellfor,'$price','$previewnewname','$user','$user')";
                $iquery= mysqli_query($con,$insertquery);
                $noteid = mysqli_insert_id($con);
                $_SESSION['noteid'] = $noteid;
                $_SESSION['notetitle'] = $title;

            $displaypicpath = $displaypic['tmp_name'];
            if(!is_dir("'../Member/'.$user.'/'.$noteid.'/'")){
                mkdir("../Member/".$user."/".$noteid."/",0777,true);
            }
            $displaypic_dest = '../Member/'.$user.'/'.$noteid.'/'.$displaypicnewname;
            move_uploaded_file($displaypicpath,$displaypic_dest);

            $previewpath = $preview['tmp_name'];
            $preview_dest = '../Member/'.$user.'/'.$noteid.'/'.$previewnewname;
            move_uploaded_file($previewpath,$preview_dest);

            if(!is_dir("'../Member/'.$user.'/'.$noteid.'/Attachment'.'/'")){
                mkdir("../Member/".$user."/".$noteid."/Attachment"."/",0777,true);
            }

            if($countfiles>1){
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

            $insertquery1 ="INSERT INTO sellernotesattachements(NoteID, FileName, FilePath,CreatedBy, ModifiedBy) VALUES ('$noteid','$uploadnotenewname','$uploadnote_dest','$user','$user')";
            $iquery1= mysqli_query($con,$insertquery1);
            $attachmentid = mysqli_insert_id($con);
            }
            else{
            for($i=0;$i<$countfiles;$i++){

            $uploadnotenewname = "Attachment_[$i]_".date("dmyhis").'.'.$uploadnote_ext_check;
            $uploadnotepath = $uploadnote['tmp_name'];


            $uploadnote_dest = '../Member/'.$user.'/'.$noteid.'/Attachment'.'/'.$uploadnotenewname;
            move_uploaded_file($uploadnotepath[$i],$uploadnote_dest);
            
            
        
                $insertquery1 ="INSERT INTO sellernotesattachements(NoteID, FileName, FilePath,CreatedBy, ModifiedBy) VALUES ('$noteid','$uploadnotenewname','$uploadnote_dest','$user','$user')";
                $iquery1= mysqli_query($con,$insertquery1);
                $attachmentid = mysqli_insert_id($con);
            
        }
        }
                
                        if($iquery && $iquery1){
                        ?>
                        <script>
                        alert("data inserted");
                        location.replace("updatenote.php?id=<?php echo $noteid; ?>");
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

?>

<!DOCTYPE html>
<html lang="en">

<?php include '../php/front-header.php'; ?>

<!-- Add Notes -->
<div class="add-note-image m-top-100">
    <div class="user-text">
        <h1>Add Notes</h1>
    </div>
</div>

<!-- User Form -->

<div class="container form-wrap">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <div class="user-heading">
            <h3>Basic Note Details</h3>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleInputfname">Title *</label>
                <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your notes title" name="title" required>
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
                        <option value="<?php echo $categoryrow['ID'];?>"><?php echo $categoryrow['Name'] ?></option>
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
                    <input type="file" id="getdisplaypic" name="displaypic" style="border:none;width:70%;margin-left:-7%;">
                    <p class="text-center">Upload a picture</p>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputfname">Upload notes *</label>
                <div class="upload-custom">
                    <button onclick="document.getElementById('getnote').click()">
                        <img src="../images/icons/upload-file.png">
                    </button>
                    <input type="file" id="getnote" name="uploadnote[]" style="border:none;width:70%;margin-left:-7%;"  required multiple>
                    <p class="text-center">Upload Your Note</p>
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
                        <option value="<?php echo $typerow['ID'] ?>"><?php echo $typerow['Name'] ?></option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputfname">Number of Pages</label>
                <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter number of pages" name="pages">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="exampleInputfname">Description *</label>
                <textarea class="form-control" id="exampleInputfname" placeholder="Enter your notes title" rows="5" required name="description" maxlength="255"></textarea>
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
                        <option value="<?php echo $countryrow['ID'] ?>"><?php echo $countryrow['Name'] ?></option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputlname">Institution Name</label>
                <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your institution name" name="institution">
            </div>
        </div>
        <div class="user-heading">
            <h3>Course Details</h3>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleInputfname">Course Name</label>
                <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your course name" name="course">
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputlname">Course Code</label>
                <input type="text" class="form-control" id="exampleInputlname" placeholder="Enter your course code" name="coursecode">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleInputfname">Professor / Lecturer</label>
                <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your professor name" name="professor">
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
                        <input class="form-check-input" type="radio" name="sellfor" id="inlineRadio1" value="5" required >
                        <label class="form-check-label" for="inlineRadio1" style="margin-left: 10px;">Free</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sellfor" id="inlineRadio2" value="4">
                        <label class="form-check-label" for="inlineRadio2" style="margin-left: 10px;">Paid</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputfname">Sell Price *</label>
                        <input type="text" class="form-control" id="prices" placeholder="Enter your price" name="price" required >
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleInputfname">Note Preview*</label>
                <div class="upload-custom-add-notes">
                    <button onclick="document.getElementById('getpreview').click()">
                        <img src="../images/icons/upload-file.png">
                    </button>
                    <input type="file" id="getpreview" name="preview" style="border:none;width:70%;margin-left:-7%;" required>
                    <p class="text-center">Upload a Filess</p>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="submit-btn-user" name="save">SAVE</button>
        <button type="submit" class="btn btn-primary btn-right" name="publish" id="submit-btn-user" disabled>PUBLISH</button>
        <div class="m-bottom-60">
        </div>
    </form>
</div>

<?php include '../php/footer.php'; ?>

<script>
    $(function () {
        $("input[name='sellfor']").click(function () {
            if ($("#inlineRadio2").is(":checked")) {
                $("#prices").removeAttr("disabled");
                $("#prices").focus();
            } else {
                $("#prices").attr("disabled", "disabled");
            }
        });
    });
</script>

</html>
