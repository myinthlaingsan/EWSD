<?php
include('../../../vendor/autoload.php');
use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$usertable = new UsersTable(new MySQL());
$auth = Auth::check();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        header("Location: changepassword.php?id=$user_id&error=empty_fields");
        exit();
    }

    if ($new_password !== $confirm_password) {
        header("Location: changepassword.php?id=$user_id&error=new_mismatch");
        exit();
    }

    // Get user data using UsersTable
    $user = $usertable->getuserbyId($user_id);
    
    if (!$user) {
        HTTP::redirect('/src/Guest/design/profile.php', "error=user_not_found");
        exit();
    }

    // Verify current password
    if (!password_verify($current_password, $user->password)) {
        $_SESSION['error'] = "Current password is incorrect";
        HTTP::redirect('/src/Guest/design/profile.php');
        exit();
    }
    
    // Check if new password is same as current
    if (password_verify($new_password, $user->password)) {
        $_SESSION['error'] = "New password must be different from the current password";
        HTTP::redirect('/src/Guest/design/profile.php');
        exit();
    }

    // Hash new password
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password using UsersTable
    $result = $usertable->updatePassword($user_id, $new_password_hash);

    if ($result) {
        $_SESSION['success'] = "Password changed successfully!";
        HTTP::redirect('/src/Guest/design/profile.php');
        exit();
    } else {
        HTTP::redirect('/src/Guest/design/profile.php', "error=update_failed");
        exit();
    }
} else {
    header("Location: profile.php");
    exit();
}
?>
