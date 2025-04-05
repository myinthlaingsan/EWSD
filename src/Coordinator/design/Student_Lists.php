<?php
include('../../../vendor/autoload.php');
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\ArticleTable;
$auth = Auth::check();
$user_id = $auth->id;
$faculty_id = $auth->faculty_id;
$table = new UsersTable(new MySQL);
$articleTable = new ArticleTable(new MySQL);
$facultyname = $articleTable->getfacultyname($faculty_id);
$students = $table->getStudentRolesByFaculty($faculty_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <meta name="description" content="List of students managed by Marketing Coordinator">
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
            --contributors-color: rgb(12, 0, 117);
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
        .detail-value {
            color: var(--contributors-color);
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: 0.5rem;
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
        .student-icon {
            width: 3rem;
            height: 3rem;
            background-color: #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--text-muted);
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
                    <h2 class="faculty-header d-flex align-items-center">
                        <i class="fa-solid fa-microchip faculty-icon"></i>
                        Faculty of <?= $facultyname ?>
                    </h2>
                    <div class="mt-2 text-sm text-muted">
                        <span>Total Students - <?php echo count($students); ?></span>
                    </div>
                </div>
                <div class="mt-3 mt-md-0 col-md-6 d-flex align-items-end">
                    <input type="text" id="search" class="form-control search-input me-2" placeholder="Search students...">
                    <button class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center">
                        <i class="fas fa-search me-2"></i> Search
                    </button>
                </div>
            </div>

            <!-- Student Cards -->
            <div class="p-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4"><i class="fa-solid fa-users p-3"></i>Student Lists</h3>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 g-4">
                    <?php foreach ($students as $student) : ?>
                    <div class="col">
                        <div class="card p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="student-icon me-3">
                                    <?php echo substr($student['name'], 0, 1); ?>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 mb-0"><?php echo $student['name']; ?></h4>
                            </div>
                            <div class="mt-3 space-y-3">
                                <div class="detail-row">
                                    <span class="detail-label">Join Date:</span>
                                    <span class="detail-value"><?php echo $student['created_at']; ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Phone:</span>
                                    <span class="detail-value"><?php echo $student['phone']; ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Email:</span>
                                    <span class="detail-value"><?php echo $student['email']; ?></span>
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <a href="Student_Details.php?id=<?= $student['id'] ?>" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center justify-content-center mx-auto">
                                    <i class="fas fa-eye me-2"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
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