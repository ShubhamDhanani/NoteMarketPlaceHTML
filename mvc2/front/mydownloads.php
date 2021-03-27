<style>
    /*-- data table --*/
table.dataTable thead th,
table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: none !important;
}

table.dataTable.no-footer {
    border-bottom: 1px solid #dee2e6 !important;
}

.dataTables_wrapper .dataTables_paginate {
    display: table !important;
    width: 100% !important;
    text-align: center !important;
    margin-top: 10px !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: none !important;
    background-color: grey !important;
    border-radius: 50%;
    border: 1px solid grey !important;
    font-family: "open sans", sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 20px;
    outline: none;
}

.dataTables_wrapper .dataTables_paginate a.paginate_button.current{
        color: white !important;
    }

.dataTables_wrapper .dataTables_paginate .paginate_button.current{
    background: none !important;
    background-color: #6255a5 !important;
    border-radius: 50% !important;
    color: white !important;
    font-family: "open sans", sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 20px;
}
.dataTables_wrapper .dataTables_info {
    display: none;
}
</style>
<?php 
session_start();
include '../php/dbcon.php';
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
    <div class="white_space"></div>
    <section class="dashboard_top dashboard_table">
        <div class="container">
            <div class="row">
                <div class="download_heading col-md-4 col-sm-6 col-12">My Downloads</div>
                <div class="col-md-8 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row">
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
                        
                        $selectquery = "SELECT downloads.ID AS downloadid,downloads.NoteID as noteid ,downloads.NoteTitle as notetitle, downloads.NoteCategory as category, users.EmailID as seller, downloads.IsPaid as selltype,downloads.PurchasedPrice as price,downloads.AttachmentDownloadedDate as downloaddate FROM downloads LEFT JOIN users ON downloads.Seller=users.ID WHERE downloads.Downloader=$user AND downloads.IsSellerHasAllowedDownload=1 ";
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
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" type="button">Download Note</a>
                                    <a class="dropdown-item reviewid" type="button" data-toggle="modal" data-target="#reviewmodal" data-id="<?php echo $result['noteid'];?>-<?php echo $result['downloadid'];?>">Add Reviews/Feedback</a>
                                    <a class="dropdown-item" type="button">Report as Inappropriate</a>
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
            
            $sel="select * from sellernotesreviews where NoteID=$noteid AND ReviewedByID=$reviewer";
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
                            <textarea class="form-control" id="exampleInputfname" placeholder="Comments..." rows="5" name="comment"></textarea>
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
                }
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table.search(x).draw();

            });

        });
</script>

<script>

        $(document).on("click", ".reviewid", function () {
        var myBookId = $(this).data('id');
        $(".modal-body #reviewsubmit").val( myBookId );
        });

</script>
    
</html>