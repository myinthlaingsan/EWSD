<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\ArticleTable;

$auth = Auth::check();
$user_id = $auth->id ?? null;
$usertable = new UsersTable(new MySQL);
$role = $usertable->getUserRoleName($user_id);
if ($role !== 'Coordinator') {
    HTTP::redirect('/unauthorized.php'); // Create this page to show access denied
    exit();
}
$faculty_id = $auth->faculty_id;
$username = $auth->name;
$table = new ArticleTable(new MySQL);
$usertable = new UsersTable(new MySQL);
$facultyname = $table->getfacultyname($faculty_id);
$settings = $usertable->selectSetting();
// $usercreatedarticle = $table->articlesCreateUser();
$students = $usertable->getStudentRolesByFaculty($faculty_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Coordinator Contributions</title>
    <meta name="description" content="Contributions managed by Marketing Coordinator">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            --contributors-color: #2ecc71;
            /* Green for Total Contributors */
            --closure-date-color: #e74c3c;
            /* Red for Closure Date */
            --final-closure-color: #8e44ad;
            /* Purple for Final Closure Date */
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;
        }

        .faculty-header {
            color: var(--primary-dark);
            font-size: 1.25rem;
            font-weight: 500;
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

        .search-input {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
            outline: none;
        }

        .detail-label {
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .detail-value-contributors {
            color: var(--contributors-color);
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .detail-value-closure {
            color: var(--closure-date-color);
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .detail-value-final-closure {
            color: var(--final-closure-color);
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .btn-search {
            background-color: var(--primary-light);
            border: none;
            font-weight: 500;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--primary-light);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .btn-notification:hover {
            background-color: var(--primary-dark);
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .faculty-icon {
            color: var(--primary-light);
            margin-right: 0.5rem;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include "headermc.php"; ?>
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <div class="card">
            <!-- Faculty Header with Search -->
            <div class="p-4 border-bottom border-gray-200 d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="faculty-header d-flex align-items-center"><i class="fa-solid fa-microchip faculty-icon"></i>
                        Faculty of <?= $facultyname ?>
                    </h2>
                    <div class="mt-2 text-sm text-muted">
                        <span>Marketing Coordinator - <?= $username ?></span>
                    </div>
                    <div class="mt-2 text-sm text-muted">
                        <span>Total Students - <?php echo count($students); ?></span>
                    </div>
                </div>
                <div class="mt-3 mt-md-0 col-md-6 d-flex align-items-end">
                    <input type="text" id="search" class="form-control search-input me-2" placeholder="Search contributions...">
                    <button class="btn-search px-4 py-2 rounded-pill shadow-sm d-flex align-items-center">
                        <i class="fas fa-search me-2"></i> Search
                    </button>
                </div>
            </div>

            <!-- Contribution Cards -->
            <div class="p-4">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 g-4">
                    <div class="col">
                        <div class="card p-4">
                            <h3 class="text-center text-lg font-medium text-gray-900"><?php echo $facultyname; ?></h3>
                            <div class="mt-4 space-y-3">
                                <!-- <div class="detail-row">
                                    <span class="detail-label">Total Contributors:</span>
                                    <span class="detail-value-contributors"><?php echo $contribution['contributors']; ?></span>
                                </div> -->
                                <div class="detail-row">
                                    <span class="detail-label">Closure Date:</span>
                                    <span class="detail-value-closure"><?php echo $settings['closure_date']; ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Final Closure Date:</span>
                                    <span class="detail-value-final-closure"><?php echo $settings['final_closure_date']; ?></span>
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <a href="viewarticlebyfaculty1.php" class="btn btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Notification Button -->
    <button class="btn-notification" data-bs-toggle="modal" data-bs-target="#notificationModal">
        <i class="fas fa-bell"></i>
    </button>

    <!-- Include Notification Modal -->
    <?php include "notifications.php"; ?>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>