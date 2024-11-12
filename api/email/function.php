<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'mail_vendor/vendor/autoload.php';


// function for image

// function for mail sending
// define('GMAIL_USERNAME', 'Software Lighthouse '); //💡🏠
// define('GMAIL_EMAIL', 'softlighthouse@gmail.com');
// define('GMAIL_PASS', 'ajadxcfrfpkexwng');

function sendEmail($recipientEmail, $subject, $body) {
    // Create a new instance of PHPMailer
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
   
	$mail->Host = 'smtp.gmail.com';  //gmail SMTP server
	$mail->Username = 'softlighthouse@gmail.com';   //email
	$mail->Password = 'ajadxcfrfpkexwng';   //16 character obtained from app password created
	$mail->Port = 465;                    //SMTP port
	$mail->SMTPSecure = "ssl";
   

    // Sender information
    $mail->setFrom('softlighthouse@gmail.com', 'Online NOC Application System');

    // Receiver address and name
    $mail->addAddress($recipientEmail);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    try {
        // Send mail
        $mail->send();

        return 'Message has been sent.';
    } catch (Exception $e) {
        return 'Email not sent. An error was encountered: ' . $mail->ErrorInfo;
    }
}


// $reply = sendEmail('rushdha@alistlimited.com', 'OTP Very important mail', 'Your otp is 19875');

// echo $reply;


function resetPassword($email, $resetLink, $returnBool = false) {
    $subject = 'Password Reset Request';
    
    $body = 'Dear user,<br><br>';
    $body .= 'You have requested a password reset. Please click on the following link to reset your password:<br>';
    $body .= '<a href="' . $resetLink . '">Reset Password</a><br><br>';
    $body .= 'If you did not request this, please ignore this email.<br><br>';
    $body .= 'Thank you,<br>Online NOC Application System';

    // Send the email
    $result = sendEmail($email, $subject, $body);

    if ($returnBool) {
        return $result !== false; 
    } else {
        return $result;
    }
}