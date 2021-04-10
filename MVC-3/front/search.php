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
                        <img src="../images/icons/search-icon.png" alt="search"><input type="search" class="form-control filters filter" placeholder="Search notes here..." id="searchtext">
                    </div>
                    <div class="filters-other">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02" id="type">
                                    <option value=""  class="filter">Select type</option>
                                    <?php
                                    $type = "select * from notetypes where IsActive=1";
                                    $typequery = mysqli_query($con,$type);
                                    $typerows = mysqli_num_rows($typequery);
                                    for($i=1;$i<=$typerows;$i++){
                                    $typerow = mysqli_fetch_array($typequery);
                                    ?>
                                    <option value="<?php echo $typerow['ID'];?>"  class="filter"><?php echo $typerow['Name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02" id="category">
                                    <option value="" class="filter">Select Category</option>
                                    <?php
                                    $category = "select * from notecategories where IsActive=1";
                                    $categoryquery = mysqli_query($con,$category);
                                    $categoryrows = mysqli_num_rows($categoryquery);
                                    for($i=1;$i<=$categoryrows;$i++){
                                    $categoryrow = mysqli_fetch_array($categoryquery);
                                    ?>
                                    <option value="<?php echo $categoryrow['ID'];?>" class="filter"><?php echo $categoryrow['Name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02" id="university">
                                    <option value=""  class="filter">Select University</option>
                                    <?php
                                    $uni = "SELECT DISTINCT UniversityName FROM sellernotes WHERE IsActive=1";
                                    $uniquery = mysqli_query($con,$uni);
                                    $unirows = mysqli_num_rows($uniquery);
                                    for($i=1;$i<=$unirows;$i++){
                                    $unirow = mysqli_fetch_array($uniquery);
                                    ?>
                                    <option value="<?php echo $unirow['UniversityName'];?>" class="filter"><?php echo $unirow['UniversityName'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02" id="course">
                                    <option value="" class="filter">Select Course</option>
                                    <?php
                                    $course = "SELECT DISTINCT Course FROM sellernotes WHERE IsActive=1";
                                    $coursequery = mysqli_query($con,$course);
                                    $courserows = mysqli_num_rows($coursequery);
                                    for($i=1;$i<=$courserows;$i++){
                                    $courserow = mysqli_fetch_array($coursequery);
                                    ?>
                                    <option value="<?php echo $courserow['Course'];?>" class="filter"><?php echo $courserow['Course'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02" id="country">
                                    <option value=""  class="filter">Select Country</option>
                                    <?php
                                    $country = "select * from countries where IsActive=1";
                                    $countryquery = mysqli_query($con,$country);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    for($i=1;$i<=$countryrows;$i++){
                                    $countryrow = mysqli_fetch_array($countryquery);
                                    ?>
                                    <option value="<?php echo $countryrow['ID'] ?>" class="filter"><?php echo $countryrow['Name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <select class="filters-02" id="rating">
                                    <option value="">Select Rating</option>
                                    <option value="1" class="filter">1+ star</option>
                                    <option value="2" class="filter">2+ star</option>
                                    <option value="3" class="filter">3+ star</option>
                                    <option value="4" class="filter">4+ star</option>
                                    <option value="5" class="filter">5 star</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<!--    books  -->
    <div class="search-result" id="result">
       
    </div>
    
<?php include '../php/footer.php'; ?>



<script>
$(document).ready(function() {
    
    search_notes(<?php if(isset($_SESSION['searchpage'])){echo $_SESSION['searchpage'];} ?>);
    
    function search_notes(page) {
        var action = "data";
        var search = $('#searchtext').val();
        var type = $("#type").children("option:selected").val();
        var category = $("#category").children("option:selected").val();
        var university = $("#university").children("option:selected").val();
        var course = $("#course").children("option:selected").val();
        var country = $("#country").children("option:selected").val();
        var rating = $("#rating").children("option:selected").val();
        $.ajax({
            url: "action.php",
            method:"POST",
            data:{action:action,page:page,search:search,type:type,category:category,university:university,course:course,country:country,rating:rating},
            success:function(data){
                $('#result').html(data);
            },
            error: function (e) {
                console.log(e);
            }
        });
        
    }
    
    $('#searchtext').keyup(function() {
        search_notes();
    });
    
    $("#type").change(function(){
        search_notes();
    });
    
    $("#category").change(function(){
        search_notes();
    });
    
    $("#university").change(function(){
        search_notes();
    });
    
    $("#course").change(function(){
        search_notes();
    });
    
    $("#country").change(function(){
        search_notes();
    });
    
    $("#rating").change(function(){
        search_notes();
    });
    
    $(document).on("click", "#paginationid a", function (e) {
        e.preventDefault();
        var pageID = $(this).attr("id");
        search_notes(pageID);
    });
});

</script>


</html>

    
