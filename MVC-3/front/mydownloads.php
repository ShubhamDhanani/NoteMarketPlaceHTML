
<?php 
session_start();
include '../php/dbcon.php';
include '../src/mail.php';
$pagename= "MyDownloads";
$table= "yes";

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../php/front-header.php'; ?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    <!--   My Downloads table-->
<div class="container">
    <div class="white_space"></div>
    <section class="dashboard_top dashboard_table">
        <div class="container">
            <div class="row">
                <div class="download_heading col-md-4 col-sm-6 col-12">My Downloads</div>
                <div class="col-md-8 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row" style="margin-right:-30px;">
                            <div class="col-md-8 col-sm-8 col-7">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" placeholder="Search" id="searchtext1">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-5 search_button">
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
                            <th scope="col" style="width: 5%;">SR NO.</th>
                            <th scope="col" style="width: 15%;">NOTE TITLE</th>
                            <th scope="col" style="width: 10%;">category</th>
                            <th scope="col" style="width: 20%;">seller</th>
                            <th scope="col" style="width: 10%;">sell type</th>
                            <th scope="col" style="width: 10%;">price</th>
                            <th scope="col" style="width: 20%;">downloaded date/time</th>
                            <th scope="col" style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                    $user = $_SESSION['id'];
                        
                        $selectquery = "SELECT downloads.ID AS downloadid,downloads.NoteID as noteid ,downloads.AttachmentPath as path,downloads.NoteTitle as notetitle, downloads.NoteCategory as category, users.EmailID as seller, downloads.IsPaid as selltype,downloads.PurchasedPrice as price,downloads.AttachmentDownloadedDate as downloaddate FROM downloads LEFT JOIN users ON downloads.Seller=users.ID WHERE downloads.Downloader=$user AND downloads.IsSellerHasAllowedDownload=1 and downloads.IsActive=1 order by downloaddate DESC";
                        $select = mysqli_query($con,$selectquery);
                        
                        $sr=1;
                        
                        while($result = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                            <td><?php echo $sr;?></td>
                            <td><?php echo $result['notetitle'];?></td>
                            <td><?php echo $result['category'];?></td>
                            <td><?php echo $result['seller'];?></td>
                            <td><?php if($result['selltype']==0){echo "free";}
                            else{echo "paid";}?></td>
                            <td><?php echo $result['price'];?></td>
                            <td><?php echo $result['downloaddate'];?></td>
                            <td>
                                <a href="note-details.php?id=<?php echo $result['noteid'] ?>" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?php echo $result['path'];?>" type="button" download data-id="<?php echo $result['noteid'];?>-<?php echo $_SESSION['id'];?>" id="download">Download Note</a>
                                    <a class="dropdown-item" id="reviewid" type="button" data-toggle="modal" data-target="#reviewmodal" data-id="<?php echo $result['noteid'];?>-<?php echo $result['downloadid'];?>">Add Reviews/Feedback</a>
                                    <a class="dropdown-item report" type="button" id="reportid" data-toggle="modal" data-target="#reportmodal" data-id="<?php echo $result['noteid'];?>-<?php echo $result['downloadid'];?>">Report as Inappropriate</a>
                                </div>
                            </td>
                            
                            <?php
                            $sr++;
                            }
                                ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php
        if(isset($_POST['reviewsubmit'])){
            
            $rate =mysqli_real_escape_string($con,$_POST['rate']);
            $comment =mysqli_real_escape_string($con,$_POST['comment']);
            $reviewnoteid =mysqli_real_escape_string($con,$_POST['reviewsubmit']);
            $reviewnoteidArray = explode("-",$reviewnoteid);
            $noteid = $reviewnoteidArray[0];
            $downloadid = $reviewnoteidArray[1];
            $reviewer = $_SESSION['id'];
            
            $sel="select * from sellernotesreviews where NoteID=$noteid AND ReviewedByID=$reviewer AND IsActive=1";
            $select=mysqli_query($con,$sel);
            $sc= mysqli_num_rows($select);
            
            if($sc>0){
                $update_review_query = "UPDATE sellernotesreviews SET Ratings=$rate , Comments='$comment',ModifiedDate=current_timestamp() , ModifiedBy=$reviewer where NoteID=$noteid AND ReviewedByID=$reviewer";
                $update_review = mysqli_query($con,$update_review_query);
            
            if($update_review){
            ?>
                <script>
                    alert("Review Updated Successfully");
                </script>
            <?php
            }
            else{
            ?>
                <script>
                    alert("Review not Updated");
                </script>
            <?php
            }
            }
            else{
                $insert_review_query = "INSERT INTO sellernotesreviews(NoteID , ReviewedByID , AgainstDownloadsID , Ratings, Comments, CreatedBy) VALUES ($noteid,$reviewer,$downloadid,$rate,'$comment',$reviewer)";
                $insert_review = mysqli_query($con,$insert_review_query);
            
                if($insert_review){
                ?>
                <script>
                    alert("Review Added Successfully");
                </script>
                <?php
                }
                else{
                ?>
                <script>
                    alert("Review Not Added");
                </script>
                <?php
                }
                }
            
            
            
        }
    
    ?>

    <!-- Modal -->
    <div class="modal fade review_modal" id="reviewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal_head col-md-12">
                    <div class="modal_heading col-md-6">Add Review</div>
                    <div class="modal-close col-md-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                       <form action="mydownloads.php" method="post">
                        <div class="row">
                            <div class="rate" style="margin-left: 2%;">
                                <input type="radio" id="star5" name="rate" value="5"  required/>
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                        <div class="comment-box">
                            <label for="exampleInputfname">Comments *</label>
                            <textarea class="form-control" id="exampleInputfname" placeholder="Comments..." rows="5" name="comment" required></textarea>
                        </div>
                        <div class="submit_button">
                            <button type="submit" id="reviewsubmit" class="btn btn-primary submit_btn" name="reviewsubmit">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <?php
    
        if(isset($_POST['report'])){
            
            $remark =mysqli_real_escape_string($con,$_POST['remark']);
            $reportnoteid =mysqli_real_escape_string($con,$_POST['report']);
            $reportnoteidArray = explode("-",$reportnoteid);
            $noteid = $reportnoteidArray[0];
            $downloadid = $reportnoteidArray[1];
            $reporter = $_SESSION['id'];
            
            $sel="select * from sellernotesreportedissues where NoteID=$noteid AND ReportedByID=$reporter AND IsActive=1";
            $select=mysqli_query($con,$sel);
            $sc= mysqli_num_rows($select);
            if($sc>0){
                
                $update_report_query = "UPDATE sellernotesreportedissues SET Remarks='$remark' , ModifiedDate=current_timestamp() , ModifiedBy=$reporter where NoteID=$noteid AND ReportedByID=$reporter";
                $update_report = mysqli_query($con,$update_report_query);
            
                if($update_report){
                ?>
                <script>
                    alert("Report an Inappropriate Updated Successfully");
                </script>
                <?php
                }
                else{
                ?>
                <script>
                    alert("Report an Inappropriate Update Failed");
                </script>
                <?php
                }
            }
            else{            
            
                $insert_report_query = "INSERT INTO sellernotesreportedissues(NoteID , ReportedByID ,  	AgainstDownloadID , Remarks, CreatedBy) VALUES ($noteid,$reporter,$downloadid,'$remark',$reporter)";
                $insert_report = mysqli_query($con,$insert_report_query);
            
                if($insert_report){
                ?>
                <script>
                    alert("Report an Inappropriate Successfully");
                </script>
                <?php
                }
                else{
                ?>
                <script>
                    alert("Report an Inappropriate Failed");
                </script>
                <?php
                }

            }
            
        
        if($insert_report or $update_report){
            
            $selc = "select downloads.* , users.FirstName from downloads,users where downloads.Seller=users.ID AND NoteID=$noteid and Downloader=$reporter AND downloads.IsActive=1";
            $secq = mysqli_query($con,$selc);
            $ress = mysqli_fetch_assoc($secq);
            $sellername= $ress['FirstName'];
            $membername = $_SESSION['fname'];
            $notetitle = $ress['NoteTitle'];
            
            
            $mail->setFrom($config_email, 'NotesMarketPlace'); // This email address and name will be visible as sender of email

            $mail->addAddress('sndhanani43@gmail.com', 'Receiver name'); // This email is where you want to send the email
            $mail->addReplyTo($config_email, 'Sender name'); // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
            $mail->Subject = "$membername Reported an issue for $notetitle"; //subject line of email
            $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                <thead>
                    <th>
                        <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
                    </th>
                </thead>
                <tbody>
                    <br>
                    <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                        <td class='text-1'>Reported an Issue</td>
                    </tr>
                    <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                        <td class='text-2'>Hello Admins,</td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            We want to inform you that, <b>$membername</b>  Reported an issue for <b>$sellername</b>’s Note with title <b>$notetitle</b>. Please look at the notes and take required actions.
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
    
     <!-- Modal -->
    <div class="modal fade reject_modal report_modal" id="reportmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal_head col-md-12">
                    <div class="modal_heading col-md-10">Report an Inappropriate</div>
                    <div class="modal-close col-md-2">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                       <form action="mydownloads.php" method="post">
                        <div class="row">
                        </div>
                        <div class="comment-box">
                            <label for="exampleInputfname">Remarks*</label>
                            <textarea class="form-control" id="exampleInputfname" placeholder="Write remarks" rows="5" required name="remark"></textarea>
                        </div>
                        <div class="modal_button text-right">
                            <button type="submit" class="btn btn-primary red_btn" name="report" id="report">Report</button>
                            <button type="button" class="btn btn-primary gray_btn" data-dismiss="modal" aria-label="Close">Cancel</button>
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
                "iDisplayLength": 10,
                language: {
                    paginate: {
                        next: '<img src="../images/icons/right-arrow.png">',
                        previous: '<img src="../images/icons/left-arrow.png">'
                    }
                },
                columnDefs:[{
                    targets:[7],
                    orderable:false,
                }]
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table.search(x).draw();

            });

        });

        $(document).on("click", "#reviewid", function () {
        var myBookId = $(this).data('id');
        $(".modal-body #reviewsubmit").val( myBookId );
        });


        $(document).on("click", "#reportid", function () {
        var myBookId = $(this).data('id');
        $(".modal-body #report").val( myBookId );
        });
    
        $(document).on("click", "#download", function (){
            var note = $(this).data('id');
            var arr = note.split("-");
            var noteid = arr[0];
            var user = arr[1];
      $.ajax({
           type: "POST",
           url: '../php/downloadajax.php',
           data:{noteid:noteid,user:user},
           success:function() {
             
           },
            error: function (e) {
                console.log(e);
            }

            });
        });

</script>
    
</html>