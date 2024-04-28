<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer-master/src/Exception.php';
  require 'PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/src/SMTP.php';


  
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "STARTTLS";
  $mail->Port       = 587;
  $mail->Host       = "smtp.office365.com";
  $mail->Username   = "it@assetnetworks.net";
  $mail->Password   = "MageAmma@1989";

  $mail->IsHTML(true);
  $mail->AddAddress("it@assetnetworks.net", "recipient-name");
  $mail->SetFrom("it@assetnetworks.net", "set-from-name");
////  $mail->AddReplyTo("reply-to-email", "reply-to-name");
 // $mail->AddCC("cc-recipient-email", "cc-recipient-name");
  $mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
  $content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

  $mail->MsgHTML($content); 
  if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
  } else {
    echo "Email sent successfully";
  }
  
?>