<?php 
session_start();
include '../php/dbcon.php';
$pagename="Manage_Admin";

if(isset($_GET['delete'])){
    $mem = $_SESSION['id'];
    $user=$_GET['delete'];
    $up = mysqli_query($con,"update users set IsActive=0,ModifiedDate=current_timestamp(),ModifiedBy=$mem where ID=$user");
    if($up){
        header("location:manage-administrator.php");
    }
}

if(!isset($_SESSION['fname']) or $_SESSION['role']==3 or $_SESSION['role']==2){
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
                <div class="heading col-md-6">Manage Administrator</div>
            </div>
            <br>
            <div class="row">
                <div class="admin_button col-md-4 col-sm-6 col-12">
                    <a href="add_administrator.php" style="text=decoration:none;"><button type="button" class="btn btn-primary admin_btn">Add Administrator</button></a>
                </div>
                <br>
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
                            <th scope="col" style="width: 10%;">first name</th>
                            <th scope="col" style="width: 10%;">last name</th>
                            <th scope="col" style="width: 20%;">email</th>
                            <th scope="col" style="width: 15%;">phone no.</th>
                            <th scope="col" style="width: 15%;">date added</th>
                            <th scope="col" style="width: 5%;">active</th>
                            <th scope="col" style="width: 10%;">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $select=mysqli_query($con,"select * from users where RoleID=2");
                        
                        $sr=1;
                        
                        while($res=mysqli_fetch_assoc($select)){
                            $user = $res['ID'];
                            $sel_phone = mysqli_query($con,"SELECT concat(PhoneNumber_CountryCode,' ',PhoneNumber) as phone FROM userprofile WHERE UserID=$user");
                            $resp=mysqli_fetch_assoc($sel_phone);
                            $phone = $resp['phone'];
                            ?>
                            <tr>
                                <td><?php echo $sr; ?></td>
                                <td><?php echo $res['FirstName']; ?></td>
                                <td><?php echo $res['LastName']; ?></td>
                                <td><?php echo $res['EmailID']; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><?php echo $res['CreatedDate']; ?></td>
                                <td><?php if($res['IsActive']==1){ echo "Yes";}
                                else{echo "No";}
                                ?></td>
                                <td>
                                <a href="add_administrator.php?editadmin=<?php echo $user; ?>" class="icon"><img src="../images/icons/edit.png"></a>
                                <a href="manage-administrator.php?delete=<?php echo $user;?>" class="icon"><img src="../images/icons/delete.png"></a>
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