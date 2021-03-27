<?php 
session_start();
include 'dbcon.php';
include '../src/mail.php';
$pagename="NoteDetailsDownload";
?>
<?php


        $noteid = $_GET['id'];   
        $user = $_SESSION['id'];
        
        $s= "select * from downloads WHERE NoteID=$noteid AND Downloader=$user";
        $sq = mysqli_query($con,$s);
        $scount = mysqli_num_rows($sq);
        if($scount>0){
        while($result = mysqli_fetch_assoc($sq)){
        $paid=$result['IsPaid'];
        if($paid==0){
            $atdownloaddate = "CURRENT_TIMESTAMP()";
        }
        else{
            $atdownloaddate = "NULL";
        }
            $up = "UPDATE downloads SET AttachmentDownloadedDate=$atdownloaddate , ModifiedDate=CURRENT_TIMESTAMP() , ModifiedBy=$user Where NoteID=$noteid AND Downloader=$user";
            $update= mysqli_query($con,$up);
        }
        }
        else{
        $sel = "select sellernotes.* ,notecategories.Name as category , sellernotesattachements.FilePath from sellernotes,notecategories,sellernotesattachements where sellernotes.Category=notecategories.ID AND sellernotes.ID=sellernotesattachements.NoteID AND sellernotes.ID=$noteid";
        $select = mysqli_query($con,$sel);
        while($res = mysqli_fetch_assoc($select)){
        $seller =$res['SellerID'];
        $filepath = $res['FilePath'];
        $paid = $res['IsPaid'];
        if($paid==5){
            $ispaid =0;
            $allow =1;
            $downloaded =1;
            $downloaddate ="CURRENT_TIMESTAMP()";
        }
        else{
            $ispaid =1;
            $allow =0;
            $downloaded =0;
            $downloaddate ="NULL";
        }
        $price = $res['SellingPrice'];
        $title = $res['Title'];
        $category = $res['category'];
        
        $ins= "INSERT INTO downloads (NoteID, Seller, Downloader, IsSellerHasAllowedDownload, AttachmentPath, IsAttachmentDownloaded, AttachmentDownloadedDate, IsPaid, PurchasedPrice, NoteTitle, NoteCategory, CreatedBy) VALUES ($noteid,$seller,$user,$allow,'$filepath',$downloaded,$downloaddate,$ispaid,$price,'$title','$category',$user)";
        $insert= mysqli_query($con,$ins);
        }
        }
if($insert and $ispaid==1){
    $fname= $_SESSION['fname'];
    $seller = "SELECT sellernotes.SellerID , users.FirstName ,users.LastName from sellernotes , users WHERE sellernotes.SellerID=users.ID and sellernotes.ID=$noteid";
    $sellerq = mysqli_query($con,$seller);
    $op = mysqli_fetch_assoc($sellerq);
    $sfname = $op['FirstName'];
    
            $mail->setFrom($config_email, 'NotesMarketPlace'); // This email address and name will be visible as sender of email

            $mail->addAddress('sndhanani43@gmail.com', 'Receiver name'); // This email is where you want to send the email
            $mail->addReplyTo($config_email, 'Sender name'); // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true); // You can set it to false if you want to send raw text in the body
            $mail->Subject = "$fname wants to purchase your notes"; //subject line of email
            $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                <thead>
                    <th>
                        <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
                    </th>
                </thead>
                <tbody>
                    <br>
                    <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                        <td class='text-1'>Download Request</td>
                    </tr>
                    <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                        <td class='text-2'>Hello $sfname,</td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            We would like to inform you that, <b> $fname </b> wants to purchase your notes. Please see Buyer Requests tab and allow download access to Buyer if you have received the payment from him.
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
}
if($update or $insert){
    
    $_SESSION['show']=1;
    header("location:../front/note-details.php?id=$noteid");
}
?>