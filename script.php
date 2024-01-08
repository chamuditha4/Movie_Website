<?php
include('database.inc.php');
$msg="";
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['comment'])){
    $fname=mysqli_real_escape_string($con,$_POST['first_name']);
    $lname=mysqli_real_escape_string($con,$_POST['last_name']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
    $comment=mysqli_real_escape_string($con,$_POST['comment']);
    
    mysqli_query($con,"insert into contact_us(fname,lname,email,mobile,comment) values('$fname','$lname','$email','$mobile','$comment')");
    $msg="Thanks message";
    
    $html="<table><tr><td>FirstName</td><td>$fname</td></tr><tr><td>LastName</td><td>$lname</td></tr><tr><td>Email</td><td>$email</td></tr><tr><td>Mobile</td><td>$mobile</td></tr><tr><td>Comment</td><td>$comment</td></tr></table>";
    
    include('smtp/PHPMailerAutoload.php');
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->Port=587;
    $mail->SMTPSecure="tls";
    $mail->SMTPAuth=true;
    $mail->Username="teshifernando181@gmail.com";
    $mail->Password="ziom ksap rmgx qzuv";
    $mail->SetFrom("GAMIL_EMAIL_ID");
    $mail->addAddress("TO_EMAIL_ID");
    $mail->IsHTML(true);
    $mail->Subject="New Contact Us";
    $mail->Body=$html;
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    if($mail->send()){
        echo "Mail send";
    }else{
        echo "Error occur";
    }
    echo $msg;
}
?>