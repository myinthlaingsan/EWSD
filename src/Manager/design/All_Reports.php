<?php
include('../../../vendor/autoload.php');

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;

$auth = Auth::check();
$table = new ArticleTable(new MySQL);
$withoutComments = $table->getArticlesWithoutComment();
$withoutComments14 = $table->getArticlesWithoutComment14days();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reports</title>
    <meta name="description" content="Exception reports for university contributions">
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
        }

        .header-title {
            color: var(--primary-dark);
            font-size: 2rem;
            font-weight: 700;
        }

        .section-title {
            color: var(--primary-dark);
            font-size: 1.5rem;
            font-weight: 600;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: var(--primary-dark);
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .table td {
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .table tr:hover {
            background-color: #f1f5f9;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include "headermm.php"; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <h1 class="header-title mb-5 d-flex align-items-center">
            <i class="fas fa-file-alt me-3 text-primary-light"></i> All Reports
        </h1>

        <!-- Contributions Without a Comment -->
        <section class="mb-5">
            <div class="card p-4">
                <h2 class="section-title mb-4">Contributions Without a Comment</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Faculty</th>
                                <th>Student</th>
                                <th>Submission Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($withoutComments as $report): ?>
                                <tr>
                                    <td><?= $report['article_id'] ?></td>
                                    <td><?= $report['title'] ?></td>
                                    <td><?= $report['faculty_name'] ?></td>
                                    <td><?= $report['student_name'] ?></td>
                                    <td><?= $report['created_at'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- Contributions Without a Comment After 14 Days -->
        <section class="mb-5">
            <div class="card p-4">
                <h2 class="section-title mb-4">Contributions Without a Comment After 14 Days</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Faculty</th>
                                <th>Student</th>
                                <th>Submission Date</th>
                                <th>Days Without Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($withoutComments14 as $report): ?>
                                <?php $createdAt = new DateTime($report['created_at']); // Convert to DateTime
                                $now = new DateTime(); // Current time
                                $interval = $now->diff($createdAt);
                                $daysWithoutComment = $interval->days; ?>
                                <tr>
                                    <td><?= $report['article_id'] ?></td>
                                    <td><?= $report['title'] ?></td>
                                    <td><?= $report['faculty_name'] ?></td>
                                    <td><?= $report['student_name'] ?></td>
                                    <td><?= $report['created_at'] ?></td>
                                    <td><?= $daysWithoutComment ?> days</td>
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