<?php 
session_start();
include '../php/dbcon.php';
$pagename="Dashboard";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header-admin.php'; ?>
    <!--   dashboard   -->
<div class="container">
    <div class="white_space"></div>
    <section class="dashboard_top">
        <div class="container">
            <div class="row">
                <div class="main_heading col-md-6">Dashboard</div>
            </div>
            <div class="row">
                <div class="boxes col-md-4">
                    <div class="for_publish_box">
                        <div class="col-md-12 sold">
                           <?php
                            $rev = mysqli_query($con,"select count(ID) as total from sellernotes where Status IN (7,8) and IsActive=1");
                            $resr =mysqli_fetch_assoc($rev);
                            ?>
                            <a href="notes-under-review.php" style="text:decoration:none;"><span class="heading"><?php echo $resr['total']; ?></span></a><br>
                            <span class="sub_heading">Numbers of Notes in Review for Publish</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-4">
                    <div class="new_downloaded_box-admin" id="middle-box">
                        <div class="col-md-12 sold">
                           <?php
                            $down = mysqli_query($con,"SELECT COUNT(ID) as download FROM downloads WHERE IsAttachmentDownloaded=1 AND AttachmentDownloadedDate>NOW()-INTERVAL 7 day AND IsActive=1 ");
                            $resd =mysqli_fetch_assoc($down);
                            ?>
                            <a href="downloaded-notes.php?7day=1" style="text:decoration:none;"><span class="heading"><?php echo $resd['download']; ?></span></a><br>
                            <span class="sub_heading">Numbers of New Notes Downloaded<br>(Last 7 days)</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-4">
                    <div class="new_registration_box">
                       <?php
                            $user = mysqli_query($con,"SELECT COUNT(ID) as users FROM users where RoleID=3 and IsEmailVerified=1 and CreatedDate>NOW()-INTERVAL 7 day AND IsActive=1");
                            $resu =mysqli_fetch_assoc($user);
                            ?>
                            <a href="members.php?7day=1" style="text:decoration:none;"><span class="heading"><?php echo $resu['users']; ?></span></a><br>
                        <span class="sub_heading">Numbers of New Registration(last 7 days)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--   dashboard table up  -->
    <section class="dashboard_table">
        <div class="container">
            <div class="row">
                <div class="heading col-md-4 col-12">Published Notes</div>
                <div class="search col-md-8 col-12">
                    <div class="search-note">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-8">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" id="searchtext1" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-4 search_button">
                                <button type="button" class="btn btn-primary searc_btn search1">Search</button>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <select class="btn-group small_text" id="monthfilter" style="height:40px;margin-top:2px;margin-bottom:0px;margin-left:-25px;width:120px;">
                                    <?php                                    
                                    $currentMonthName = date('F');
                                    // $currentMonthValue = date('n');
                                    for ($i = 0; $i < 6; $i++) {
                                        $MonthName = date("F", strtotime(date('Y-m-01')." -$i months"));
                                        $MonthValue = date("-m-Y", strtotime(date('Y-m-01')." -$i months"));
                                        if ($MonthName == $currentMonthName) {
                                            echo "<option value='{$MonthValue}' selected>{$MonthName}</option>";
                                        } else {
                                            echo "<option value='{$MonthValue}'>{$MonthName}</option>";
                                        }                                                                                                                  
                                    }
                                    ?>
                                </select>
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
                            <th scope="col" style="width: 15%;">TITLE</th>
                            <th scope="col" style="width: 10%;">category</th>
                            <th scope="col" style="width: 10%;">Attachment size</th>
                            <th scope="col" style="width: 10%;">sell type</th>
                            <th scope="col" style="width: 10%;">price</th>
                            <th scope="col" style="width: 20%;">publisher</th>
                            <th scope="col" style="width: 20%;">published date</th>
                            <th scope="col" style="width: 10%;">Number of downloads</th>
                            <th scope="col" style="width: 5%;"></th>
                        </tr>    
                    </thead>
                    <tbody>
                        <?php
                        $sel = mysqli_query($con,"select * from sellernotes where Status=9 and IsActive=1 ORDER BY PublishedDate DESC");
                        $sr=1;
                        while($res=mysqli_fetch_assoc($sel)){
                            $noteid =$res['ID'];
                            $pub = $res['ActionedBy'];
                            $cate = $res['Category'];
                            $cat = mysqli_query($con,"SELECT Name as category from notecategories where ID=$cate");
                            $resc = mysqli_fetch_assoc($cat);       
                            $selp = mysqli_query($con,"select concat(FirstName,' ',LastName) as publisher from users where ID=$pub");
                            $resp= mysqli_fetch_assoc($selp);
                            ?>
                            <tr>
                            <td><?php echo $sr;?></td>
                            <td><a class="purple_text" href="note-details.php?id=<?php echo $noteid; ?>" style="text-decoration:none;"><?php echo $res['Title']; ?></a></td>
                            <td><?php echo $resc['category'];?></td>
                            <td>
                                <?php
                                    $self = mysqli_query($con,"select FilePath from sellernotesattachements where NoteID=$noteid");
                                    $resf=mysqli_fetch_assoc($self);
                                    $file = $resf['FilePath'];
                                    $filesize = filesize($file); // bytes
                                    $attachment_size = round($filesize / 1024 / 1024, 1);
                                    echo $attachment_size."Mb";
                                    
                                ?>
                            </td>
                            <td><?php if($res['IsPaid']==4){echo "Paid";}
                                else{echo "Free";}?></td>
                            <td><?php echo "$".$res['SellingPrice'];?></td>
                            <td><?php echo $resp['publisher'];?></td>
                            <td><?php echo date("d-m-Y, h:i:s", strtotime($res['PublishedDate']));?></td>
                            <td><a class="purple_text" href="downloaded-notes.php?title=<?php echo $res['Title'] ?>">
                                <?php
                                $download=mysqli_query($con,"SELECT COUNT(ID) AS download FROM downloads WHERE NoteID=$noteid AND IsAttachmentDownloaded=1 AND IsActive=1");
                                $res_dow = mysqli_fetch_assoc($download);
                                echo $res_dow['download'];
                                ?>
                                </a></td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo $resf['FilePath']; ?>" class="dropdown-item" type="button" download>Download Notes</a>
                                    <a href="note-details.php?id=<?php echo $noteid; ?>" class="dropdown-item" type="button">View More Details</a>
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
                    targets:[9],
                    orderable:false,
                }]
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table.search(x).draw();

            });
            
            $(document).on('change', '#monthfilter', function () {
            shownotes($(this).val());
            });

            function shownotes(month) {
                let monthVal = month;
                table.column(7).search(monthVal).draw();
            }

            var currentMonth = $('#monthfilter').val();
            shownotes(currentMonth);

            
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