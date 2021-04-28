<?php 
session_start();
include '../php/dbcon.php';
$pagename="Rejected_Notes";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header-admin.php'; ?>

<!--   dashboard table up  -->
<div class="white_space"></div>
<section class="dashboard_table">
    <div class="container">
        <div class="row">
            <div class="heading col-md-6">Rejected Notes</div>
        </div>
        <div class="row">
            <div class="small_text col-md-12">Seller</div>
            <div class="seller_drop col-md-2 col-4" style="padding-top: 20px;">

                <select class="btn-group small_text" style="height:40px;margin-top:2px;">
                    <option class="filter-option" value="">---</option>
                    <?php
                        $seller=mysqli_query($con,"SELECT sellernotes.Title ,CONCAT(users.FirstName ,' ',users.LastName) AS seller FROM sellernotes,users WHERE sellernotes.SellerID=users.ID AND sellernotes.Status=10 and sellernotes.IsActive=1 GROUP BY seller");
                        while($ress=mysqli_fetch_assoc($seller)){
                            ?>
                    <option value="<?php echo $ress['seller']?>"><?php echo $ress['seller']?></option>
                    <?php
                        }
                        ?>
                </select>
            </div>
            <div class="col-md-10 col-sm-8 col-12" style="padding-right: 0;">
                <div class="search-note">
                    <div class="row" style="padding-top: 25px;">
                        <div class="col-md-8 col-sm-8 col-8">
                            <div class="search" style="padding-left: 0;">
                                <img src="../images/icons/search-icon.png">
                                <input type="search" id="searchtext1" class="form-control" placeholder="Search" style="height: 40px;">
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
                        <th scope="col" style="width: 5%;">category</th>
                        <th scope="col" style="width: 10%;">seller</th>
                        <th scope="col" style="width: 5%;"></th>
                        <th scope="col" style="width: 15%;">date added</th>
                        <th scope="col" style="width: 15%;">rejected by</th>
                        <th scope="col" style="width: 20%;">remark</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        $select = mysqli_query($con,"SELECT sellernotes.ID,sellernotes.Title,notecategories.Name as category,concat(users.FirstName,' ',users.LastName) as seller,sellernotes.SellerID,sellernotes.CreatedDate,sellernotes.ActionedBy,sellernotes.AdminRemarks from sellernotes LEFT JOIN notecategories ON sellernotes.Category=notecategories.ID LEFT JOIN users ON sellernotes.SellerID=users.ID WHERE sellernotes.Status=10 and sellernotes.IsActive=1 order by sellernotes.CreatedDate DESC");
                        
                        $sr=1;
                        
                        while($res=mysqli_fetch_assoc($select)){
                            $noteid = $res['ID'];
                            $rej = $res['ActionedBy'];
                            $selr = mysqli_query($con,"select concat(FirstName,' ',LastName) as reject from users where ID=$rej AND IsActive=1");
                            $resr= mysqli_fetch_assoc($selr);
                            $rejectedby = $resr['reject'];
                            ?>
                    <tr>
                        <td><?php echo $sr; ?></td>
                        <td><a class="purple_text" href="note-details.php?id=<?php echo $noteid; ?>" style="text-decoration:none;"><?php echo $res['Title']; ?></a></td>
                        <td><?php echo $res['category']; ?></td>
                        <td><?php echo $res['seller']; ?></td>
                        <td><a href="member-details.php?id=<?php echo $res['SellerID']; ?>"><img src="../images/icons/eye.png"></a></td>
                        <td><?php echo $res['CreatedDate']; ?></td>
                        <td><?php echo $rejectedby; ?></td>
                        <td><?php echo $res['AdminRemarks']; ?></td>
                        <td>
                            <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php
                                        $file= mysqli_query($con,"SELECT FilePath from sellernotesattachements WHERE sellernotesattachements.NoteID=$noteid AND IsActive=1");
                                        $pathr = mysqli_fetch_assoc($file);
                                        $filepath = $pathr['FilePath'];
                                        ?>
                                <a href="../php/approve.php?id=<?php echo $noteid; ?>" class="dropdown-item" type="button" onclick="return confirm('If you approve the notes – System will publish the notes over portal. Please press ok to continue.')">Approve</a>
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

<!--    footer  -->
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
                targets: [4, 8],
                orderable: false,
            }]
        });

        $('.search1').click(function() {
            var x = $('#searchtext1').val();
            table.search(x).draw();

        });
        $('select').change(function() {
            var x = $(this).val();
            table.columns(3).search(x).draw();
        });

    });
</script>

</html>