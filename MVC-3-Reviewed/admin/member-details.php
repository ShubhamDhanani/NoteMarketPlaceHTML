<?php 
session_start();
include '../php/dbcon.php';
$pagename="Member_Details";

if(!isset($_SESSION['fname']) or $_SESSION['role']==3){
    header("location:../front/login.php");
}

$memberid=$_GET['id'];
$select = mysqli_query($con,"SELECT FirstName,LastName,EmailID FROM users WHERE ID=$memberid and IsActive=1");
$res = mysqli_fetch_assoc($select);
$selpro = mysqli_query($con,"SELECT *,CONCAT(PhoneNumber_CountryCode,PhoneNumber) AS phone FROM userprofile Where UserID=$memberid and IsActive=1");
$count = mysqli_num_rows($selpro);
$resp = mysqli_fetch_assoc($selpro);
if($count==0){
$resp['DOB']="NA";
$resp['Gender']="NA";
$resp['Gender']="NA";
$resp['phone']="NA";
$resp['College']="NA";
$resp['University']="NA";
$resp['ProfilePicture']="../images/person/t1.jpg";
$resp['AddressLine1']="NA";
$resp['AddressLine2']="NA";
$resp['City']="NA";
$resp['State']="NA";
$resp['Country']="NA";
$resp['ZipCode']="NA";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../php/front-header-admin.php'; ?>

<!--   member detais   -->
<div class="white_space1"></div>
<section class="member_details">
    <div class="container">
        <div class="row">
            <div class="member_heading">
                Member Details
            </div>
        </div>
        <div class="row">
            <div class="member_content col-md-12">
                <div class="member_img col-md-1">
                    <?php 
                        $profile =$resp['ProfilePicture'];
                        ?>
                    <img src="<?php echo $profile; ?>" style="height:120px;width:100px;">
                </div>
                <div class="member_left col-md-5">
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            First Name:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php echo $res['FirstName'];?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            Last Name:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php echo $res['LastName'];?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            Email:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php echo $res['EmailID'];?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            DOB:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php
                                if($count==0){
                                    echo "NA";
                                }
                                elseif($resp['DOB']=""){
                                    echo "NA";
                                }
                                else{
                                $date= $resp['DOB'];
                                $timestamp = strtotime($date);
                                $new_date = date("d-m-Y", $timestamp);
                                echo $new_date;  
                                }
                                
                                 ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            Phone Number:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php echo $resp['phone'];?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            College/University:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php if($resp['College']==""){
                                echo "NA";
                            }
                            else{
                               echo $resp['College'];}?> 
                            
                            
                        </div>
                    </div>
                </div>
                <div class="center_line col-md-1"></div>
                <div class="member_right col-md-5">
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            Address 1:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php
                                if($resp['AddressLine1']==""){
                                    echo "NA";
                                }
                                else{
                                echo $resp['AddressLine1'];}?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            Address2:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php 
                                if($resp['AddressLine2']==""){
                                    echo "NA";
                                }
                                else{
                                echo $resp['AddressLine2'];}?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            City:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php
                                if($resp['City']==""){
                                    echo "NA";
                                }
                                else{
                                echo $resp['City'];}?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            State:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php
                                if($resp['State']==""){
                                    echo "NA";
                                }
                                else{
                                echo $resp['State'];}?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            Country:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php
                                if($resp['Country']==""){
                                    echo "NA";
                                }
                                else{
                                echo $resp['Country'];}?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="member_info col-md-6 col-sm-6 col-6">
                            Zip Code:
                        </div>
                        <div class="member_info_dark col-md-6 col-sm-6 col-6">
                            <?php
                                if($resp['ZipCode']==""){
                                    echo "NA";
                                }
                                else{
                                echo $resp['ZipCode'];}?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="container" style="margin-top: 30px;">
<!--   My Downloads table-->
<section class="dashboard_top dashboard_table">
    <div class="container">
        <div class="row">
            <div class="download_heading col-md-6" style="font-size: 24px;">Notes</div>
        </div>
        <div class="row booktable table-responsive">
            <table class="table table-hover table-responsive table1">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">SR NO.</th>
                        <th scope="col" style="width: 20%;">note title</th>
                        <th scope="col" style="width: 5%;">category</th>
                        <th scope="col" style="width: 5%;">status</th>
                        <th scope="col" style="width: 5%;">downloaded notes</th>
                        <th scope="col" style="width: 5%;">total earnings</th>
                        <th scope="col" style="width: 15%;">date added</th>
                        <th scope="col" style="width: 15%;">published date</th>
                        <th scope="col" style="width: 5%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $select_note = mysqli_query($con,"SELECT sellernotes.ID,sellernotes.Title,notecategories.Name as category,referencedata.value as status,sellernotes.CreatedDate,sellernotes.PublishedDate FROM sellernotes LEFT JOIN notecategories ON sellernotes.Category=notecategories.ID LEFT JOIN referencedata ON sellernotes.Status=referencedata.ID WHERE sellernotes.SellerID=$memberid 
                        And sellernotes.IsActive=1 order by sellernotes.CreatedDate DESC");
                        $sr=1;
                        while($result = mysqli_fetch_assoc($select_note)){
                            ?>
                    <tr>
                        <?php $noteid=$result['ID']; ?>
                        <td><?php echo $sr;?></td>
                        <td><a href="note-details.php?id=<?php echo $noteid; ?>" class="purple_text" style="text-decoration:none;"><?php echo $result['Title'];?></a></td>
                        <td><?php echo $result['category'];?></td>
                        <td><?php echo $result['status'];?></td>
                        <td><a href="downloaded-notes.php?title=<?php echo $result['Title']; ?>" class="purple_text" style="text-decoration:none;">
                                <?php
                                $download=mysqli_query($con,"SELECT COUNT(ID) AS download FROM downloads WHERE NoteID=$noteid AND IsAttachmentDownloaded=1 and IsActive=1 ");
                                $res_dow = mysqli_fetch_assoc($download);
                                echo $res_dow['download'];
                                ?></a></td>
                        <td>$
                            <?php
                                    $earn=mysqli_query($con,"SELECT SUM(PurchasedPrice) AS earned FROM downloads WHERE NoteID=$noteid AND IsSellerHasAllowedDownload=1 and IsActive=1");
                                    $earning=mysqli_fetch_assoc($earn);
                                    if(empty($earning['earned'])){
                                        $earning['earned']=0;
                                    }
                                    echo $earning['earned'];
                                ?></td>
                        <td><?php echo $result['CreatedDate'];?></td>
                        <?php if(empty($result['ModifiedDate'])){
                                    $result['ModifiedDate'] = "NA";
                                } ?>
                        <td><?php echo $result['PublishedDate'];?></td>
                        <td>
                            <a href="#" class="icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../images/icons/dots.png"></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php
                                        $file= mysqli_query($con,"SELECT FilePath from sellernotesattachements WHERE sellernotesattachements.NoteID=$noteid and IsActive=1");
                                        $pathr = mysqli_fetch_assoc($file);
                                        $filepath = $pathr['FilePath'];
                                        ?>
                                <a href="<?php echo $filepath; ?>" class="dropdown-item" type="button" download>Download Notes</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                            $sr++;
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


<?php include '../php/footer.php'; ?>

<script>
    $(document).ready(function() {
        var table = $('.table1').DataTable({
            'sDom': '"top"i',
            "iDisplayLength": 5,
            language: {
                paginate: {
                    next: '<img src="../images/icons/right-arrow.png">',
                    previous: '<img src="../images/icons/left-arrow.png">'
                }
            },
            columnDefs: [{
                targets: [8],
                orderable: false,
            }]
        });

    });
</script>

</html>