<?php
include('../../../vendor/autoload.php');
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\ArticleTable;

$auth = Auth::check();
$username = $auth->name;
$usertable = new UsersTable(new MySQL);
$table = new ArticleTable(new MySQL);
$finalclosuredate = $usertable->selectFinalClosureDate();
$totalArticles = $table->countArticles();
$totalFaculties = $table->countFaculties();
$totalStudents = $table->articlesCreateUser();
$totalCoordinators = $table->countCoordinators();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Annual Magazine</title>
    <meta name="description" content="Manage university closure dates and track student contributions">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            --secondary: #64748b;
            --accent: #facc15;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
        }
 
        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        }
 
        .text-primary-custom {
            color: var(--primary-dark);
        }
 
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
 
        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s;
        }
 
        .card:hover {
            transform: translateY(-5px);
        }
 
        .stat-card {
            background-color: var(--card-bg);
            border: none;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 150px; /* Fixed minimum height */
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .stat-card .card-body {
            padding: 1.5rem;
        }
        .text-primary-custom {
            color: var(--primary-dark); /* Dark blue */
            font-size: 1.25rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center; /* Center icon and text */
        }
        .fs-2 {
            font-size: 2.5rem !important; /* Large number size */
        }
        .text-secondary {
            color: var(--secondary); /* Muted gray */
        }
 
        .main-content {
            position: relative;
            z-index: 900;
        }
 
        .welcome-section {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
 
        .btn-custom {
            background: var(--primary-light);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
        }
 
        .btn-custom:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }
 
        .btn-custom:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
 
        .deadline-date {
            color: #dc3545;
            font-weight: 600;
        }
    </style>
</head>
<body>
   
    <!-- Header -->
    <?php include "header.php"; ?>
 
    <!-- Main Content Wrapper -->
    <div class="main-content">
        <!-- Welcome Section -->
        <div class="container my-5 welcome-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="text-primary-custom">WELCOME <?= $username ?></h2>
                    <h1 class="text-primary-custom">Contribution Management</h1>
                </div>
                <a href="ContributionEntry.php" class="btn-custom">Add New Contribution</a>
            </div>
 
            <!-- Last Contribution Card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center text-primary-custom mb-3">The Last Contribution Name</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><i class="fas fa-calendar me-2"></i> Last Deadline Date: <span class="deadline-date"><?= $finalclosuredate ?></span></p>
                            <p><i class="fas fa-university me-2"></i> Faculty: Arts</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-users me-2"></i>Articles Total Upload by<?= $totalStudents ?> Students</p>
                            <p><i class="fas fa-user-tie me-2"></i> Faculty Marketing Coordinator: Mr Kelvin</p>
                        </div>
                    </div>
                </div>
            </div>
 
            <!-- Statistics Grid -->
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="card stat-card shadow h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="text-primary-custom mb-3"><i class="fas fa-file-alt me-2"></i> Total Contributions</h3>
                            <p class="fs-2 fw-bold text-secondary mb-0"><?= $totalArticles ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="text-primary-custom mb-3"><i class="fas fa-user-graduate me-2"></i> Total Students</h3>
                            <p class="fs-2 fw-bold text-secondary mb-0"><?= $totalStudents ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="text-primary-custom mb-3"><i class="fas fa-building me-2"></i> Total Faculties</h3>
                            <p class="fs-2 fw-bold text-secondary mb-0"><?= $totalFaculties ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h3 class="text-primary-custom mb-3"><i class="fas fa-user-tie me-2"></i> Total Coordinators</h3>
                            <p class="fs-2 fw-bold text-secondary mb-0"><?= $totalCoordinators ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Footer -->
    <?php include "footer.php"; ?>
   
</body>
</html>