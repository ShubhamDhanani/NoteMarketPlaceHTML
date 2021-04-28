<?php 
session_start();
include '../php/dbcon.php';
$pagename="Spam_Reports";

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
            <div class="download_heading col-md-4 col-sm-6 col-12">Spam Reports</div>
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
                        <th scope="col" style="width: 15%;">reported by</th>
                        <th scope="col" style="width: 20%;">note title</th>
                        <th scope="col" style="width: 5%;">category</th>
                        <th scope="col" style="width: 15%;">date edited</th>
                        <th scope="col" style="width: 30%;">remark</th>
                        <th scope="col" style="width: 5%;">action</th>
                        <th scope="col" style="width: 5%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            $select = mysqli_query($con,"SELECT sellernotesreportedissues.ID, sellernotesreportedissues.NoteID, concat(users.FirstName,' ',users.LastName) as reportby , sellernotes.Title, sellernotes.Category,sellernotesreportedissues.CreatedDate,sellernotesreportedissues.Remarks FROM sellernotesreportedissues LEFT JOIN users ON sellernotesreportedissues.ReportedByID=users.ID LEFT JOIN sellernotes ON sellernotesreportedissues.NoteID=sellernotes.ID WHERE sellernotesreportedissues.IsActive=1 order by sellernotesreportedissues.CreatedDate DESC");
                        
                            $sr=1;
                        
                            while($res=mysqli_fetch_assoc($select)){
                                $noteid = $res['NoteID'];
                                $cate =$res['Category'];
                                $sel_cat = mysqli_query($con,"SELECT notecategories.Name AS category FROM notecategories WHERE ID=$cate");
                                $resc = mysqli_fetch_assoc($sel_cat);
                                $category = $resc['category'];
                                ?>
                    <tr>
                        <td><?php echo $sr; ?></td>
                        <td><?php echo $res['reportby']; ?></td>
                        <td><a href="note-details.php?id=<?php echo $noteid; ?>" class="purple_text" style="text-decoration:none"><?php echo $res['Title']; ?></a></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $res['CreatedDate']; ?></td>
                        <td><?php echo $res['Remarks']; ?></td>
                        <td><a href="../php/delete_report.php?id=<?php echo $res['ID']; ?>"><img src="../images/icons/delete.png"></a></td>
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
            columnDefs: [{
                targets: [6, 7],
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