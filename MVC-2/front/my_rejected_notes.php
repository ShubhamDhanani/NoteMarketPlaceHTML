<?php 
session_start();
include '../php/dbcon.php';
$pagename= "MyRejectedNotes";
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
                <div class="download_heading col-md-4 col-sm-6 col-12">My Rejected Notes</div>
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
                            <th scope="col" style="width: 20%;">Remarks</th>
                            <th scope="col" style="width: 10%;">clone</th>
                            <th scope="col" style="width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="purple_text">Data Science</td>
                            <td>Science</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="purple_text">Accounts</td>
                            <td>Commerce</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="purple_text">Social Studies</td>
                            <td>Social</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="purple_text">AI</td>
                            <td>IT</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td class="purple_text">Lorem ipsum</td>
                            <td>Lorem</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td class="purple_text">Data Science</td>
                            <td>Science</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td class="purple_text">Accounts</td>
                            <td>Commerce</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td class="purple_text">Social Studies</td>
                            <td>Social</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td class="purple_text">AI</td>
                            <td>IT</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
                                <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png" aria-hidden="true"></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Download Note</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td class="purple_text">Lorem ipsum</td>
                            <td>Lorem</td>
                            <td>Lorem Ipsum is simply dummy text</td>
                            <td class="purple_text">Clone</td>
                            <td>
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