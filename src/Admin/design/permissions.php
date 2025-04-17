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
<?php include "header.php"; ?>
    <div class="container text-center mt-5" style="max-width: 680px">
        <form action="../code/permissions.php" method="post" class="mb-2">
            <input type="text" class="form-control mb-2 pb-3" name="permission_name" placeholder="New Permission" required>
            <button class="btn btn-primary w-100">Create</button>
        </form>
        <a href="register.php">Create Permission</a>
    </div>

    <div class="container mt-4">
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Permission Name</th>
                <!-- <th></th> -->
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
    <?php include "footer.php"; ?>
</body>
</html>