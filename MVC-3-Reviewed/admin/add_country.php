<?php 
session_start();
include '../php/dbcon.php';
$pagename="Add_Country";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}

$mem = $_SESSION['id'];
if(isset($_GET['editcountry'])){
    $id=$_GET['editcountry'];
    $_SESSION['country']=$id;
    $sel = mysqli_query($con,"select * from countries where ID=$id");
    $re = mysqli_fetch_assoc($sel);
}

if(isset($_POST['submit'])){
    $country= mysqli_real_escape_string($con,$_POST['country'] );
    $ccode= mysqli_real_escape_string($con,$_POST['ccode'] );
    
    $insert = mysqli_query($con,"INSERT INTO countries(Name,CountryCode,CreatedBy) values('$country','$ccode',$mem)");
    
    if($insert){
        header("location:manage-country.php");
    }
}

if(isset($_POST['update'])){
    $country= mysqli_real_escape_string($con,$_POST['country'] );
    $ccode= mysqli_real_escape_string($con,$_POST['ccode'] );
    $id = $_SESSION['country'];
    $update = mysqli_query($con,"UPDATE countries set Name='$country',CountryCode='$ccode',ModifiedDate=current_timestamp(),ModifiedBy=$mem where ID=$id");
    
    if($update){
        header("location:manage-country.php");
    }
    unset($_SESSION['country']);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header-admin.php'; ?>
<!-- User Form -->
<div class="white_space"></div>
<div class="container form-wrap">
    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <div class="user-heading">
            <h3>Add Country</h3>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="exampleInputfname">Country Name *</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your country name" pattern="[a-zA-Z -  ]{2,}" title="At least two letters Required and all character must be alphabets" required name="country" <?php if(isset($_GET['editcountry'])){echo 'value='.$re['Name'];} ?>>
                </div>
                <div class="form-group">
                    <label for="exampleInputfname">Country Code *</label>
                    <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your country code" pattern="[0-9 --  +]{2,}" title="At least two numbers Required and all character must be 
                        Numeric and + is allowed" required name="ccode" <?php if(isset($_GET['editcountry'])){echo 'value='.$re['CountryCode'];} ?>>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-bottom-60 m-top-30" id="submit-btn-user" name="<?php if(isset($_GET['editcountry'])){echo "update";}
            else{echo "submit";}?>">
            <?php if(isset($_GET['editcountry'])){echo "UPDATE";}
            else{echo "SUBMIT";}?>
        </button>
    </form>
</div>
<?php include '../php/footer.php'; ?>

</html>