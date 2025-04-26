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
    <title>User Management</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <style>
        /* Custom styles for better responsiveness */
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            min-width: 600px; /* Ensures table doesn't get too narrow */
        }
        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }
        }
        @media (max-width: 576px) {
            .table td, .table th {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container mt-5">
        <div class="table-responsive"> <!-- Wrapper for responsive table -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Faculy</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user) : ?>
                    <tr>
                        <td><?= htmlspecialchars($user->name) ?></td>
                        <td><?= htmlspecialchars($user->email) ?></td>
                        <td><?= htmlspecialchars($user->phone) ?></td>
                        <td><?= htmlspecialchars($user->address) ?></td>
                        <td><?= htmlspecialchars($user->faculty_name) ?></td>
                        <td><?= htmlspecialchars($user->role_name ?? 'No Role') ?></td>
                        <td>
                            <a href="./assignrole.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-primary">Assign Role</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Footer -->
    <?php include "footer.php"; ?>
    <script src="../../../js/bootstrap.bundle.min.js"></script>
</body>
</html>