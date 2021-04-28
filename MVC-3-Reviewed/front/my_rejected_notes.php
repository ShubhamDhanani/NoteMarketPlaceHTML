<?php 
session_start();
include '../php/dbcon.php';
$pagename= "MyRejectedNotes";

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
                <div class="download_heading col-md-4 col-sm-6 col-12">My Rejected Notes</div>
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
                            <th scope="col" style="width: 20%;">Remarks</th>
                            <th scope="col" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user = $_SESSION['id'];
                        $select= mysqli_query($con,"SELECT sellernotes.ID,sellernotes.Title,notecategories.Name as category,sellernotes.AdminRemarks FROM sellernotes,notecategories WHERE sellernotes.Category=notecategories.ID AND sellernotes.Status=10 AND sellernotes.SellerID=$user and sellernotes.IsActive=1 order by sellernotes.ModifiedDate DESC");
                        $sr=1;
                        
                        while($res= mysqli_fetch_assoc($select)){
                            ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><a href="note-details.php?id=<?php echo $res['ID'];?>" style="text-decoration:none !important;" class="purple_text"><?php echo $res['Title']; ?></a></td>
                            <td><?php echo $res['category']; ?></td>
                            <td><?php echo $res['AdminRemarks']; ?></td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php 
                                    $noteid= $res['ID'];
                                    $path= mysqli_query($con,"SELECT FilePath from sellernotesattachements WHERE sellernotesattachements.NoteID=$noteid AND IsActive=1");
                                    $pathr = mysqli_fetch_assoc($path);
                                    $filepath = $pathr['FilePath'];
                                    ?>
                                    <a class="dropdown-item" type="button" href="<?php echo $filepath;?>" download>Download Note</a>
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
            columnDefs: [{
                targets: [4],
                orderable: false,
            }]
        });

        $('.search1').click(function() {
            var x = $('#searchtext1').val();
            table.search(x).draw();

        });

    });
</script>


</html>