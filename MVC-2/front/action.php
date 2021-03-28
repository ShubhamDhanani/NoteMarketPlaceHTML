<style>

</style>
<?php
session_start();
include '../php/dbcon.php';
if(isset($_POST['action'])){
    $sql = 'SELECT sellernotes.* ,AVG(Ratings) AS avgratings FROM sellernotes LEFT JOIN sellernotesreviews ON sellernotesreviews.NoteID=sellernotes.ID  GROUP BY sellernotes.ID HAVING sellernotes.Status=9';
    $_SESSION['action']=$_POST['action'];
    
    
    if(isset($_POST['type'])){
        $_SESSION['type']=$_POST['type'];
        $type = $_POST['type'];
        if($type==""){$sql .=' AND NoteType!=""';}
        else{$sql .=" AND NoteType IN($type)";}
        
    }
    
    if(isset($_POST['category'])){
        $_SESSION['category']=$_POST['category'];
        $category = $_POST['category'];
        if($category==""){$sql .=' AND Category!=""';}
        else{ $sql .=" AND Category IN('".$category."')";}
       
    }
    
    if(isset($_POST['university'])){
        $_SESSION['university']=$_POST['university'];
        $university = $_POST['university'];
        if($university==""){$sql .=' AND UniversityName!=""';}
        else{ $sql .=" AND UniversityName IN('".$university."')";}
        
    }
    
    if(isset($_POST['course'])){
        $_SESSION['course']=$_POST['course'];
        $course = $_POST['course'];
        if($course==""){$sql .=' AND Course!=""';}
        else{ $sql .=" AND Course IN('".$course."')";}
        
    }
    
    if(isset($_POST['country'])){
        $_SESSION['country']=$_POST['country'];
        $country = $_POST['country'];
        if($country==""){$sql .=' AND Country!=""';}
        else{ $sql .=" AND Country IN('".$country."')";}
    }
    
    if(isset($_POST['search'])){
        $_SESSION['search']=$_POST['search'];
        $sql .=" AND Title like '%".$_POST["search"]."%'";
    }
    
    if(isset($_POST['rating'])){
        $rating = $_POST['rating'];
        if($rating!=""){$sql .=" AND avgratings >= $rating";}
        
    }
}

    $pages= $_POST['page'];
    $num_per_page = 9;
    $start_from = ($pages - 1) * $num_per_page;
    
    $sql1 = $sql." LIMIT $start_from,$num_per_page";
    $result1 = mysqli_query($con,$sql1);
    
    $pagequery = mysqli_query($con,$sql);
    $totalrecords = mysqli_num_rows($pagequery);
    $total_pages = ceil($totalrecords / $num_per_page);
    if($totalrecords>0){
?>
<div class="container">
    <h2>Total <span><?php echo $totalrecords;?></span> notes </h2>
    <div class="row">
        <?php
        while($result=mysqli_fetch_assoc($result1)){
            ?>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="notes card" style="margin-top:20px;">
                <div class="card-img-top">
                    <img src="../Member/<?php echo $result['SellerID'].'/'.$result['ID'].'/'.$result['DisplayPicture'];?>" alt="note image" class="note-img img-fluid">
                </div>
                <div class="details card-body">
                    <a href="note-details.php?id=<?php echo $result['ID'];?>" style="text-decoration: none;">
                        <h4 class="card-title" style="font-size: 30px;line-height: 35px;"><?php echo $result['Title'];?></h4>
                    </a>
                    <p class="card-text"><img src="../images/icons/university.png"><?php echo $result['UniversityName'];?>,
                        <?php
                    $country = $result['Country'];
                    $selquery = "select Name From countries where ID=$country";
                    $querycon = mysqli_query($con,$selquery);
                    $selectedcon = mysqli_fetch_array($querycon);
                    echo $selectedcon['Name'];
                    ?>
                    </p>
                    <p class="card-text"><img src="../images/icons/pages.png"><?php echo $result['NumberofPages'];?> Pages</p>
                    <p class="card-text"><img src="../images/icons/date.png"><?php
                                $date = $result['CreatedDate'];
                                $timestamp = strtotime($date);
                                $new_date = date("D, M d Y", $timestamp);
                                echo $new_date;
                                ?></p>
                    <p class="card-text"><img src="../images/icons/flag.png">5 Users marked this note as inappropriate</p>
                    <div class="ratings">
                           <p>
                            <span class="search_rate">
                                <?php
                                $note = $result['ID'];
                                $s="SELECT COUNT(sellernotesreviews.Ratings) as totalr, avg(sellernotesreviews.Ratings) as rate from sellernotesreviews WHERE sellernotesreviews.NoteID=$note";
                                $sq=mysqli_query($con,$s);
                                $rs=mysqli_fetch_array($sq);
                                $rat = $rs['rate'];
                                $rate = floor($rat);
                                $totalrate = $rs['totalr'];
                                $i = 1;
                                while($i<6){
                                    if($i<=$rate){
                                        ?>
                                <img src="../images/icons/star.png" style="width:20px;margin-right:0;margin-top:-2px;">
                                <?php
                                    }
                                    else{
                                        ?>
                                <img src="../images/icons/star-white.png" style="width:20px;margin-right:0;margin-top:-2px;">
                                <?php
                                    }
                                    $i++;
                                }
                                
                                
                            ?>
                            </span>
                        <?php echo $totalrate; ?> reviews</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
            
        }
    ?>
    </div>
</div>
<?php
    }
    ?>
<section class="pages">
    <div class="container">
        <div class="row">
            <ul class="pagination" id="paginationid">
                <li class="<?php if($pages == 1){ echo 'disabled'; }?> page-item">
                    <?php 
                $prev_page = $pages - 1;
                ?>
                    <a class="page-link " id="<?php echo $prev_page; ?>" href="#" aria-label="Previous">
                        <span aria-hidden="true"><img src="../images/icons/left-arrow.png" alt="previous"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php 
                for ($i = 1; $i <= $total_pages; $i++) {
                ?>
                <li class='page-item <?php if ($pages == $i) { echo "active"; } ?>'>
                    <a id='<?php echo $i; ?>' class="page-link" href="#">
                        <?php echo $i; ?>
                    </a>
                </li>
                <?php
                }
            ?>


                <li class="<?php if($pages == $total_pages){ echo 'disabled'; }?> page-item">
                    <?php 
            $next_page = $pages + 1;
            ?>
                    <a class="page-link" id="<?php echo $next_page; ?>" href="#" aria-label="Next">
                        <span aria-hidden="true"><img src="../images/icons/right-arrow.png" alt="Next"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>