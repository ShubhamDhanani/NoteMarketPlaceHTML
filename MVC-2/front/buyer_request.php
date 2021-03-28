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
$pagename= "BuyerRequests";
$table= "yes";

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../php/front-header.php'; ?>
    <!--   My Downloads table-->
    <div class="white_space"></div>
    <section class="dashboard_top dashboard_table">
        <div class="container">
            <div class="row">
                <div class="download_heading col-md-4 col-sm-6 col-12">Buyer Requests</div>
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
                            <th scope="col" style="width: 5%">SR NO.</th>
                            <th scope="col" style="width: 15%">NOTE TITLE</th>
                            <th scope="col" style="width: 10%">category</th>
                            <th scope="col" style="width: 20%">buyer</th>
                            <th scope="col" style="width: 15%">Phone no.</th>
                            <th scope="col" style="width: 5%">sell type</th>
                            <th scope="col" style="width: 5%">price</th>
                            <th scope="col" style="width: 10%">downloaded date/time</th>
                            <th scope="col" style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        
                    $user = $_SESSION['id'];
                        
                        $selectquery = "SELECT sellernotes.Title, notecategories.Name as category,sellernotes.IsPaid as selltype, sellernotes.SellingPrice FROM sellernotes, notecategories WHERE sellernotes.Category = notecategories.ID AND sellernotes.SellerID=$user AND sellernotes.Status=9";
                        $select = mysqli_query($con,$selectquery);
                        
                        $sr=1;
                        
                        while($result = mysqli_fetch_array($select)){
                            ?>
                            <tr>
                            <td><?php echo $sr;?></td>
                            <td><?php echo $result['Title'];?></td>
                            <td><?php echo $result['category'];?></td>
                            <td><?php echo "temp123@gmail.com"?></td>
                            <td><?php echo "+91 9012345678"?></td>
                            <td><?php  if($result['selltype']){echo "Paid";}else{echo "Free";}?></td>
                            <td><?php echo $result['SellingPrice'];?></td>
                            <td><?php echo "2021-03-05 17:52:35";?></td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Allow Download</button>
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

</html>