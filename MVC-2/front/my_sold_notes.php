<?php 
session_start();
include '../php/dbcon.php';
$pagename= "MySoldNotes";
$table= "yes";

if(!isset($_SESSION['fname'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../php/front-header.php'; ?>

    <!--   My Downloads table-->
    <div class="white_space"></div>
    <section class="dashboard_top dashboard_table">
        <div class="container">
            <div class="row">
                <div class="download_heading col-md-4 col-sm-6 col-12">My Sold Notes</div>
                <div class="col-md-8 col-sm-6 col-12">
                    <div class="search-note">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-7">
                                <div class="search">
                                    <img src="../images/icons/search-icon.png">
                                    <input type="search" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-5 search_button">
                                <button type="button" class="btn btn-primary search_btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row booktable">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 5%;">SR NO.</th>
                            <th scope="col" style="width: 15%;">NOTE TITLE</th>
                            <th scope="col" style="width: 10%;">category</th>
                            <th scope="col" style="width: 20%;">buyer</th>
                            <th scope="col" style="width: 10%;">sell type</th>
                            <th scope="col" style="width: 10%;">price</th>
                            <th scope="col" style="width: 20%;">downloaded date/time</th>
                            <th scope="col" style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Data Science</td>
                            <td>Science</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>$250</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>$158</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Lorem ipsum</td>
                            <td>Lorem</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Data Science</td>
                            <td>Science</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>$250</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>$158</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Lorem ipsum</td>
                            <td>Lorem</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>$0</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <a href="#" class="icon"><img src="../images/icons/eye.png"></a>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!--    Pagination   -->
    <section class="pages">
        <div class="container">
            <div class="row">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link page-link-icon" href="#" aria-label="Previous">
                            <img src="../images/icons/left-arrow.png">
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link page-link-icon" href="#" aria-label="Next">
                            <img src="../images/icons/right-arrow.png">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

<?php include '../php/footer.php'; ?>

</html>