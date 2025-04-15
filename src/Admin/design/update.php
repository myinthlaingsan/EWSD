<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
$user_id = $_GET['id'] ?? $auth->id;

// Verify the user can only edit their own profile
if ($user_id != $auth->id) {
    HTTP::redirect("/profile.php", "error=unauthorized");
}

$userTable = new UsersTable(new MySQL());
$user = $userTable->getuserbyId($user_id);

if (!$user) {
    HTTP::redirect("/profile.php", "error=user_not_found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .profile-header {
            background-color: #3b82f6;
            color: white;
            border-radius: 8px 8px 0 0;
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    
    <div class="container py-5">
        <div class="profile-container">
            <div class="card shadow">
                <div class="card-header profile-header">
                    <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form action="../code/updateuser.php" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($user->id) ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= htmlspecialchars($user->name) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($user->email) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" 
                                   value="<?= htmlspecialchars($user->address) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   value="<?= htmlspecialchars($user->phone) ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="profile.php" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>