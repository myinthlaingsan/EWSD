<?php
include('../../../vendor/autoload.php');
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table=new UsersTable(new MySQL);
$roles=$table->roleall();
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
    <div class="container text-center" style="max-width: 680px">
        <form action="../code/role.php" method="post" class="mb-2">
            <input type="text" class="form-control mt-4 mb-2" name="role_name" placeholder="New Role" required>
            <button class="btn btn-primary w-100">Create Role</button>
        </form>
    </div>
    <div class="container mt-4">
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>RoleName</th>
                <th>Action</th>
            </tr>
            <?php if (!empty($roles)) : ?>
            <?php foreach($roles as $role) : ?>
            <tr>
                <td><?= $role->id ?></td>
                <td><?= $role->role_name ?></td>
                <td>
                    <a href="./assignpermission.php?id=<?= $role->id ?>" class="btn btn-sm btn-outline-primary">AssignPermission</a>
                </td>
            </tr>
            <?php endforeach ?>
            <?php else : ?>
                <h1>No Record</h1>
            <?php endif; ?>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>