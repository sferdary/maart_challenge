<?php
require_once(CREDENTIALS);
require_once(AUTOLOAD);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail extends Credentials
{
    public static function send($email, $subject, $message)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();                                // Set mailer to use SMTP
            $mail->SMTPAuth   = Credentials::$smtpAuth;     // Enable SMTP authentication
            $mail->Port       = Credentials::$port;         // TCP port to connect to mail
            $mail->SMTPDebug  = 0;                          // 0 = No output / 1 = errors + msg / 2 = msg
            $mail->Host       = Credentials::$mailhost;         // Specify main and backup SMTP servers
            $mail->Username   = Credentials::$email;        // SMTP username
            $mail->Password   = Credentials::$mailpwd;      // SMTP password
            $mail->SMTPSecure = Credentials::$encryption;   // Enable TLS encryption, `ssl` also accepted

            $mail->setFrom(Credentials::$email);            // Email from sender
            $mail->addAddress($email);                      // Email to recipient
            $mail->isHTML(true);                            // Set email format to HTML
            $mail->Subject = $subject;                      // Subject for recipient mail
            $mail->Body    = $message;                      // Body content
            $mail->AltBody = strip_tags($message);          // Stripped message for mailservices without HTML
        } catch (Exception $e) {
            echo "mail error: " . $e;
        }
        if ($mail->send()) {
            return true;
        }else {
           return false;
        }
    }
}
