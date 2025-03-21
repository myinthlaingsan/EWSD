<?php

include("../../../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

$email = $_POST['email'];
$password=$_POST['password'];

$table=new UsersTable(new MySQL);
$user=$table->find($email,$password);

if ($user) {
    session_start();
    $_SESSION['user'] = $user;

    // Redirect based on role
    if ($user->role_name === "Admin") {
        HTTP::redirect("/src/Admin/design/dashboard.php");
    } elseif ($user->role_name === "Student") {
        HTTP::redirect("/src/Students/design/dashboard.php");
    } else {
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