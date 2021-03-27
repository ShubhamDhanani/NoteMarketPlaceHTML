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
                            <span class="heading">100</span><br>
                            <span class="sub_heading">Numbers of Notes Sold</span>
                        </div>
                        <div class="myearning">
                            <span class="heading">$10,00,000</span><br>
                            <span class="sub_heading">Money Earned</span>
                        </div>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="download_box">
                        <span class="heading">38</span><br>
                        <span class="sub_heading">My Downloads</span>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="reject_box">
                        <span class="heading">12</span><br>
                        <span class="sub_heading">My Rejected Notes</span>
                    </div>
                </div>
                <div class="boxes col-md-2">
                    <div class="request_box">
                        <span class="heading">102</span><br>
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
                        <div class="row">
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
                        WHERE sellernotes.Category = notecategories.ID and sellernotes.Status=referencedata.ID AND sellernotes.SellerID=$user AND sellernotes.Status IN(6,7,8)";
                        $select = mysqli_query($con,$selectquery);
                        
                        
                        while($result = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                            <td><?php echo $result['added_date'];?></td>
                            <td><?php echo $result['Title'];?></td>
                            <td><?php echo $result['category'];?></td>
                            <td><?php echo $result['Status'];?></td>
                            <?php if($result['Status'] == "Draft"){
                                ?>
                                <td>
                                <a href="../php/updatenote.php?id=<?php echo $result['ID'];?>" class="icon" title="Update"><img src="../images/icons/edit.png"></a>
                                <a href="../php/deletenote.php?id=<?php echo $result['ID'];?>" class="icon" title="Delete"><img src="../images/icons/delete.png"></a>
                                </td>
                                <?php
                            }else{
                                ?>
                                <td><a href="#" class="icon" title="View"><img src="../images/icons/eye.png"></a></td>
                                <?php
                            }
                                ?>
                            </tr>
                            <?php
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
                        <div class="row">
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
                        
                        $selectquery1 = "SELECT sellernotes.CreatedDate as added_date,sellernotes.Title,notecategories.Name as category, referencedata.value,sellernotes.SellingPrice FROM sellernotes , notecategories,referencedata WHERE sellernotes.Category = notecategories.ID AND sellernotes.IsPaid = referencedata.ID AND  sellernotes.SellerID=$user AND sellernotes.Status=9";
                        $select1 = mysqli_query($con,$selectquery1);
                        
                        
                    
                        
                    while($result1 = mysqli_fetch_array($select1)){
                            ?>
                            <tr>
                            <td><?php echo $result1['added_date'];?></td>
                            <td><?php echo $result1['Title'];?></td>
                            <td><?php echo $result1['category'];?></td>
                            <td><?php echo $result1['value']; ?></td>
                            <td><?php echo $result1['SellingPrice'];?></td>
                            
                            <td><a href="#" class="icon"><img src="../images/icons/eye.png"></a></td>
                                <?php
                            }
                                ?>
                            </tr>
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
                }
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
                }
            });

            $('.search2').click(function() {
                var x = $('#searchtext2').val();
                table.search(x).draw();

            });

        });
    </script>


</html>