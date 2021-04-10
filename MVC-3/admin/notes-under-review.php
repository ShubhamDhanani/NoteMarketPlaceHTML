<?php 
session_start();
include '../php/dbcon.php';
include '../src/mail.php';
$pagename="Notes_Under_Review";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header-admin.php'; ?>
     
    <!--   dashboard table up  -->
<div class="container">
    <div class="white_space"></div>
    <section class="dashboard_table">
        <div class="container">
            <div class="row">
                <div class="heading col-md-6">Notes Under Review</div>
            </div>
            <div class="row">
                <div class="small_text col-md-12">Seller</div>
                <div class="seller_drop col-md-2 col-4" style="padding-top: 20px;">
                    
                    <select class="btn-group small_text" style="height:40px;margin-top:2px;" <?php if(isset($_GET['id'])){echo "disabled";} ?> >
                        <option class="filter-option" value="">---</option>
                        <?php
                        $seller=mysqli_query($con,"SELECT sellernotes.Title ,CONCAT(users.FirstName ,' ',users.LastName) AS seller FROM sellernotes,users WHERE sellernotes.SellerID=users.ID AND sellernotes.Status IN(7,8) and sellernotes.IsActive=1 GROUP BY seller");
                        while($ress=mysqli_fetch_assoc($seller)){
                            ?>
                            <option value="<?php echo $ress['seller']?>" ><?php echo $ress['seller']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-10 col-sm-8 col-12" style="padding-right: 0;">
                    <div class="search-note">
                        <div class="row" style="padding-top: 25px;">
                            <div class="col-md-8 col-sm-8 col-8">
                                <div class="search" style="padding-left: 0;">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" id="searchtext1" class="form-control" placeholder="Search" style="height: 40px;">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-4 search_button">
                                <button type="button" class="btn btn-primary search_btn search1">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row booktable table-responsive">
                <table class="table table-hover table-responsive table1">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">sr no.</th>
                            <th scope="col" style="width: 40%;">note title</th>
                            <th scope="col" style="width: 5%;">category</th>
                            <th scope="col" style="width: 15%;">seller</th>
                            <th scope="col" style="width: 5%;"></th>
                            <th scope="col" style="width: 30%;">date added</th>
                            <th scope="col" style="width: 15%;">status</th>
                            <th scope="col" style="width: 5%;"></th>
                            <th scope="col" style="width: 5%;">action</th>
                            <th scope="col" style="width: 5%;"></th>
                            <th scope="col" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if(isset($_GET['id'])){
                            $member = $_GET['id'];
                            $select=mysqli_query($con,"SELECT sellernotes.SellerID,sellernotes.Title,sellernotes.ID,notecategories.Name as category,users.FirstName,users.LastName,sellernotes.CreatedDate,referencedata.value as status FROM sellernotes LEFT JOIN notecategories ON sellernotes.Category=notecategories.ID LEFT JOIN users ON sellernotes.SellerID=users.ID LEFT JOIN referencedata ON sellernotes.Status=referencedata.ID WHERE sellernotes.Status IN(7,8) and sellernotes.SellerID=$member and sellernotes.IsActive=1 order by sellernotes.CreatedDate DESC");
                        }
                        else{
                            $select=mysqli_query($con,"SELECT sellernotes.SellerID,sellernotes.Title,sellernotes.ID,notecategories.Name as category,users.FirstName,users.LastName,sellernotes.CreatedDate,referencedata.value as status FROM sellernotes LEFT JOIN notecategories ON sellernotes.Category=notecategories.ID LEFT JOIN users ON sellernotes.SellerID=users.ID LEFT JOIN referencedata ON sellernotes.Status=referencedata.ID WHERE sellernotes.Status IN(7,8) and sellernotes.IsActive=1 order by sellernotes.CreatedDate DESC");
                        }
                        
                        
                        
                        $sr=1;
                        
                        while($res=mysqli_fetch_assoc($select)){
                            $noteid = $res['ID'];
                            ?>
                            <tr>
                                <td><?php echo $sr;?></td>
                                <td><a href="note-details.php?id=<?php echo $noteid;?>" class="purple_text" style="text-decoration:none;"><?php echo $res['Title'];?></a></td>
                                <td><?php echo $res['category'];?></td>
                                <td><?php echo $res['FirstName']." ".$res['LastName'];?></td>
                                <td><a href="member-details.php?id=<?php echo $res['SellerID']; ?>"><img src="../images/icons/eye.png"></a></td>
                                <td><?php echo $res['CreatedDate'];?></td>
                                <td><?php echo $res['status'];?></td>
                                    <td><a href="../php/approve.php?noteid=<?php echo $res['ID'] ?>" type="button" class="btn btn-primary green_btn" onclick="return confirm('If you approve the notes – System will publish the notes over portal. Please press ok to continue.')"
                                     >Approve</a></td>
                                <td><button id="rejectnote" type="button" class="btn btn-primary red_btn" data-toggle="modal" data-target="#rejectmodal" data-id="<?php echo $res['ID'] ?>-<?php echo $res['Title']?>">Reject</button></td>
                                <td><a href="../php/inreview.php?noteid=<?php echo $res['ID'] ?>" type="button" class="btn btn-primary gray_btn" onclick="return confirm('Via marking the note In Review – System will let user know that review process has been initiated. Please press ok to continue.')">InReview</a></td>
                                <td>
                                    <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       <?php
                                        $file= mysqli_query($con,"SELECT FilePath from sellernotesattachements WHERE sellernotesattachements.NoteID=$noteid AND IsActive=1");
                                        $pathr = mysqli_fetch_assoc($file);
                                        $filepath = $pathr['FilePath'];
                                        ?>
                                        <a href="<?php echo $filepath ?>" class="dropdown-item" type="button" download>Download Notes</a>
                                        <a href="note-details.php?id=<?php echo $noteid;?>" class="dropdown-item" type="button">View More Details</a>
                                        <button id="unpublishnote" type="button" class="dropdown-item" data-toggle="modal" data-target="#unpublishmodal" data-id="<?php echo $res['ID'] ?>-<?php echo $res['Title']?>-<?php echo $res['SellerID']?>">Unpublish</button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            
                            $sr++;
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php
    if(isset($_POST['reject'])){
        $user= $_SESSION['id'];
        $remark =mysqli_real_escape_string($con,$_POST['remark']);
        $rejectnoteid =mysqli_real_escape_string($con,$_POST['reject']);
        $rejectnoteidArray = explode("-",$rejectnoteid);
        $noteid = $rejectnoteidArray[0];
        $update = mysqli_query($con,"UPDATE sellernotes SET ActionedBy=$user,AdminRemarks='$remark',Status=10,ModifiedDate=current_timestamp(),ModifiedBy=$user where ID=$noteid AND IsActive=1");
        
    }
?>
    <!-- Modal -->
    <div class="modal fade reject_modal" id="rejectmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal_head col-md-12">
                    <div class="modal_heading col-md-10" id="title"></div>
                    <div class="modal-close col-md-2">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                       <form action="notes-under-review.php" method="post">
                        <div class="comment-box">
                            <label for="exampleInputfname">Remarks*</label>
                            <textarea class="form-control" id="exampleInputfname" placeholder="Write remarks" rows="5" required name="remark"></textarea>
                        </div>
                        <div class="modal_button text-right">
                          
                            <button type="submit" class="btn btn-primary red_btn" onclick="return confirm('Are you sure you want to reject seller request?')" id="reject" name="reject">Reject</button>
                            <button type="button" class="btn btn-primary gray_btn" data-dismiss="modal">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    if(isset($_POST['unpublish'])){
        $remark =mysqli_real_escape_string($con,$_POST['remark1']);
        $unpublishnoteid =mysqli_real_escape_string($con,$_POST['unpublish']);
        $unpublishnoteidArray = explode("-",$unpublishnoteid);
        $noteid = $unpublishnoteidArray[0];
        $title = $unpublishnoteidArray[1];
        $seller = $unpublishnoteidArray[2];
        $sel_seller=mysqli_query($con,"select FirstName from users where ID=$seller AND IsActive=1");
        $ress=mysqli_fetch_assoc($sel_seller);
        $sellername = $ress['FirstName'];
        $user = $_SESSION['id'];
        $up = mysqli_query($con,"UPDATE sellernotes SET Status=11,ActionedBy=$user,AdminRemarks='$remark',ModifiedDate=current_timestamp(),ModifiedBy=$user,IsActive=0 where ID=$noteid");
        if($up){

        $folder_path = "../Member/".$seller."/".$noteid."/"."Attachment"."/";
        $files = glob($folder_path.'/*');

        // Deleting all the files in the list
        foreach($files as $file) {

        if(is_file($file))

        // Delete the given file
        unlink($file);
        }
        rmdir("../Member/".$seller."/".$noteid."/"."Attachment"."/");



        $folder_path1 = "../Member/".$seller."/".$noteid."/";
        $files1 = glob($folder_path1.'/*');

        // Deleting all the files in the list
        foreach($files1 as $file) {

        if(is_file($file))

        // Delete the given file
        unlink($file);
        }
        rmdir("../Member/".$seller."/".$noteid."/");
        
        
            $mail->setFrom($config_email, 'NotesMarketPlace'); // This email address and name will be visible as sender of email

            $mail->addAddress('sndhanani43@gmail.com', 'Receiver name'); // This email is where you want to send the email
            $mail->addReplyTo($config_email, 'Sender name'); // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
            $mail->Subject = "Sorry! We need to remove your notes from our portal."; //subject line of email
            $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                <thead>
                    <th>
                        <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
                    </th>
                </thead>
                <tbody>
                    <br>
                    <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                        <td class='text-1'>Unpublished Note</td>
                    </tr>
                    <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                        <td class='text-2'>Hello $sellername,</td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            We want to inform you that, your note <b>$title</b> has been removed from the portal.
                            Please find our remarks as below - <br>
                            <b>$remark</b>
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

        }
?>
    
    <div class="modal fade reject_modal" id="unpublishmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal_head col-md-12">
                    <div class="modal_heading col-md-10" id="tit"></div>
                    <div class="modal-close col-md-2">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                       <form action="notes-under-review.php" method="post">
                        <div class="comment-box">
                            <label for="exampleInputfname">Remarks*</label>
                            <textarea class="form-control" id="exampleInputfname" placeholder="Write remarks" rows="5" required name="remark1"></textarea>
                        </div>
                        <div class="modal_button text-right">
                          
                            <button type="submit" class="btn btn-primary red_btn" onclick="return confirm('Are you sure you want to Unpublish this note?')" id="unpublish" name="unpublish">UnPublish</button>
                            <button type="button" class="btn btn-primary gray_btn" data-dismiss="modal">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </div>
 <?php include '../php/footer.php'; ?>
 
  <script>
        $(document).ready(function() {
            var table = $('.table1').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="../images/icons/right-arrow.png">',
                        previous: '<img src="../images/icons/left-arrow.png">'
                    }
                },
                columnDefs:[{
                    targets:[4,7,8,9,10],
                    orderable:false,
                }]
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table.search(x).draw();

            });
            $('select').change(function(){
               var x =$(this).val();
                table.columns(3).search(x).draw();
            });

        });

        $(document).on("click", "#rejectnote", function () {
        var reject = $(this).data('id');
        var arr = reject.split("-");
        var notetitle = arr[1];
        $(".modal-body #reject").val(reject);
        document.getElementById("title").innerHTML = notetitle;
        });
      
        $(document).on("click", "#unpublishnote", function () {
        var unpublish = $(this).data('id');
        var arr = unpublish.split("-");
        var notetitle = arr[1];
        $(".modal-body #unpublish").val(unpublish);
        document.getElementById("tit").innerHTML = notetitle;
        });

    </script>
 
</html>