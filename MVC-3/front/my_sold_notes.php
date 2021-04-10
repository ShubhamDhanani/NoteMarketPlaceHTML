
<?php 
session_start();
include '../php/dbcon.php';
$pagename= "MySoldNotes";
$table= "yes";

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../php/front-header.php'; ?>

    <!--   My Downloads table-->
<div class="container">
    <div class="white_space"></div>
    <section class="dashboard_top dashboard_table">
        <div class="container">
            <div class="row">
                <div class="download_heading col-md-4 col-sm-6 col-12">My Sold Notes</div>
                <div class="col-md-8 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row" style="margin-right:-30px;">
                            <div class="col-md-8 col-sm-8 col-7">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" id="searchtext1" placeholder="Search">
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
                            <th scope="col" style="width: 20%;">buyer</th>
                            <th scope="col" style="width: 10%;">sell type</th>
                            <th scope="col" style="width: 10%;">price</th>
                            <th scope="col" style="width: 20%;">downloaded date/time</th>
                            <th scope="col" style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            
                            $user = $_SESSION['id'];
                            $selectquery = "SELECT DISTINCT downloads.NoteID,downloads.AttachmentPath,downloads.NoteTitle,downloads.NoteCategory,users.EmailID,downloads.IsPaid,downloads.PurchasedPrice,downloads.AttachmentDownloadedDate FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID LEFT JOIN userprofile ON downloads.Downloader=userprofile.UserID WHERE downloads.IsSellerHasAllowedDownload=1 AND downloads.Seller=$user and downloads.IsActive=1 order by downloads.AttachmentDownloadedDate DESC";
                            $select = mysqli_query($con,$selectquery);
                        
                            $sr=1;
                            
                            while($result = mysqli_fetch_array($select)){
                                
                                $noteid = $result['NoteID'];
                                $path = $result['AttachmentPath'];
                                ?>
                                <tr>
                                    <td><?php echo $sr;?></td>
                                    <td><?php echo $result['NoteTitle'];?></td>
                                    <td><?php echo $result['NoteCategory'];?></td>
                                    <td><?php echo $result['EmailID'];?></td>
                                    <td><?php if($result['IsPaid']==0){echo "Free";} else{echo "Paid";}?></td>
                                    <td><?php echo $result['PurchasedPrice'];?></td>
                                    <td><?php echo $result['AttachmentDownloadedDate'];?></td>
                                    <td>
                                    <a href="note-details.php?id=<?php echo $noteid; ?>" class="icon"><img src="../images/icons/eye.png"></a>
                                    <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo $path; ?>" class="dropdown-item" type="button" download>Download Note</a>
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
</script>

</html>