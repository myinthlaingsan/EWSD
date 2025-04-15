<?php

include('../../../vendor/autoload.php');

use Helpers\Auth;
use Libs\Database\ArticleTable;
use Libs\Database\UsersTable;
use Libs\Database\MySQL;

$auth = Auth::check();
$table = new ArticleTable(new MySQL);
$usertable = new UsersTable(new MySQL);
$finalclosuredate = $usertable->selectFinalClosureDate();
$selected = $table->getAllSelectedArticles();
$countarticle = $table->countArticles();
$usercreatearticle = $table->articlesCreateUser();
$countfaculty = $table->countFaculties();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script><!-- Chart Display -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a;
            /* Dark blue */
            --primary-light: #3b82f6;
            /* Light blue */
            --accent: #facc15;
            /* Yellow */
            --light-bg: #f8fafc;
            /* Light gray */
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

        .btn-download {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            border: none;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-download:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-download:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        .stat-value {
            color: var(--primary-light);
            font-weight: 700;
            font-size: 1.5rem;
        }

        .table th {
            background-color: var(--primary-dark);
            color: #ffffff;
        }

        .table td {
            color: var(--text-muted);
        }

        /* Pie Chart */
        .chart-containers {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .chart-container {
            flex: 1 1 45%;
            /* Allow two charts per row on large screens */
            max-width: 600px;
            /* Prevent excessive stretching */
            min-width: 300px;
            /* Prevent charts from getting too small */
            height: 400px;
            /* Set a fixed height */
        }

        @media (max-width: 768px) {
            .chart-container {
                flex: 1 1 100%;
            }
        }

        .canvasjs-chart-credit {
            display: none !important;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include "headermm.php"; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <h1 class="header-title mb-5 d-flex align-items-center">
            <i class="fas fa-briefcase me-3 text-primary-light"></i> Welcome!!!!<br> Marketing Manager Name
        </h1>

        <!-- Selected Contributions Overview -->
        <section class="mb-5">
            <div class="card p-4">
                <h2 class="fs-4 fw-bold text-primary-dark mb-4">Selected Contributions</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Faculty</th>
                                <th>Student</th>
                                <th>Final Closure Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach($selected as $selectedArticle) : ?>
                                <tr>
                                    <td><?= $selectedArticle['article_id'] ?></td>
                                    <td><?= $selectedArticle['title'] ?></td>
                                    <td><?= $selectedArticle['faculty_name'] ?></td>
                                    <td><?= $selectedArticle['name'] ?></td>
                                    <td><?= $finalclosuredate ?></td>
                                    <td><a href="viewdetail.php?id=<?= $selectedArticle['article_id'] ?>" class="btn btn-primary">view</a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Statistics -->
        
    </main>

    <!-- Footer -->
    <?php include "footer.php"; ?>

    
</body>

</html>