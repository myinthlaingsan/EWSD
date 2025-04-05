<?php

include("../../../vendor/autoload.php");

use Helpers\HTTP;
use Helpers\Mailer;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\ArticleTable;
$table=new UsersTable(new MySQL);
$articletable=new ArticleTable(new MySQL);
$mailer = new Mailer();
// $mailer->sendEmail($coordinator->email, $subject, $message);

// $table->insert([
//     "name" => $_POST['name'],
//     "email" => $_POST['email'],
//     "address" => $_POST['address'],
//     'phone' => $_POST['phone'],
//     "password" => $_POST['password'],
//     'faculty_id' => $_POST['faculty_id'],
// ]);
// HTTP::redirect("/src/Auth/design/login.php", "register=success");

try {
    // Insert new user
    $userId = $table->insert([
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "address" => $_POST['address'],
        'phone' => $_POST['phone'],
        "password" =>$_POST['password'], // Always hash passwords!
        'faculty_id' => $_POST['faculty_id'],
    ]);

    if (!$userId) {
        throw new Exception("Failed to register user");
    }

    // Get faculty coordinator
    $coordinators = $table->getCoorEmail($_POST['faculty_id']);
    if ($coordinators) {
        // Prepare email content
        $subject = "New User Registration - " . $_POST['name'];
        $message = "
            <h2>New User Registration</h2>
            <p><strong>Name:</strong> " . htmlspecialchars($_POST['name']) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($_POST['email']) . "</p>
            <p><strong>Faculty:</strong> " . htmlspecialchars($articletable->getFacultyName($_POST['faculty_id'])) . "</p>
            <p><strong>Registration Date:</strong> " . date('Y-m-d H:i:s') . "</p>
            <p>This user has just registered in the system.</p>
        ";
        // Send email to coordinator
        foreach ($coordinators as $coordinator) {
            $mailer->sendEmail(
                $coordinator->email,
                $subject,
                $message
            );
        }
    }
    HTTP::redirect("/src/Auth/design/login.php", "register=success");

} catch (Exception $e) {
    error_log("Registration error: " . $e->getMessage());
    HTTP::redirect("/src/Auth/design/register.php", "error=" . urlencode($e->getMessage()));
}