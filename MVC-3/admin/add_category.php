<?php 
session_start();
include '../php/dbcon.php';
$pagename="Add_Category";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}
$mem = $_SESSION['id'];
if(isset($_GET['editcate'])){
    $id=$_GET['editcate'];
    $_SESSION['cate']=$id;
    $sel = mysqli_query($con,"select * from notecategories where ID=$id");
    $re = mysqli_fetch_assoc($sel);
}

if(isset($_POST['submit'])){
    $category= mysqli_real_escape_string($con,$_POST['category'] );
    $desc= mysqli_real_escape_string($con,$_POST['desc'] );
    
    $insert = mysqli_query($con,"INSERT INTO notecategories(Name,Description,CreatedBy) values('$category','$desc',$mem)");
    
    if($insert){
        header("location:manage-category.php");
    }
}

if(isset($_POST['update'])){
    $category= mysqli_real_escape_string($con,$_POST['category'] );
    $desc= mysqli_real_escape_string($con,$_POST['desc'] );
    $id = $_SESSION['cate'];
    $update = mysqli_query($con,"UPDATE notecategories set Name='$category',Description='$desc',ModifiedDate=current_timestamp(),ModifiedBy=$mem where ID=$id");
    
    if($update){
        header("location:manage-category.php");
    }
    unset($_SESSION['cate']);
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
                <h3>Add Category</h3>
            </div>
             
            <div class="row">


                <div class="col-md-8">

                    <div class="form-group">
                        <label for="exampleInputfname">Category Name *</label>
                        <input type="text" class="form-control" id="exampleInputfname" placeholder="Enter your category" pattern="[a-zA-Z]{2,}" title="At least two letters Required and all character must be alphabets" required name="category" <?php if(isset($_GET['editcate'])){echo 'value='.$re['Name'];} ?>  >
                    </div>

                    <div class="form-group">
                        <label for="exampleInputfname">Description *</label>
                        <textarea class="form-control" id="exampleInputfname" placeholder="Enter your Description" rows="5" required name="desc"><?php if(isset($_GET['editcate'])){echo $re['Description'];} ?></textarea>
                    </div>
                    
            </div>
             </div>
            <button type="submit" class="btn btn-primary m-bottom-60 m-top-30" id="submit-btn-user" name="<?php if(isset($_GET['editcate'])){echo "update";}
            else{echo "submit";}?>">
            <?php if(isset($_GET['editcate'])){echo "UPDATE";}
            else{echo "SUBMIT";}?>
            </button> 

         </form>
     </div>
            
 <?php include '../php/footer.php'; ?>

</html>