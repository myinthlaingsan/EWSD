<?php 
include("../../../vendor/autoload.php");
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;
use Libs\Database\UsersTable;

$auth = Auth::check();
$faculty_id = $auth->faculty_id;
$user_id = $auth->id;
$table = new ArticleTable(new MySQL);
$usertable = new UsersTable(new MySQL);
$facultyArticles = $table->getFacultyArticles($faculty_id);
$facultyname = $table->getFacultyName($faculty_id);
// $usercreatedarticle = $table->articlesCreateUser();
$students = $usertable->getStudentRolesByFaculty($faculty_id);
$finalclosuredate = $usertable->selectFinalClosureDate();
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
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
            transition: transform 0.3s ease;
        }
        .contribution-image:hover {
            transform: scale(1.03);
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
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 10px;
        }
        .image-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
        }
        .badge-status {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 50px;
        }
        .badge-pending {
            background-color: #f59e0b;
            color: white;
        }
        .badge-selected {
            background-color: #10b981;
            color: white;
        }
        .badge-rejected {
            background-color: #ef4444;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headermc.php"; ?>
    <?php if (isset($_SESSION['delete'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['delete']; ?>
        </div>
        <?php unset($_SESSION['delete']); ?>
    <?php endif; ?>
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <!-- Contribution Info -->
        <div class="card p-4 mb-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <span class="text-muted font-medium">Faculty Name</span>
                        <span class="mx-2">-</span>
                        <span class="text-gray-900"><?= htmlspecialchars($facultyname) ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted font-medium">Total Contributors</span>
                        <span class="mx-2">-</span>
                        <span class="text-gray-900"><?php echo count($students); ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted font-medium">Final Closure Date</span>
                        <span class="mx-2">-</span>
                        <span class="text-gray-900"><?= htmlspecialchars($finalclosuredate) ?></span>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-start">
                    <div class="w-100" style="max-width: 300px;">
                        <div class="input-group">
                            <input type="text" class="form-control search-input" placeholder="Search by Student" id="searchInput">
                            <button class="btn btn-search px-3" id="searchButton"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contribution Cards -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5" id="articlesContainer">
            <?php foreach ($facultyArticles as $article) : 
                $images = !empty($article['imagefiles']) ? explode('|||', $article['imagefiles']) : [];
                $mainImage = !empty($images) ? $images[0] : null;
                ?>
                <div class="col article-card" data-student="<?= strtolower(htmlspecialchars($article['student_name'])) ?>">
                    <div class="card overflow-hidden h-100">
                        <div class="h-48">
                            <?php if ($mainImage) : ?>
                                <img src="../../../uploads/images/<?= htmlspecialchars($mainImage) ?>" 
                                     alt="Contribution image" 
                                     class="contribution-image w-100">
                            <?php else : ?>
                                <div class="h-48 bg-gray-200 d-flex align-items-center justify-content-center">
                                    <span class="text-muted">No Image</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-4 d-flex flex-column h-100">
                            <div class="d-flex align-items-center mb-3">
                                <div class="contributor-icon me-3">
                                    <?= strtoupper(substr(htmlspecialchars($article['student_name']), 0, 1)) ?>
                                </div>
                                <div>
                                    <span class="font-medium d-block"><?= htmlspecialchars($article['student_name']) ?></span>
                                    <span class="badge badge-<?= 
                                        $article['status'] === 'pending' ? 'pending' : 
                                        ($article['status'] === 'selected' ? 'selected' : 'rejected') 
                                    ?> badge-status">
                                        <?= ucfirst($article['status']) ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="text-sm text-muted mb-3">
                                <i class="far fa-clock me-1"></i>
                                <?= date('M j, Y g:i A', strtotime($article['created_at'])) ?>
                            </div>
                            <div class="text-sm text-muted mb-3">
                                <i class="far fa-clock me-1"></i>
                                <?= $article['academicyear'] ?>
                            </div>
                            <?php if (count($images) > 1) : ?>
                                <div class="mb-3">
                                    <small class="text-muted">Additional Images:</small>
                                    <div class="image-gallery">
                                        <?php foreach (array_slice($images, 1) as $image) : ?>
                                            <img src="../../../uploads/images/<?= htmlspecialchars($image) ?>" 
                                                 alt="Additional image" 
                                                 class="image-thumbnail"
                                                 onclick="window.open('../../../uploads/images/<?= htmlspecialchars($image) ?>', '_blank')">
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="mt-auto">
                                <a href="viewdetail.php?id=<?= $article['article_id'] ?>" 
                                   class="btn btn-outline-primary w-100 py-2">
                                   <i class="far fa-eye me-1"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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

    <script>
        // Simple client-side search functionality
        document.getElementById('searchButton').addEventListener('click', function() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const articles = document.querySelectorAll('.article-card');
            
            articles.forEach(article => {
                const studentName = article.getAttribute('data-student');
                if (studentName.includes(searchTerm)) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        });
        
        // Allow search on Enter key
        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('searchButton').click();
            }
        });
    </script>
</body>
</html>