<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
$table = new UsersTable(new MySQL);
$users=$table->allusers();
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
    <h1>HELLO ADMIN</h1>
    <a href="./role.php">Create Role</a>|
    <a href="./faculty.php">Faculty</a>|
    <a href="./permissions.php">Create Permission</a>|
    <a href="./assignpermission.php">Assign Permission</a>|
    <a href="../../Auth/code/logout.php">Logout</a>|
    <a href="./setting.php">Settings</a>|
    <div class="container" >
        <table class="table table-striped table-bordered">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Faculy</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php foreach($users as $user) : ?>
            <tr>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->address ?></td>
                <td><?= $user->phone ?></td>
                <td></td>
                <td><?= $user->role_name ?? 'No Role' ?></td>
                <td>
                <a href="./assignrole.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-primary">AssignRole</a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
<script src="../../../js/bootstrap.bundle.min.js"></script>
</html>