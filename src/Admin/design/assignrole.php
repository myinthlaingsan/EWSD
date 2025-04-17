<?php
include('../../../vendor/autoload.php');
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;

// Get user ID from URL
$user_id = $_GET['id'] ?? null;

if (!$user_id) {
    die("User ID is required!");
}

$table = new UsersTable(new MySQL);
$users=$table->getuserbyId($user_id);
$roles=$table->roleall();
$currentRole = $table->getUserRole($user_id);
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_role_id = $_POST['role_id'];

    if ($new_role_id) {
        $table->assignRole($user_id, $new_role_id);
        HTTP::redirect('/src/Admin/design/userlist.php'); // Redirect after assignment
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
</head>
<body>
<?php include "header.php"; ?>
    <div class="container mt-5">
        <h2>Assign Role to <?= $users->name ?></h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">User Name</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($users->name) ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="<?= htmlspecialchars($users->email) ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Role</label>
                <select name="role_id" class="form-control">
                    <option value="">Select Role</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role->id ?>" <?= ($currentRole->role_id ?? '') == $role->id ? 'selected' : '' ?>>
                            <?= $role->role_name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Assign Role</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>