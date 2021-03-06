<?php 
session_start();
include '../php/dbcon.php';
$pagename ="FAQ";
$table= "no";
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../php/front-header.php'; ?>

    <!-- FAQ -->

    <div class="user-image m-top-100">
        <div class="user-text">
            <h1>Frequently Asked Questions</h1>
        </div>
    </div>
    <div id="faq" class="container">
        <div class="faq-heading">
            <h3>General Questions</h3>
        </div>
        <div class="according">
            <div class="q">
                <div class="collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q1">
                    <h5 class="accordion-toggle faq-qstn">What is Notes Marketplace?</h5>
                </div>
                <div id="q1" class="collapse">
                    <div class="faq-ans">Notes Marketplace is an online marketplace for university students to buy and sell their course notes.</div>
                </div>
            </div>
            <div class="q">
                <div class="collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q2">
                    <h5 class="accordion-toggle faq-qstn">Where did Notes Marketplace start?</h5>
                </div>
                <div id="q2" class="collapse">
                    <div class="faq-ans">What started out as four friends chucking around an idea in Ahmedabad ended up turning into an earliest version of Notes Marketplace. So, with 2021 batch of tatvasoft – we has developed this product.</div>
                </div>
            </div>
        </div>
        <div class="faq-heading">
            <h3>Uploaders</h3>
        </div>
        <div class="according">
            <div class="q">
                <div class="collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q3">
                    <h5 class="accordion-toggle faq-qstn">Why should I upload now?</h5>
                </div>
                <div id="q3" class="collapse">
                    <div class="faq-ans">To maximize sales. We can't sell your notes if they are rotting on your hard drive. Your notes are available for purchase the instant they are approved, which means that you could be missing potential sales as we speak. Despite exam and holiday breaks, our users purchase notes all year round, so the best time to upload notes is always today.
                    </div>
                </div>
            </div>
            <div class="q">
                <div class="collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q4">
                    <h5 class="accordion-toggle faq-qstn">What can't I sell?</h5>
                </div>
                <div id="q4" class="collapse">
                    <div class="faq-ans">We won't approve materials that have been created by your university or another third party. We also do not accept assignments, essays, practical’s or take-home exams. We love notes though.</div>
                </div>
            </div>
            <div class="q">
                <div class="collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q5">
                    <h5 class="accordion-toggle faq-qstn">How long does it take to upload?</h5>
                </div>
                <div id="q5" class="collapse">
                    <div class="faq-ans">Uploading notes is quick and easy. It can take as little as 90 seconds per set of notes. Put it this way, in the time it took to read these FAQs, you could’ve uploaded several sets of notes.</div>
                </div>
            </div>
        </div>
        <div class="faq-heading">
            <h3>Downloaders</h3>
        </div>
        <div class="according">
            <div class="q">
                <div class="collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q6">
                    <h5 class="accordion-toggle faq-qstn">How do I buy notes?</h5>
                </div>
                <div id="q6" class="collapse">
                    <div class="faq-ans">Search for the notes you are after using the 'SEARCH NOTES' tab at the at the top right of every page. You can then filter results by university, category, course information etc. To purchase, go to detail page of note and click on download button. If notes are free to download – it will download over the browser and if notes are paid, Once Seller will allow download you can have notes at my downloads grid for actual download.</div>
                </div>
            </div>
            <div class="q">
                <div class="collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q7">
                    <h5 class="accordion-toggle faq-qstn">Why should I buy notes?</h5>
                </div>
                <div id="q7" class="collapse">
                    <div class="faq-ans">The notes on our site are incredibly useful as an educational tool when used correctly. They effectively demonstrate the techniques that top students employ in order to receive top marks. They also summaries the course in a concise format and show what that student believed were the most important elements of the course. Learn from the best.</div>
                </div>
            </div>
            <div class="q">
                <div class="collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q8">
                    <h5 class="accordion-toggle faq-qstn">Will downloading notes guarantee I improve my grades?</h5>
                </div>
                <div id="q8" class="collapse">
                    <div class="faq-ans">How long is a piece of string? However, 90% of students who purchased notes through our site said that doing so improved their grades.</div>
                </div>
            </div>
        </div>
    </div>

<?php include '../php/footer.php'; ?>

</html>