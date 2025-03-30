<?php
include('../../../vendor/autoload.php');
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;
use Libs\Database\UsersTable;

$auth = Auth::check();
$id = $_GET['id'] ?? null;
$faculty_id = $auth->faculty_id;
$table = new ArticleTable(new MySQL);
$usertable = new UsersTable(new MySQL);
$student = $usertable->getuserbyId($id);
$articles = $table->getArticlesByUserId($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <meta name="description" content="Details of a specific student">
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
        .card {
            background: var(--card-bg);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
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
        .detail-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .contribution-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .contribution-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
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
        <div class="card p-4">
            <!-- Student Info Section -->
            <h3 class="text-lg font-medium text-gray-900 mb-4"><i class="fa-solid fa-user-graduate me-3"></i>Student Info</h3>
            <div class="d-flex align-items-center mb-4">
                <div class="student-icon me-3">
                    <?php echo substr($student->name, 0, 1); ?>
                </div>
                <div>
                    <h4 class="font-medium text-gray-900 mb-1"><?php echo $student->name; ?></h4>
                    <div class="space-y-2">
                        <div class="detail-row">
                            <span class="detail-label">Join Date:</span>
                            <span class="detail-value"><?php echo $student->created_at; ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Phone:</span>
                            <span class="detail-value"><?php echo $student->phone; ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value"><?php echo $student->email; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Contributions Section -->
            <h3 class="text-lg font-medium text-gray-900 mb-4 mt-5"><i class="fa-solid fa-file-alt me-3"></i>Student Contributions</h3>
            <?php if (empty($articles)) : ?>
                <p class="text-muted">No contributions found for this student.</p>
            <?php  else : ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach ($articles as $article) : ?>
                    <div class="col">
                        <div class="card contribution-card p-4">
                            <h4 class="text-md font-medium text-gray-900 mb-2"><?php echo $article['title']; ?></h4>
                            <div class="detail-row">
                                <span class="detail-label">Submitted by:</span>
                                <span class="detail-value"><?php echo $article['name']; ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Upload Time:</span>
                                <span class="detail-value"><?php echo $article['created_at']; ?></span>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="viewdetail.php?id=<?= $article['article_id'] ?>" 
                                   class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center justify-content-center mx-auto">
                                    <i class="fas fa-eye me-2"></i> View Submission
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <!-- Back Button -->
            <div class="mt-5">
                <a href="Student_Lists.php" class="btn btn-outline-primary px-4 py-2 rounded-pill"><i class="fa-solid fa-arrow-left p-2"></i>Back to Student List</a>
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