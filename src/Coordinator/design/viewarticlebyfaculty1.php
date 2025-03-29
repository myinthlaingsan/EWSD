<?php 
include("../../../vendor/autoload.php");
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;

$auth=Auth::check();
$faculty_id = $auth->faculty_id;
$user_id = $auth->id;
$table = new ArticleTable(new MySQL);
$facultyArticles = $table->getFacultyArticles($faculty_id);
$facultyname = $table->getFacultyName($faculty_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribution Details</title>
    <meta name="description" content="Details of a specific contribution">
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
        .card {
            background: var(--card-bg);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .search-input {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .search-input:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
            outline: none;
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
        .contributor-icon {
            width: 2.5rem;
            height: 2.5rem;
            background-color: #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }
        .pagination .page-item.active .page-link {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
            color: #ffffff;
        }
        .pagination .page-link {
            color: var(--text-muted);
        }
        .pagination .page-link:hover {
            background-color: #f1f5f9;
        }
        .contribution-image {
            width: 100%;
            height: 12rem;
            object-fit: cover;
        }
        .btn-search {
            background-color: var(--primary-light);
            border: none;
            color: #ffffff;
            transition: background-color 0.2s ease;
        }
        .btn-search:hover {
            background-color: var(--primary-dark);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headermc.php"; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <!-- Contribution Info -->
        <div class="card p-4 mb-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <span class="text-muted font-medium">Faculty Name</span>
                        <span class="mx-2">-</span>
                        <span class="text-gray-900"><?php echo $facultyname; ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted font-medium">Total Contributors</span>
                        <span class="mx-2">-</span>
                        <span class="text-gray-900"><?php echo 2; ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted font-medium">Final Closure Date</span>
                        <span class="mx-2">-</span>
                        <span class="text-gray-900"><?php echo 2; ?></span>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-start">
                    <div class="w-100" style="max-width: 300px;">
                        <div class="input-group">
                            <input type="text" class="form-control search-input" placeholder="Search by Student">
                            <button class="btn btn-search px-3"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contribution Cards -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
            <?php foreach ($facultyArticles as $facultyArticle) : ?>
            <div class="col">
                <div class="card overflow-hidden">
                    <div class="h-48">
                        <?php if ($facultyArticle['imagefile']) { ?>
                            <img src="../../../uploads/images/<?php echo $facultyArticle['imagefile']; ?>" alt="<?php echo $facultyArticle['imagefile']; ?>'s submission" class="contribution-image">
                        <?php } else { ?>
                            <div class="h-48 bg-gray-200 d-flex align-items-center justify-content-center">
                                <span class="text-muted">No Image</span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="contributor-icon me-3"><?php echo substr($facultyArticle['student_name'], 0, 1); ?></div>
                            <span class="font-medium"><?php echo $facultyArticle['student_name']; ?></span>
                        </div>
                        <div class="text-sm text-muted mb-3">
                            Upload Time: <?php echo $facultyArticle['created_at']; ?>
                        </div>
                        <a href="viewdetail.php?id=<?= $facultyArticle['article_id'] ?>" class="btn btn-outline-primary w-100 py-2">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mb-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
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