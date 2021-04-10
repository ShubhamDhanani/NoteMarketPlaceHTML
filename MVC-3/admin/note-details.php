<?php 
session_start();
include '../php/dbcon.php';
if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
$pagename="NoteDetails";
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header-admin.php'; ?>

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
            $selectquery = "select sellernotes.* ,notecategories.Name as category from sellernotes,notecategories where sellernotes.Category=notecategories.ID AND sellernotes.ID=$id AND sellernotes.IsActive=1";
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
                               <?php if($result['DisplayPicture']==""){
                                ?>
                                <img src="../images/note/example.jpg">
                                <?php
                                }
                                else{
                                    ?>
                                    <img src="../Member/<?php echo $result['SellerID'].'/'.$result['ID'].'/'.$result['DisplayPicture'];?>">
                                    <?php
                                }
                                ?>
                                
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <h2><?php echo $result['Title'];?></h2>
                                <h5><?php echo $result['category'];?></h5>
                                <p>
                                    <?php echo $result['Description'];?>
                                </p>
                                <div class="download_button">
                                    <?php
                                    $path= mysqli_query($con,"SELECT FilePath from sellernotesattachements WHERE sellernotesattachements.NoteID=$id and IsActive=1");
                                    $pathr = mysqli_fetch_assoc($path);
                                    $filepath = $pathr['FilePath'];                                    
                                    ?>
                                   <a href="<?php echo $filepath; ?>" download style="text-decoration:none;">
                                       <button type="button" class="btn btn-primary btn_download">Download / $<?php echo $result['SellingPrice'];?></button></a>
                                    
                                
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
                                $s="SELECT COUNT(sellernotesreviews.Ratings) as totalr, avg(sellernotesreviews.Ratings) as rate from sellernotesreviews WHERE sellernotesreviews.NoteID=$note and IsActive=1";
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
                            $sr="select ID from sellernotesreportedissues where NoteID=$noteid and IsActive=1";
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
                            $s="SELECT FirstName,LastName FROM users WHERE ID=$user and IsActive=1";
                            $sq=mysqli_query($con,$s);
                            $rs=mysqli_fetch_assoc($sq);
                           
                           ?>
                         <div class="customer_img col-md-1 col-2">
                            <img src="<?php echo $dp; ?>">
                        </div>  
                        <div class="customer col-md-11 col-12">
                            <?php echo $rs['FirstName'];?> <?php echo $rs['LastName'];?> 
                            <div class="del_icon" style="float: right;">
                                <a href="../php/delete_review.php?id=<?php echo $ress['ID'];?>&noteid=<?php echo $note;?>" class="icon"><img src="../images/icons/delete.png"></a>
                            </div><br>
                            <span class="down-rate">
                                
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
    
<?php include '../php/footer.php'; ?>


</html>
