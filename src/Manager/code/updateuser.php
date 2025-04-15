<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();

// Verify required fields
if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['email'])) {
    HTTP::redirect("/profile.php", "error=missing_fields");
}

// Verify user can only update their own profile
if ($_POST['id'] != $auth->id) {
    HTTP::redirect("/profile.php", "error=unauthorized");
}

$userTable = new UsersTable(new MySQL());

// Check if email is being changed to one that already exists
// if ($_POST['email'] != $auth->email) {
//     $existingUser = $userTable->findByEmail($_POST['email']);
//     if ($existingUser && $existingUser->id != $auth->id) {
//         HTTP::redirect("/profile/update.php?id=".$auth->id, "error=email_taken");
//     }
// }

// Prepare update data
$data = [
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'address' => $_POST['address'] ?? null,
    'phone' => $_POST['phone'] ?? null
];

// Update the user
$success = $userTable->updateBasicInfo($data);

if ($success) {
    // Update session with new data
    $updatedUser = $userTable->getuserbyId($auth->id);
    $_SESSION['user'] = $updatedUser;
    $_SESSION['update'] = "User updated successfully!";
    HTTP::redirect("/src/Manager/design/profile.php");
} else {
    HTTP::redirect("/profile/update.php?id=".$auth->id, "error=update_failed");
}