<?php 
session_start();
include '../php/dbcon.php';
$pagename="SearchNotes";
$table= "no";
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../php/front-header.php'; ?>    
    
    <!-- home -->
    <section class="search_header ">
        <div class="m-top-100">
            <div class="search-image">
                <div class="search-text">
                    <h1>Search Notes</h1>
                </div>
            </div>
        </div>
    </section>
    <!--    search box -->
    <section id="search-note">
        <div class="container">
            <div class="search-filters">
                <h2>Search and Filter Notes</h2>
                <div class="filter-inputs">
                    <div class="filter-search">
                        <img src="../images/icons/search-icon.png" alt="search"><input type="search" class="form-control filters" placeholder="Search notes here...">
                    </div>
                    <div class="filters-other">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02">
                                    <option value="">Select type</option>
                                    <?php
                                    $type = "select * from notetypes where IsActive=1";
                                    $typequery = mysqli_query($con,$type);
                                    $typerows = mysqli_num_rows($typequery);
                                    for($i=1;$i<=$typerows;$i++){
                                    $typerow = mysqli_fetch_array($typequery);
                                    ?>
                                    <option value="<?php echo $typerow['ID'];?>" ><?php echo $typerow['Name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02">
                                    <option value="">Select Category</option>
                                    <?php
                                    $category = "select * from notecategories where IsActive=1";
                                    $categoryquery = mysqli_query($con,$category);
                                    $categoryrows = mysqli_num_rows($categoryquery);
                                    for($i=1;$i<=$categoryrows;$i++){
                                    $categoryrow = mysqli_fetch_array($categoryquery);
                                    ?>
                                    <option value="<?php echo $categoryrow['ID'];?>" ><?php echo $categoryrow['Name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02">
                                    <option value="">Select University</option>
                                    <?php
                                    $uni = "SELECT DISTINCT UniversityName FROM sellernotes WHERE IsActive=1";
                                    $uniquery = mysqli_query($con,$uni);
                                    $unirows = mysqli_num_rows($uniquery);
                                    for($i=1;$i<=$unirows;$i++){
                                    $unirow = mysqli_fetch_array($uniquery);
                                    ?>
                                    <option value="<?php echo $unirow['UniversityName'];?>" ><?php echo $unirow['UniversityName'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02">
                                    <option value="">Select Course</option>
                                    <?php
                                    $course = "SELECT DISTINCT Course FROM sellernotes WHERE IsActive=1";
                                    $coursequery = mysqli_query($con,$course);
                                    $courserows = mysqli_num_rows($coursequery);
                                    for($i=1;$i<=$courserows;$i++){
                                    $courserow = mysqli_fetch_array($coursequery);
                                    ?>
                                    <option value="<?php echo $courserow['Course'];?>" ><?php echo $courserow['Course'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02">
                                    <option value="">Select Country</option>
                                    <?php
                                    $country = "select * from countries where IsActive=1";
                                    $countryquery = mysqli_query($con,$country);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    for($i=1;$i<=$countryrows;$i++){
                                    $countryrow = mysqli_fetch_array($countryquery);
                                    ?>
                                    <option value="<?php echo $countryrow['ID'] ?>" ><?php echo $countryrow['Name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02">
                                    <option value="">Select Rating</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<!--    books  -->
    <div class="search-result">
       
       <?php
        
        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        $page =mysqli_real_escape_string($con,$page);
                        $page = htmlentities($page);
                    }else{
                        $page = 1;
                    }
                    
                    $num_per_page = 9;
                    $start_from = ($page-1) * $num_per_page;
        
        $selectquery="select sellernotes.Title,sellernotes.UniversityName,countries.Name,sellernotes.NumberofPages,sellernotes.CreatedDate from sellernotes,countries where sellernotes.Country=countries.ID ORDER BY sellernotes.CreatedDate DESC LIMIT $start_from,$num_per_page";
        $squery= mysqli_query($con,$selectquery);
        
        $numquery = "SELECT * FROM sellernotes";
        $noquery = mysqli_query($con,$numquery);
        $totalrecords = mysqli_num_rows($noquery);
        $total_pages = ceil($totalrecords / $num_per_page);
        ?>
        <div class="container">
          <h2>Total <span><?php echo $totalrecords;?></span> notes </h2>
           <div class="row">
           <?php 
               while($result=mysqli_fetch_array($squery)){
                   ?>
                   <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="notes card" style="margin-top:20px;">
                    <div class="card-img-top">
                        <img src="../images/books/1.png" alt="note image" class="note-img img-fluid">
                        </div>
                        <div class="details card-body">
                            <a href="note-details.php" style="text-decoration: none;"><h4 class="card-title" style="font-size: 30px;line-height: 35px;"><?php echo $result['Title'];?></h4></a>
                            <p class="card-text"><img src="../images/icons/university.png"><?php echo $result['UniversityName'];?>, <?php echo $result['Name'];?></p>
                            <p class="card-text"><img src="../images/icons/pages.png"><?php echo $result['NumberofPages'];?> Pages</p>
                            <p class="card-text"><img src="../images/icons/date.png"><?php
                                $date = $result['CreatedDate'];
                                $timestamp = strtotime($date);
                                $new_date = date("D, M d Y", $timestamp);
                                echo $new_date;
                                ?></p>
                            <p class="card-text"><img src="../images/icons/flag.png">5 Users marked this note as inappropriate</p>
                            <div class="ratings">
                                <div class="rate">
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star3" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 star</label>
                                </div>
                                <p>100 reviews</p>
                            </div>
                        </div>
                </div>
            </div>
                   <?php
               }
               
            ?>
            
            
            </div>
        </div>
    </div>


    <!--    Pagination   -->
    <section class="pages">
        <div class="container">
            <div class="row">
                <ul class="pagination">
                    <li class="page-item <?php if($page == 1){ echo 'disabled'; }?>">
                        <a class="page-link page-link-icon" href="SEARCH.php?page=<?php echo $page-1 ; ?>" aria-label="Previous">
                            <img src="../images/icons/left-arrow.png">
                        </a>
                    </li>
                    <?php
                    
                        for($i=1;$i<=$total_pages;$i++){
                            ?>
                            <li class="page-item"><a class="page-link <?php if($page == $i) { echo 'active'; }
                                ?> " href="SEARCH.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a></li>
                            <?php
                        }
                    
                    ?>
                                
                    <li class="page-item <?php if($page == $total_pages){ echo 'disabled'; }?>">
                        <a class="page-link page-link-icon" href="SEARCH.php?page=<?php echo $page+1 ; ?>" aria-label="Next">
                            <img src="../images/icons/right-arrow.png">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

<?php include '../php/footer.php'; ?>

</html>