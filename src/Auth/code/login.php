<?php

include("../../../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$email = $_POST['email'];
$password = $_POST['password'];

$table = new UsersTable(new MySQL);
$user = $table->find($email, $password);

if ($user) {
    session_start();
    $_SESSION['user'] = $user;
    // Add last login message to session
    if ($user->last_login) {
        $lastLogin = new DateTime($user->last_login);
        $_SESSION['login_message'] = "Welcome back! Your last login was on " . $lastLogin->format('F j, Y \a\t g:i a');
    } else {
        $_SESSION['login_message'] = "Welcome! This is your first login.";
    }
    // Redirect based on role
    switch ($user->role_name) {
        case "Admin":
            HTTP::redirect("/src/Admin/design/dashboard.php", "login=success");
            break;
        case "Student":
            HTTP::redirect("/src/Students/design/dashboard.php");
            break;
        case "Manager":
            HTTP::redirect("/src/Manager/design/index.php");
            break;
        case "Coordinator":
            HTTP::redirect("/src/Coordinator/design/index.php");
            break;
        case "Guest":
            HTTP::redirect("/src/Guest/design/dashboard.php");
            break;
        default:
            HTTP::redirect("/src/Auth/design/login.php", "unauthorized=1");
    }
} else {
    HTTP::redirect("/src/Auth/design/login.php", "incorrect=1");
}

// if($user){
//     session_start();
//     $_SESSION['user'] = $user;
//     HTTP::redirect("/src/Admin/design/dashboard.php");
// }else{
//     HTTP::redirect("/src/Auth/design/login.php", "incorrect=login");
// }