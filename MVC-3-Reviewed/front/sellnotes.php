<?php 
session_start();
include '../php/dbcon.php';
$pagename = "SellNotes";
$table= "yes";

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../php/front-header.php'; ?>
<!--   dashboard   -->
<div class="container">
    <div class="white_space"></div>
    <section class="dashboard_top">
        <div class="container">
            <div class="row">
                <div class="main_heading col-md-6 col-6">Dashboard</div>
                <div class="add_btn col-md-6 col-6">
                    <a href="add_notes.php" style="text-decoration: none;"><button type="button" class="btn btn-primary add_note_btn">ADD Note</button></a>
                </div>
            </div>
            <div class="row">
                <div class="boxes col-md-2">
                    <div class="earning_box">
                        <div class="earning_img text-center">
                            <img src="../images/icons/earning-icon.svg"><br>
                            <span class="heading">My Earning</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-4">
                    <div class="sold_box">
                        <div class="col-md-6 sold">
                            <a href="my_sold_notes.php" style="text-decoration:none;">
                                <span class="heading">
                                    <?php
                                $user = $_SESSION['id'];
                                $sold=mysqli_query($con,"SELECT * FROM downloads WHERE Seller=$user and IsSellerHasAllowedDownload=1 AND IsActive=1");
                                $count_sold = mysqli_num_rows($sold);
                                echo $count_sold;
                                ?>

                                </span></a><br>
                            <span class="sub_heading">Numbers of Notes Sold</span>
                        </div>
                        <div class="myearning">
                            <span class="heading">$
                                <?php
                            $earn = mysqli_query($con,"SELECT SUM(PurchasedPrice)as earned FROM downloads WHERE Seller=$user and IsSellerHasAllowedDownload=1 AND IsActive=1");
                            $earnr = mysqli_fetch_assoc($earn);
                            echo $earnr['earned'];
                            ?>
                            </span><br>
                            <span class="sub_heading">Money Earned</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="download_box">
                        <a href="mydownloads.php" style="text-decoration:none;">
                            <span class="heading">
                                <?php
                            $down = mysqli_query($con,"SELECT * from downloads WHERE Downloader=$user AND IsSellerHasAllowedDownload=1 AND IsActive=1");
                            $count_down = mysqli_num_rows($down);
                            echo $count_down;
                            ?>
                            </span></a><br>
                        <span class="sub_heading">My Downloads</span>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="reject_box">
                        <a href="my_rejected_notes.php" style="text-decoration:none;">
                            <span class="heading">
                                <?php
                                $reject = mysqli_query($con,"SELECT COUNT(ID)as rejected FROM `sellernotes` WHERE SellerID=$user AND Status=10 AND IsActive=1");
                                $res_rej = mysqli_fetch_assoc($reject);
                                echo $res_rej['rejected'];
                                ?>
                            </span></a><br>
                        <span class="sub_heading">My Rejected Notes</span>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="request_box">
                        <a href="buyer_request.php" style="text-decoration:none;">
                            <span class="heading">
                                <?php
                            $buyer = mysqli_query($con,"SELECT COUNT(ID) as buyer FROM downloads WHERE Seller=$user AND IsSellerHasAllowedDownload=0 AND IsActive=1 ");
                            $res_buyer = mysqli_fetch_assoc($buyer);
                            $buyer_req = $res_buyer['buyer'];
                            echo $buyer_req;
                            ?>
                            </span></a><br>
                        <span class="sub_heading">Buyer Requests</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--   dashboard table up  -->
    <section class="dashboard_table">
        <div class="container">
            <div class="row">
                <div class="heading col-md-4 col-sm-6 col-12">In Progress Notes</div>
                <div class="col-md-8 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row" style="margin-right:-30px;">
                            <div class="col-md-8 col-sm-8 col-8">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" placeholder="Search" id="searchtext1">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-4 search_button">
                                <button type="submit" class="btn btn-primary search_btn search1" id="search_btn1">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row booktable table-responsive">
                <table class="table table-hover table-responsive table1">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%">SR No.</th>
                            <th scope="col" style="width: 10%">Added date</th>
                            <th scope="col" style="width: 30%">title</th>
                            <th scope="col" style="width: 20%">category</th>
                            <th scope="col" style="width: 20%">status</th>
                            <th scope="col" style="width: 20%">actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                        
                        $user = $_SESSION['id'];
                        
                        $selectquery = "SELECT sellernotes.ID,sellernotes.CreatedDate as added_date, sellernotes.Title , notecategories.Name as category, referencedata.value as Status
                        FROM sellernotes, notecategories, referencedata
                        WHERE sellernotes.Category = notecategories.ID and sellernotes.Status=referencedata.ID AND sellernotes.SellerID=$user AND sellernotes.Status IN(6,7,8) and sellernotes.IsActive=1 order by added_date DESC";
                        $select = mysqli_query($con,$selectquery);
                        $sr=1;
                        
                        while($result = mysqli_fetch_array($select)){
                            ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $result['added_date'];?></td>
                            <td><?php echo $result['Title'];?></td>
                            <td><?php echo $result['category'];?></td>
                            <td><?php echo $result['Status'];?></td>
                            <?php if($result['Status'] == "Draft"){
                                ?>
                            <td>
                                <a href="updatenote.php?id=<?php echo $result['ID'];?>" class="icon" title="Update"><img src="../images/icons/edit.png"></a>
                                <a href="../php/deletenote.php?id=<?php echo $result['ID'];?>" class="icon" title="Delete"><img src="../images/icons/delete.png"></a>
                            </td>
                            <?php
                            }else{
                                ?>
                            <td><a href="note-details.php?id=<?php echo $result['ID']; ?>" class="icon" title="View"><img src="../images/icons/eye.png"></a></td>
                            <?php
                            }
                                ?>
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
    <!--   dashboard table down  -->
    <section class="dashboard_table">
        <div class="container">
            <div class="row">
                <div class="heading col-md-4 col-sm-6 col-12">Published Notes</div>
                <div class="col-md-8 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row" style="margin-right:-30px;">
                            <div class="col-md-8 col-sm-8 col-7">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" placeholder="Search" id="searchtext2">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-5 search_button">
                                <button type="submit" class="btn btn-primary search_btn search2">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row booktable table-responsive">
                <table class="table table-hover table-responsive table2">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%">SR No.</th>
                            <th scope="col" style="width: 10%">Added date</th>
                            <th scope="col" style="width: 30%">title</th>
                            <th scope="col" style="width: 20%">category</th>
                            <th scope="col" style="width: 20%">sell type</th>
                            <th scope="col" style="width: 20%">price</th>
                            <th scope="col" style="width: 20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                       
                    $user = $_SESSION['id'];
                        
                        $selectquery1 = "SELECT sellernotes.CreatedDate as added_date,sellernotes.Title,notecategories.Name as category, referencedata.value,sellernotes.SellingPrice FROM sellernotes , notecategories,referencedata WHERE sellernotes.Category = notecategories.ID AND sellernotes.IsPaid = referencedata.ID AND  sellernotes.SellerID=$user AND sellernotes.Status=9 and sellernotes.IsActive=1 order by added_date DESC";
                        $select1 = mysqli_query($con,$selectquery1);
                        
                        $sn=1;    
                        
                    
                        
                    while($result1 = mysqli_fetch_array($select1)){
                            ?>
                        <tr>
                            <td><?php echo $sn;?></td>
                            <td><?php echo $result1['added_date'];?></td>
                            <td><?php echo $result1['Title'];?></td>
                            <td><?php echo $result1['category'];?></td>
                            <td><?php echo $result1['value']; ?></td>
                            <td><?php echo $result1['SellingPrice'];?></td>

                            <td><a href="#" class="icon"><img src="../images/icons/eye.png"></a></td>
                            <?php
                                $sn++;
                            }
                                ?>
                        </tr>
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
                targets: [5],
                orderable: false,
            }]
        });

        $('.search1').click(function() {
            var x = $('#searchtext1').val();
            table.search(x).draw();

        });

    });
</script>
<script>
    $(document).ready(function() {
        var table = $('.table2').DataTable({
            'sDom': '"top"i',
            "iDisplayLength": 5,
            language: {
                paginate: {
                    next: '<img src="../images/icons/right-arrow.png">',
                    previous: '<img src="../images/icons/left-arrow.png">'
                }
            },
            columnDefs: [{
                targets: [6],
                orderable: false,
            }]
        });

        $('.search2').click(function() {
            var x = $('#searchtext2').val();
            table.search(x).draw();

        });

    });
</script>


</html>