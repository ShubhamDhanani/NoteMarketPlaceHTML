<?php 
session_start();
include '../php/dbcon.php';
$pagename="Add_Type";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}

$mem = $_SESSION['id'];
if(isset($_GET['edittype'])){
    $id=$_GET['edittype'];
    $_SESSION['type']=$id;
    $sel = mysqli_query($con,"select * from notetypes where ID=$id");
    $re = mysqli_fetch_assoc($sel);
}

if(isset($_POST['submit'])){
    $type= mysqli_real_escape_string($con,$_POST['type'] );
    $desc= mysqli_real_escape_string($con,$_POST['desc'] );
    
    $insert = mysqli_query($con,"INSERT INTO notetypes(Name,Description,CreatedBy) values('$type','$desc',$mem)");
    
    if($insert){
        header("location:manage-type.php");
    }
}

if(isset($_POST['update'])){
    $type= mysqli_real_escape_string($con,$_POST['type'] );
    $desc= mysqli_real_escape_string($con,$_POST['desc'] );
    $id = $_SESSION['type'];
    $update = mysqli_query($con,"UPDATE notetypes set Name='$type',Description='$desc',ModifiedDate=current_timestamp(),ModifiedBy=$mem where ID=$id");
    
    if($update){
        header("location:manage-type.php");
    }
    unset($_SESSION['type']);
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
                <h3>Add Type</h3>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputfname">Type *</label>
                        <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your type" pattern="[a-zA-Z -  ]{2,}" title="At least two letters Required and all character must be alphabets" required name="type" <?php if(isset($_GET['edittype'])){echo 'value='.$re['Name'];} ?>>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputfname">Description *</label>
                        <textarea class="form-control" id="exampleInputfname" placeholder="Enter your Description" rows="5" required name="desc"><?php if(isset($_GET['edittype'])){echo $re['Description'];} ?> </textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-bottom-60 m-top-30" id="submit-btn-user" name="<?php if(isset($_GET['edittype'])){echo "update";}
            else{echo "submit";}?>">
            <?php if(isset($_GET['edittype'])){echo "UPDATE";}
            else{echo "SUBMIT";}?>
            </button>
        </form>
    </div>

 <?php include '../php/footer.php'; ?>

</html>