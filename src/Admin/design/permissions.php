<?php 
include('../../../vendor/autoload.php');
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table=new UsersTable(new MySQL);
$permissions=$table->allpermissions();
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
    <a href="./dashboard.php">Dashboard</a>
    <a href="./assignrole.php">Assign Role</a>
    <a href="./permissions.php">Create Permission</a>
    <a href="./assignpermission.php">Assign Permission</a>
    <div class="container text-center" style="max-width: 680px">
        <form action="../code/permissions.php" method="post" class="mb-2">
            <input type="text" class="form-control mb-2" name="permission_name" placeholder="Role" required>
            <button class="btn btn-primary w-100">Create</button>
        </form>
        <a href="register.php">Create Permission</a>
    </div>

    <div class="container mt-4">
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Permission Name</th>
                <th></th>
            </tr>
            <?php if (!empty($permissions)) : ?>
            <?php foreach($permissions as $permission) : ?>
            <tr>
                <td><?= $permission->id ?></td>
                <td><?= $permission->permission_name ?></td>
            </tr>
            <?php endforeach ?>
            <?php else : ?>
                <h1>No Record</h1>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>