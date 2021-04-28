<?php

$sel1= mysqli_query($con,"select Value as furl from systemconfigurations where ID=4");
$sel2= mysqli_query($con,"select Value as turl from systemconfigurations where ID=5");
$sel3= mysqli_query($con,"select Value as lurl from systemconfigurations where ID=6");
$re1 = mysqli_fetch_assoc($sel1);
$re2 = mysqli_fetch_assoc($sel2);
$re3 = mysqli_fetch_assoc($sel3);
?>
    <!--    footer  -->
    <hr>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 footer_content">
                    <p>Copyright © <a href="https://www.tatvasoft.com/" style="color:#6255a5;">TatvaSoft</a> All Rights Reserved.</p>
                </div>
                <div class="col-md-6 footer_social text-right">
                    <ul class="social-list">
                        <li><a href="<?php echo $re1['furl']; ?>" target="_blank">
                                <img src="../images/icons/facebook.png" >
                            </a></li>
                        <li><a href="<?php echo $re2['turl']; ?>" target="_blank">
                                <img src="../images/icons/twitter.png" >
                            </a></li>
                        <li><a href="<?php echo $re3['lurl']; ?>" target="_blank">
                                <img src="../images/icons/linkedin.png" >
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

        

    
    
    <!-- Jquery Js -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <!--    popper Js  -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap Js -->
    <script type="text/javascript" src="../js/bootstrap/bootstrap.js"></script>
    <!-- Bootstrap Js -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- Datatable js -->
    <script type="text/javascript" src="../js/datatable.min.js"></script>
    <!--custom script-->
    <script type="text/javascript" src="../js/script.js"></script>

</body>