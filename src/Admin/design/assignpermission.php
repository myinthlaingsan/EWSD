<?php
include('../../../vendor/autoload.php');
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

// Get role ID from URL
$role_id = $_POST['role_id'] ?? $_GET['id'] ?? null;

if (!$role_id) {
    die("Role ID is required!");
}
$table = new UsersTable(new MySQL);
$roles=$table->getrolebyId($role_id);
$permissions=$table->allpermissions();
$assigned_permissions = $table->getPermissionByRole($role_id);
$assigned_permission_ids = array_map(fn($p) => $p->id, $assigned_permissions);

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
    <h1>Assign Permission</h1>

    <div class="container mt-5">
        <h2>Assign Permission to <?= $roles->role_name ?></h2>

        <form method="POST" action="../code/assignpermission.php">
            <div class="mb-3">
                <label class="form-label">User Name</label>
                <input type="hidden" name="role_id" value="<?= $role_id ?>">
                <input type="text" class="form-control" value="<?= htmlspecialchars($roles->role_name) ?>" disabled>
            </div>

            <div class="mb-3">
            <label class="form-label"><strong>Permissions:</strong></label>
                <br>
                <?php foreach ($permissions as $permission): ?>
                    <input type="checkbox" name="permissions[]" value="<?= $permission->id ?>"
                        <?= in_array($permission->id, $assigned_permission_ids) ? 'checked' : '' ?>
                    >
                    <?= htmlspecialchars($permission->permission_name) ?><br>
                <?php endforeach; ?>
            </div>

            <button type="submit" class="btn btn-primary">Assign Permission</button>
            <a href="role.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>