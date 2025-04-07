<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Helpers\BrowserHelper;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\ActivityLogsTable;

// $auth = Auth::check();
// $userId = $auth->id ?? null;
$activityLogTable = new ActivityLogsTable(new MySQL);

$table = new UsersTable(new MySQL);
$users=$table->allusers();
// Log the page visit
// $activityLogTable->logPageView(
//     $userId,
//     $_SERVER['REQUEST_URI'],
//     $_SERVER['HTTP_USER_AGENT'],
//     $_SERVER['REMOTE_ADDR']
// );

// Get reports
$mostViewedPages = $activityLogTable->getMostViewedPages();
$mostActiveUsers = $activityLogTable->getMostActiveUsers();
$mostUsedBrowsers = $activityLogTable->getMostUsedBrowsers();
$BrowserName = new BrowserHelper();
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
    <div class="container mt-5" >
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
                <td><?= $user->faculty_name ?></td>
                <td><?= $user->role_name ?? 'No Role' ?></td>
                <td>
                <a href="./assignrole.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-primary">AssignRole</a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>
<script src="../../../js/bootstrap.bundle.min.js"></script>
</html>