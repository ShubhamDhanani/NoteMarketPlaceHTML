<?php 
session_start();
include '../php/dbcon.php';
$pagename="NoteDetails";
$table= "no";
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header.php'; ?>

    <!--    notes-details   -->
    <div class="white_space"></div>
    <section class="notes_details">
        <div class="container">
            <div class="row" style="margin-left:0;margin-right:0">
                <div class="col-md-12 small_heading">
                    Notes Details
                </div>
            </div>
            <?php
            $id = $_GET['id'];
            $selectquery = "select sellernotes.* ,notecategories.Name as category from sellernotes,notecategories where sellernotes.Category=notecategories.ID AND sellernotes.ID=$id and sellernotes.IsActive=1";
            $select= mysqli_query($con,$selectquery);
            $result = mysqli_fetch_assoc($select);
            
            $date = $result['CreatedDate'];
            $timestamp = strtotime($date);
            $new_date = date("M d Y", $timestamp);
            ?>
            <div class="row" style="margin-left:0;margin-right:0">
                <div class="col-md-7">
                    <div class="book_left">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <img src="../Member/<?php echo $result['SellerID'].'/'.$result['ID'].'/'.$result['DisplayPicture'];?>">
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <h2><?php echo $result['Title'];?></h2>
                                <h5><?php echo $result['category'];?></h5>
                                <p>
                                    <?php echo $result['Description'];?>
                                </p>
                                <div class="download_button">
                                <?php if(isset($_SESSION['fname']) && $result['IsPaid']==4){
                                ?>
                                <a href="../php/download.php?id=<?php echo $id;?>">
                                    <button type="button" class="btn btn-primary btn_download">Download / $<?php echo $result['SellingPrice'];?></button></a>
                                <?php
                                }  ?>
                                <?php if(isset($_SESSION['fname']) && $result['IsPaid']==5){
                                ?>
                                    <a href="../php/download.php?id=<?php echo $id;?>">
                                    <button type="button" class="btn btn-primary btn_download">Download</button></a>
                                <?php
                                }  ?>
                                <?php if(!isset($_SESSION['fname'])){
                                ?>
                                <button type="button" class="btn btn-primary btn_download"  onclick="location.href ='login.php';">Download / $<?php echo $result['SellingPrice'];?></button>
                                <?php
                                }  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 book_right">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-4" style="padding:0;">
                            <div class="note-text-left">
                                <h5>Institution:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-8" style="padding:0;">
                            <div class="note-text-right">
                                <h5><?php echo $result['UniversityName'];?></h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-left">
                                <h5>Course Name:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-right">
                                <h5><?php echo $result['Course'];?></h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-left">
                                <h5>Course Code:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-right">
                                <h5><?php echo $result['CourseCode'];?></h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-left">
                                <h5>Professor:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-right">
                                <h5><?php echo $result['Professor'];?></h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-left">
                                <h5>Number of Pages:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-right">
                                <h5><?php echo $result['NumberofPages'];?></h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-left">
                                <h5>Approved Date:</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" style="padding:0;">
                            <div class="note-text-right">
                                <h5><?php echo $new_date;?></h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" style="padding:0;">
                            <div class="note-text-left">
                                <h5>Rating:</h5>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6 col-8" style="padding:0;">
                            <div class="note-text-right">
                          <span class="search_rate">
                          <h5>
                           <?php
                                $note = $result['ID'];
                                $s="SELECT COUNT(sellernotesreviews.Ratings) as totalr, avg(sellernotesreviews.Ratings) as rate from sellernotesreviews WHERE sellernotesreviews.NoteID=$note AND IsActive=1";
                                $sq=mysqli_query($con,$s);
                                $rs=mysqli_fetch_array($sq);
                                $rat = $rs['rate'];
                                $rate = floor($rat);
                                $totalrate = $rs['totalr'];
                                $i = 1;
                                while($i<6){
                                    if($i<=$rate){
                                        ?>
                                        <img src="../images/icons/star.png" id="star">
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <img src="../images/icons/star-white.png" id="star">
                                        <?php
                                    }
                                    $i++;
                                }
                                
                                
                            ?>  
                            <?php echo $totalrate; ?> reviews </h5>                              
                            </span>
                            
                                
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <span class="col-md-12 red_text" style="padding:0; margin-left:-15px;">
                           <?php
                            $noteid=$result['ID'];
                            $sr="select ID from sellernotesreportedissues where NoteID=$noteid AND IsActive=1";
                            $srq= mysqli_query($con,$sr);
                            $src = mysqli_num_rows($srq);
                            ?>
                            <?php echo $src;?> Users marked this note as inappropriate
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>

    <!--    notes-review and preview   -->
    <section class="notes_details_down">
        <div class="container">
            <div class="row">
                <div class="small_heading col-md-5 col-sm-12 col-12">
                    <h4>Notes Preview</h4>
                    <div class="col-md-12 book_left">
                        <iframe src="../Member/<?php echo $result['SellerID'].'/'.$result['ID'].'/'.$result['NotesPreview'];?>">
                        </iframe>
                    </div>
                </div>
                <div class="small_heading col-md-7 col-sm-12 col-12">
                    <h4>Customer Reviews</h4>
                    <?php
                        $note = $result['ID'];
                        $se="select sellernotesreviews.*,userprofile.ProfilePicture FROM sellernotesreviews LEFT JOIN userprofile ON sellernotesreviews.ReviewedByID=userprofile.UserID WHERE sellernotesreviews.NoteID=$note and sellernotesreviews.IsActive=1 ";
                        $seq = mysqli_query($con,$se);
                        $sec = mysqli_num_rows($seq);
                        ?>
                    <div class="col-md-12 book_right">
                      <?php
                        if($sec>0){
                       while($ress = mysqli_fetch_assoc($seq)){
                           $dp = $ress['ProfilePicture'];
                           if($dp==""){
                               $dp = "../images/person/t1.jpg";
                           }
                            $user = $ress['ReviewedByID'];
                            $s="SELECT FirstName,LastName FROM users WHERE ID=$user AND IsActive=1";
                            $sq=mysqli_query($con,$s);
                            $rs=mysqli_fetch_assoc($sq);
                           
                           ?>
                         <div class="customer_img col-md-1 col-2">
                            <img src="<?php echo $dp; ?>">
                        </div>  
                        <div class="customer col-md-11 col-12">
                            <?php echo $rs['FirstName'];?> <?php echo $rs['LastName'];?><br><span class="down-rate">
                                
                            <?php
                            $rating = $ress['Ratings'];
                            $i = 1;
                                while($i<6){
                                    if($i<=$rating){
                                        ?>
                                        <img src="../images/icons/star.png" id="star">
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <img src="../images/icons/star-white.png" id="star">
                                        <?php
                                    }
                                    $i++;
                                }
                            ?>
                        
                            </span><br>
                            <p class="customer_review"> <?php echo $ress['Comments'];?></p>
                        </div>
                        <hr>
                        <?php
                        }
                        }
                        else{
                            ?>
                            <div style="color:gray;"><?php echo "No Reviews Yet...";?></div>
                            <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-close">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal_img text-center">
                        <img src="../images/icons/SUCCESS.png"><br>
                        <span class="modal_heading text-center">Thank you for purchasing!</span>
                    </div>
                    <?php
                    $seller = "SELECT sellernotes.SellerID , users.FirstName ,users.LastName from sellernotes , users WHERE sellernotes.SellerID=users.ID and sellernotes.ID=$id and sellernotes.IsActive=1";
                    $sellerq = mysqli_query($con,$seller);
                    $op = mysqli_fetch_assoc($sellerq);
                    $fname = $op['FirstName'];
                    $lname = $op['LastName'];
                    ?>
                    <div class="modal_inside">
                        <span class="title">Dear <?php echo $_SESSION['fname'];?>,</span>
                        <p class="modal_text">As this is paid notes - you need to pay to seller <b><?php echo $fname;?> <?php echo $lname;?></b> offline. We will send him an email that you want to download this note. He may contact you further for payment process completion.</p>
                        <p class="modal_text">In case, you have urgency,<br>
                            Please contact us on +9195377345959.</p>
                        <p class="modal_text">Once he receives the payment and acknowledge us - selected notes you can see over my download tab for download.</p>
                        <p class="modal_text">Have a good day.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-close">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal_img text-center">
                        <img src="../images/icons/SUCCESS.png"><br>
                        <span class="modal_heading text-center">Thank you for Downloading!</span>
                    </div>
                    <?php
                    $seller = "SELECT sellernotes.SellerID , users.FirstName ,users.LastName from sellernotes , users WHERE sellernotes.SellerID=users.ID and sellernotes.ID=$id and sellernotes.IsActive=1";
                    $s = "SELECT * FROM sellernotesattachements Where NoteID=$id AND IsActive=1";
                    $sq= mysqli_query($con,$s);
                    $r = mysqli_fetch_assoc($sq);
                    ?>
                    <div class="modal_inside">
                        <p class="modal_text text-center">Click Below Button to Start Downloading....</p>
                        <div class="download_button" style="width:60%;margin-left:20%;margin-top:5%;margin-bottom:10%;">
                        <a href="<?php echo $r['FilePath'];?>" download style="text-decoration:none;">
                        <button type="button" class="btn btn-primary btn-block" style="background:#6255a5;">Download Book</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    
<?php include '../php/footer.php'; ?>
<?php
    if(isset($_SESSION['show'])){
        ?>
        <script>
        $(document).ready(function(){
        $("#exampleModal").modal('show');
        });
        </script>
        <?php
        unset($_SESSION['show']);
    }
?>
<?php
    if(isset($_SESSION['download'])){
        ?>
        <script>
        $(document).ready(function(){
        $("#exampleModal1").modal('show');
        });
        </script>
        <?php
        unset($_SESSION['download']);
    }
    
?>

</html>
