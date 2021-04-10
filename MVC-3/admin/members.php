<?php 
session_start();
include '../php/dbcon.php';
$pagename="Members";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header-admin.php'; ?>

    <!--   My Downloads table-->
    <div class="white_space"></div>
    <section class="dashboard_top dashboard_table">
        <div class="container">
            <div class="row">
                <div class="download_heading col-md-4 col-12">Members</div>
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
                            <th scope="col" style="width: 1%;">SR NO.</th>
                            <th scope="col" style="width: 5%;">first name</th>
                            <th scope="col" style="width: 5%;">last name</th>
                            <th scope="col" style="width: 5%;">email</th>
                            <th scope="col" style="width: 5%;">joining date</th>
                            <th scope="col" style="width: 5%;">under review notes</th>
                            <th scope="col" style="width: 5%;">published notes</th>
                            <th scope="col" style="width: 2%;">downloaded notes</th>
                            <th scope="col" style="width: 2%;">total expanses</th>
                            <th scope="col" style="width: 2%;">total earnings</th>
                            <th scope="col" style="width: 2%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_GET['7day'])){
                            $select=mysqli_query($con,"SELECT ID,FirstName,LastName,EmailID,CreatedDate FROM users where RoleID=3 and IsEmailVerified=1 and CreatedDate>NOW()-INTERVAL 7 day AND IsActive=1 order by CreatedDate DESC");
                        }
                        else{
                            $select=mysqli_query($con,"SELECT ID,FirstName,LastName,EmailID,CreatedDate FROM users where RoleID=3 and IsEmailVerified=1 and IsActive=1  order by CreatedDate DESC");
                        }
                        $sr=1;
                        
                        while($res=mysqli_fetch_assoc($select)){
                            $member = $res['ID'];
                            ?>
                            <tr>
                                <td><?php echo $sr; ?></td>
                                <td><?php echo $res['FirstName']; ?></td>
                                <td><?php echo $res['LastName']; ?></td>
                                <td><?php echo $res['EmailID']; ?></td>
                                <td><?php echo $res['CreatedDate']; ?></td>
                                <td><a class="purple_text" href="notes-under-review.php?id=<?php echo $member;?>" style="text-decoration:none"><?php
                                $s1=mysqli_query($con,"SELECT COUNT(ID) as underreview FROM sellernotes WHERE Status IN (7,8) AND SellerID=$member and IsActive=1");
                                $r1=mysqli_fetch_assoc($s1);
                                echo $r1['underreview'];
                                ?></a></td>
                                <td><a class="purple_text" href="published-notes.php?id=<?php echo $member; ?>" style="text-decoration:none;"><?php
                                $s2=mysqli_query($con,"SELECT COUNT(ID) as published FROM sellernotes WHERE Status=9 AND SellerID=$member and IsActive=1");
                                $r2=mysqli_fetch_assoc($s2);
                                echo $r2['published'];
                                ?></a></td>
                                <td><a class="purple_text" href="downloaded-notes.php?id=<?php echo $member; ?>" style="text-decoration:none;"><?php
                                $s3=mysqli_query($con,"SELECT COUNT(ID) AS downloaded FROM downloads WHERE Downloader=$member AND IsAttachmentDownloaded=1 and IsActive=1 ");
                                $r3=mysqli_fetch_assoc($s3);
                                echo $r3['downloaded'];
                                ?></a></td>
                                <td><a class="purple_text" href="downloaded-notes.php?idpaid=<?php echo $member; ?>" style="text-decoration:none;">$<?php
                                $s4=mysqli_query($con,"SELECT sum(PurchasedPrice)as expanses FROM downloads WHERE IsPaid=1 AND IsSellerHasAllowedDownload=1 AND Downloader=$member and IsActive=1");
                                $r4=mysqli_fetch_assoc($s4);
                                if(empty($r4['expanses'])){
                                    echo "0";
                                }
                                else{
                                    echo $r4['expanses'];
                                }
                                ?></a></td>
                                <td><a>$<?php
                                $s5=mysqli_query($con,"SELECT sum(PurchasedPrice) as earn FROM downloads WHERE IsPaid=1 AND IsSellerHasAllowedDownload=1 AND Seller=$member and IsActive=1");
                                $r5=mysqli_fetch_assoc($s5);
                                if(empty($r5['earn'])){
                                    echo "0";
                                }
                                else{
                                    echo $r5['earn'];
                                }
                                ?></a></td>
                                <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="member-details.php?id=<?php echo $member; ?>" class="dropdown-item" type="button">View More Notes</a>
                                    <a href="../php/deactivate.php?id=<?php echo $member; ?>" class="dropdown-item" type="button" onclick="return confirm('Are you sure you want to make this member inactive?')">Deactivate</a>
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
                    targets:[10],
                    orderable:false,
                }]
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table.search(x).draw();

            });
        });
</script>

</html>