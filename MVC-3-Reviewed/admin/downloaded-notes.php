<?php 
session_start();
include '../php/dbcon.php';
$pagename="Downloaded_Notes";

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
    <section class="dashboard_table ">
        <div class="container">
            <div class="row">
                <div class="heading col-md-6">Downloaded Notes</div>
            </div>
            <div class="row">
                <div class="small_text col-md-12 col-12">
                    <div class="col-md-2 col-4" style="float: left; padding-left:0px;  margin-top:15px">Note</div>
                    <div class="col-md-2 col-4" style="float: left; padding-left:0px;  margin-top:15px">Seller</div>
                    <div class="col-md-2 col-4" style="float: left; padding-left:0px;  margin-top:15px">Buyer</div>
                </div>
                <div class="col-md-2 col-4" style="padding-top: 20px; padding-left: 0;">

                    <select class="btn-group small_text select1 col-md-12 col-12" style="height:40px;margin-top:0px;" <?php if(isset($_GET['title'])){echo "disabled";}?>>
                        <option class="filter-option" value="">---</option>
                        <?php
                        $title=mysqli_query($con,"SELECT DISTINCT NoteTitle FROM downloads Where IsActive=1");
                        while($rest=mysqli_fetch_assoc($title)){
                            ?>
                        <option value="<?php echo $rest['NoteTitle']?>" <?php if(isset($_GET['title'])){
                                if($rest['NoteTitle']==$_GET['title']){echo "selected";}
                            } ?>><?php echo $rest['NoteTitle']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 col-4" style="padding-top: 20px; padding-left: 0;">

                    <select class="btn-group small_text select2 col-md-12 col-12" style="height:40px;margin-top:0px;">
                        <option class="filter-option" value="">---</option>
                        <?php
                        $seller=mysqli_query($con,"SELECT DISTINCT downloads.Seller,concat(users.FirstName,' ',users.LastName)as sellers FROM downloads,users WHERE downloads.Seller=users.ID and downloads.IsActive=1");
                        while($ress=mysqli_fetch_assoc($seller)){
                            ?>
                        <option value="<?php echo $ress['sellers']?>"><?php echo $ress['sellers']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 col-4" style="padding-top: 20px; padding-left: 0;">

                    <select class="btn-group small_text select3 col-md-12 col-12" style="height:40px;margin-top:0px;" <?php if(isset($_GET['id']) or isset($_GET['idpaid'])){echo "disabled";} ?>>
                        <option class="filter-option" value="">---</option>
                        <?php
                        $buyer=mysqli_query($con,"SELECT DISTINCT downloads.Downloader,concat(users.FirstName,' ',users.LastName)as buyers FROM downloads,users WHERE downloads.Downloader=users.ID and downloads.IsActive=1  ");
                        while($resb=mysqli_fetch_assoc($buyer)){
                            ?>
                        <option value="<?php echo $resb['buyers']?>"><?php echo $resb['buyers']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row" style="padding-top: 24px;margin-right:-30px;">
                            <div class="col-md-8 col-sm-8 col-8">
                                <div class="search" style="padding-left: 0;">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" id="searchtext1" placeholder="Search" style="height: 40px;">
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
                            <th scope="col" style="width: 15%;">note title</th>
                            <th scope="col" style="width: 10%;">category</th>
                            <th scope="col" style="width: 25%;">seller</th>
                            <th scope="col" style="width: 5%;"></th>
                            <th scope="col" style="width: 25%;">buyer</th>
                            <th scope="col" style="width: 5%;"></th>
                            <th scope="col" style="width: 5%;">sell type</th>
                            <th scope="col" style="width: 5%;">price</th>
                            <th scope="col" style="width: 10%;">downloaded date/time</th>
                            <th scope="col" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET['title'])){
                                $tit = $_GET['title'];
                                $select=mysqli_query($con,"SELECT * FROM downloads WHERE IsAttachmentDownloaded=1 and NoteTitle='$tit' and IsActive=1 order by AttachmentDownloadedDate DESC");
                            }
                            elseif(isset($_GET['id'])){
                                $member = $_GET['id'];
                                $select=mysqli_query($con,"SELECT * FROM downloads WHERE IsAttachmentDownloaded=1 AND Downloader=$member and IsActive=1 order by AttachmentDownloadedDate DESC");
                            }
                            elseif(isset($_GET['idpaid'])){
                                $member = $_GET['idpaid'];
                                $select=mysqli_query($con,"SELECT * FROM downloads WHERE IsAttachmentDownloaded=1 AND IsPaid=1 AND Downloader=$member and IsActive=1 order by AttachmentDownloadedDate DESC");
                            }
                            elseif(isset($_GET['7day'])){
                                $select=mysqli_query($con,"SELECT * FROM downloads WHERE IsAttachmentDownloaded=1 and AttachmentDownloadedDate>NOW()-INTERVAL 7 day AND IsActive=1 order by AttachmentDownloadedDate DESC");
                            }
                            else{
                                $select=mysqli_query($con,"SELECT * FROM downloads WHERE IsAttachmentDownloaded=1 and IsActive=1 order by AttachmentDownloadedDate DESC");
                            }
                            
                            $sr=1;
                            while($result=mysqli_fetch_assoc($select)){
                                $noteid=$result['NoteID'];
                                $downloader= $result['Downloader'];
                                $down= mysqli_query($con,"select CONCAT(FirstName,' ',LastName) as buyer from users where ID=$downloader and IsActive=1");
                                $ressd = mysqli_fetch_assoc($down);
                                $buyer = $ressd['buyer'];                              
                                
                                $sell= $result['Seller'];
                                $seller= mysqli_query($con,"select CONCAT(FirstName,' ',LastName) as sellers from users where ID=$sell and IsActive=1");
                                $resss = mysqli_fetch_assoc($seller);
                                $selername = $resss['sellers'];
                                ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><a href="note-details.php?id=<?php echo $noteid; ?>" class="purple_text" style="text-decoration:none;"><?php echo $result['NoteTitle'];?></a></td>
                            <td><?php echo $result['NoteCategory']; ?></td>
                            <td><?php echo $selername ?></td>
                            <td><a href="member-details.php?id=<?php echo $sell; ?>"><img src="../images/icons/eye.png"></a></td>
                            <td><?php echo $buyer ?></td>
                            <td><a href="member-details.php?id=<?php echo $downloader; ?>"><img src="../images/icons/eye.png"></a></td>
                            <td><?php if($result['IsPaid']==0){echo "Free";}
                                        else{echo "Paid";}?></td>
                            <td>$<?php echo $result['PurchasedPrice']; ?></td>
                            <td><?php echo $result['AttachmentDownloadedDate']; ?></td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php
                                            $file= mysqli_query($con,"SELECT FilePath from sellernotesattachements WHERE sellernotesattachements.NoteID=$noteid and IsActive=1");
                                            $pathr = mysqli_fetch_assoc($file);
                                            $filepath = $pathr['FilePath'];
                                            ?>
                                    <a href="<?php echo $filepath; ?>" class="dropdown-item" type="button" download>Download Notes</a>
                                    <a href="note-details.php?id=<?php echo $noteid; ?>" class="dropdown-item" type="button">View More Notes</a>
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
            columnDefs: [{
                targets: [4, 6, 10],
                orderable: false,
            }]
        });

        $('.search1').click(function() {
            var x = $('#searchtext1').val();
            table.search(x).draw();

        });
        $('.select1').change(function() {
            var x = $(this).val();
            table.columns(1).search(x).draw();
        });
        $('.select2').change(function() {
            var x = $(this).val();
            table.columns(3).search(x).draw();
        });
        $('.select3').change(function() {
            var x = $(this).val();
            table.columns(5).search(x).draw();
        });

    });
</script>

</html>