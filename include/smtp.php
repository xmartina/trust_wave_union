<?php

use PHPMailer\PHPMailer\PHPMailer;

// MESSAGE & EMAIL CONFIGURATION FOR SCRIPT
class message{
    private $conn;
    public function send_mail($email, $message, $subject){

        $mail = new PHPMailer();
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "	mail.trustwaveunion.online"; // Change Email Host
        $mail->SMTPAuth = true;
        $mail->Username = "info@trustwaveunion.online"; // Change Email Address
        $mail->Password = '@SECtrustwaveunion1'; // Change Email Password
        $mail->Port = 587; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom('info@trustwaveunion.online','Trust Wave Union'); // Change
        $mail->addAddress($email);
        $mail->AddReplyTo("info@trustwaveunion.online", "Trust Wave Union"); // Change
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();


    }

}


?>