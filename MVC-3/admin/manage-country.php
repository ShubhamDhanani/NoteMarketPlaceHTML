<?php 
session_start();
include '../php/dbcon.php';
$pagename="Manage_Country";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
if(isset($_GET['editcountry'])){
    $id = $_GET['editcountry'];
    $mem = $_SESSION['id'];
    
    $up = mysqli_query($con,"UPDATE countries SET IsActive=0,ModifiedDate=current_timestamp(),ModifiedBy=$mem where ID=$id");
    
    if($up){
        header("location:manage-country.php");
    }
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
                <div class="heading col-md-6">Manage Country</div>
            </div>
            <br>
            <div class="row">
                <div class="admin_button col-md-4 col-sm-6 col-12">
                    <a href="add_country.php" style="text-decoration:none;"><button type="button" class="btn btn-primary admin_btn">Add Country</button></a>
                </div>
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
                            <th scope="col" style="width: 5%;">sr no.</th>
                            <th scope="col" style="width: 15%;">Country name</th>
                            <th scope="col" style="width: 5%;">country code</th>
                            <th scope="col" style="width: 20%;">date added</th>
                            <th scope="col" style="width: 15%;">added by</th>
                            <th scope="col" style="width: 5%;">active</th>
                            <th scope="col" style="width: 5%;">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $select=mysqli_query($con,"SELECT * FROM countries");
                        
                            $sr=1;
                            
                            while($res=mysqli_fetch_assoc($select)){
                                $user = $res['CreatedBy'];
                                $sel_user = mysqli_query($con,"select concat(FirstName,' ',LastName) as user from users where ID=$user");
                                $re = mysqli_fetch_assoc($sel_user);
                                $username=$re['user'];
                                ?>
                                <tr>
                                <td><?php echo $sr; ?></td>
                                <td><?php echo $res['Name']; ?></td>
                                <td><?php echo $res['CountryCode']; ?></td>
                                <td><?php echo $res['CreatedDate']; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php if($res['IsActive']==1){ echo "Yes";}
                                else{echo "No";}
                                ?></td>
                                <td>
                                <a href="add_country.php?editcountry=<?php echo $res['ID']; ?>" class="icon"><img src="../images/icons/edit.png"></a>
                                <a href="manage-country.php?editcountry=<?php echo $res['ID']; ?>" class="icon"><img src="../images/icons/delete.png"></a>
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
                    targets:[6],
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