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
$users = $table->allusers();
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
    <meta name="description" content="Admin panel for managing users">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            --accent: #facc15;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-muted: #64748b;
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
            padding: 0 15px;
        }
        .section-title {
            color: var(--primary-dark);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .card {
            background: var(--card-bg);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .table thead {
            background: var(--primary-dark);
            color: white;
        }
        .table th {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .table tbody tr {
            transition: background-color 0.2s ease-in-out;
        }
        .table tbody tr:hover {
            background-color: #f1f5f9;
        }
        .btn-outline-primary {
            border-color: var(--primary-light);
            color: var(--primary-light);
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-light);
            color: var(--card-bg);
        }
        .table-icon {
            margin-right: 0.5rem;
            color: var(--text-muted);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "header.php"; ?>
 
    <!-- Main Content -->
    <main class="container py-5">
        <h1 class="text-center mb-4" style="color: var(--primary-dark); font-weight: 700;">User Management</h1>
        <section>
            <h2 class="section-title"><i class="fas fa-users table-icon"></i> All Users</h2>
            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Faculty</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                            <tr class="text-center">
                                <td><?= htmlspecialchars($user->name) ?></td>
                                <td><?= htmlspecialchars($user->email) ?></td>
                                <td><?= htmlspecialchars($user->phone) ?></td>
                                <td><?= htmlspecialchars($user->address) ?></td>
                                <td><?= htmlspecialchars($user->faculty_name) ?></td>
                                <td><?= htmlspecialchars($user->role_name ?? 'No Role') ?></td>
                                <td>
                                    <a href="./assignrole.php?id=<?= urlencode($user->id) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-user-tag me-1"></i> Assign Role
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
 
    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>
</html>