<?php 
session_start();
include '../php/dbcon.php';
$pagename= "Home";
$table= "no";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header.php'; ?>

    

    <!-- home -->
    <section class="home">
        <div class="home_img">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-12 home_overlay">
                        <span class="heading">Download Free/Paid Notes</span><br>
                        <span class="heading">or Sale your Book</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus debitis adipisci ad quae reprehenderit voluptatem nemo eos, totam nulla animi voluptatum.</p>
                        <div class="overlay_btn m-t-30">
                            <a href="#about01" style="text-decoration:none !important;"><button type="button" class="btn btn-outline-light">LEARN MORE</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--    about -->

    <section class="about" id="about01">
        <div class="container">
            <div class="row">
                <div class="col-md-6 about_heading">
                    <span>About</span><br><span>
                        NotesMarketPlace
                    </span>
                </div>
                <div class="col-md-6 about_text">
                    <p id="about_p1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde qui soluta quisquam laudantium corporis placeat ratione facilis corrupti, fuga veritatis perferendis nam odio, voluptatibus hic alias autem provident. Labore, maxime.</p>
                    <p id="about_p2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut rerum veritatis deserunt accusantium, natus ad quod nam sapiente amet aut! Qui, a nemo delectus, earum beatae error tempore vitae magni.</p>
                </div>
            </div>
        </div>
    </section>

    <!--  works  -->

    <section class="work">
        <div class="container">
            <div class="row">
                <div class="col-md-12 work_heading">
                    <span>How it Works</span>
                </div>
                <div class="col-md-6 work_content">
                    <div class="logo">
                        <img src="../images/icons/download.png">
                    </div>
                    <div class="sub_heading">
                        <span>Download Free/Paid Notes</span>
                    </div>
                    <div class="work_text">
                        <span>Get Material For your <br>Cource etc.</span>
                    </div>
                    <div class="work_btn">
                        <a href="#"><button type="bustton" class="btn btn-primary work_btn" id="btn1"><span>Download</span></button></a>
                    </div>
                </div>
                <div class="col-md-6 work_content">
                    <div class="logo">
                        <img src="../images/icons/seller.png">
                    </div>
                    <div class="sub_heading">
                        <span>Seller</span>
                    </div>
                    <div class="work_text">
                        <span>Upload and Download Cource <br> and Materials etc.</span>
                    </div>
                    <div class="work_btn">
                        <a href="#"><button type="button" class="btn btn-primary work_btn" id="btn2"><span>Sell Book</span></button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--    testimonials  -->

    <section class="testimonial">
        <div class="container">
            <div class="row">
                <div class="testimonial_heading col-md-12">
                    <span>What our Customers are Saying</span>
                </div>
                <div class="col-md-6 team" id="team1">
                    <div class="team1">
                        <div class="team_img col-md-6">
                            <img src="../images/person/customer-1.png" alt="cu1">
                        </div>
                        <div class="team_intro">
                            <span class="team_name">Walter Meller</span><br>
                            <span class="team_job">Founder & CEO, Matrix Group</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda possimus illo numquam libero quibusdam voluptatem laboriosam esse</p>
                    </div>
                </div>
                <div class="col-md-6 team" id="team2">
                    <div class="team2">
                        <div class="team_img col-md-6">
                            <img src="../images/person/customer-2.png">
                        </div>
                        <div class="team_intro">
                            <span class="team_name">Jonnie Riley</span><br>
                            <span class="team_job">Employee, Curious Snacks</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda possimus illo numquam libero quibusdam voluptatem laboriosam esse</p>
                    </div>
                </div>
                <div class="col-md-6 team" id="team3">
                    <div class="team3">
                        <div class="team_img col-md-6">
                            <img src="../images/person/customer-3.png">
                        </div>
                        <div class="team_intro">
                            <span class="team_name">Amilia Luna</span><br>
                            <span class="team_job">Teacher, Saint Joseph High School</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda possimus illo numquam libero quibusdam voluptatem laboriosam esse</p>
                    </div>
                </div>
                <div class="col-md-6 team" id="team4">
                    <div class="team4">
                        <div class="team_img col-md-6">
                            <img src="../images/person/customer-4.png">
                        </div>
                        <div class="team_intro">
                            <span class="team_name">Daniel Cardos</span><br>
                            <span class="team_job">Software Engineer, Infinitum Company</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda possimus illo numquam libero quibusdam voluptatem laboriosam esse</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include '../php/footer.php'; ?>
<script>
    
    
function sticky_header() {
    var header_height = jQuery('.home_navbar').innerHeight() / 2;
    var scrollTop = jQuery(window).scrollTop();;
    if (scrollTop > header_height) {
        jQuery('body').addClass('sticky-nav')
        jQuery('body').removeClass('navbar-dark')
        
        $(".home_navbar .navbar .logo").attr("src", "../images/logo/top-logo1.png");
    } else {
        jQuery('body').removeClass('sticky-nav')
        jQuery('body').addClass('navbar-dark')
        $(".home_navbar .navbar .logo").attr("src", "../images/logo/top-logo.png");
    }
}

jQuery(document).ready(function () {
    sticky_header();
});

jQuery(window).scroll(function () {
    sticky_header();
});
jQuery(window).resize(function () {
    sticky_header();
});
</script>

</html>