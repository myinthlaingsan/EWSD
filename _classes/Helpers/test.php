<?php
include("../../vendor/autoload.php");

use Helpers\Mailer;

$mailer = new Mailer();
$mailer->sendEmail(
    'recipient@example.com',
    'Test Subject',
    '<h1>Test Email</h1><p>PHPMailer is working!</p>'
);