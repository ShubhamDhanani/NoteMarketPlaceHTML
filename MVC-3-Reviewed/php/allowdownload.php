<?php
session_start();

include 'dbcon.php';
include '../src/mail.php';

$noteid=$_GET['noteid'];
$downloader=$_GET['downloader'];
$user=$_SESSION['id'];

$selc=mysqli_query($con,"select * from downloads where NoteID=$noteid AND Downloader=$downloader");
$resc=mysqli_fetch_assoc($selc);
if(!isset($_SESSION['fname']) or $resc['Seller']!==$_SESSION['id']){
    header("location:../front/login.php");
}
else{

$update="Update downloads SET IsSellerHasAllowedDownload=1 ,ModifiedDate=current_timestamp(),ModifiedBy=$user where NoteID=$noteid AND Downloader=$downloader";
$updatequery= mysqli_query($con,$update);

if($updatequery){
            
            $sel="select * from users Where ID=$downloader";
            $selq= mysqli_query($con,$sel);
            $res= mysqli_fetch_assoc($selq);
            $buyer = $res['FirstName'];
            $seller = $_SESSION['fname'];
            
    
            $mail->setFrom($config_email, 'NotesMarketPlace'); // This email address and name will be visible as sender of email

            $mail->addAddress('sndhanani43@gmail.com', 'Receiver name'); // This email is where you want to send the email
            $mail->addReplyTo($config_email, 'Sender name'); // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
            $mail->Subject = "$seller Allows you to download a note"; //subject line of email
            $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                <thead>
                    <th>
                        <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
                    </th>
                </thead>
                <tbody>
                    <br>
                    <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                        <td class='text-1'>Download Request Accepted</td>
                    </tr>
                    <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                        <td class='text-2'>Hello $buyer,</td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            We would like to inform you that, <b>$seller</b> Allows you to download a note.
                            Please login and see My Download tabs to download particular note.
                        </td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            Regards <br>
                            NotesMarketPlace
                        </td>
                    </tr>
                </tbody>
            </table>"; //Email body
            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.'; //Alternate body of email

            $mail->send();
    
    
    header("location:../front/buyer_request.php");
}
else{
    ?>
<script>
    alert("did not allowed book for download pls try again letter");
    location.replace("../front/buyer_request.php");
</script>
<?php
}
}
?>