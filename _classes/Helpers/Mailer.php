<?php
namespace Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configure();
    }

    private function configure() {
        // Server settings for Mailtrap (testing)
        $this->mail->isSMTP();
        $this->mail->Host = 'sandbox.smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = '127901cd75351c'; // Replace with your Mailtrap username
        $this->mail->Password = '9eec5c247d9fc5'; // Replace with your Mailtrap password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 2525;
        
        // Sender information
        $this->mail->setFrom('rivetstone@school.com', 'Article Submission System');
        $this->mail->isHTML(true);
    }

    public function sendEmail($to, $subject, $body) {
        try {
            $this->mail->clearAddresses(); // Clear previous recipients
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->AltBody = strip_tags($body); // Plain text version

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
}