<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;

$auth = Auth::check();
$table = new ArticleTable(new MySQL);
$article_id = $_GET['id'];
$faculty_id = $auth->faculty_id;
$article = $table->articlebyfacultydetail($article_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
    <?php include "headermc.php"; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Update Article</h2>

        <form action="../../Students/code/update_article.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="article_id" value="<?= $article['article_id'] ?>">

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="<?= $article['title'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control" name="status" value="<?= $article['status'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="../../../uploads/images/<?= $article['imagefile'] ?>" alt="Article Image" class="img-thumbnail" width="200">
            </div>

            <div class="mb-3">
                <label class="form-label">Upload New Image (Optional)</label>
                <input type="file" class="form-control" id="formFileMultiple"
                    name="imagefile[]"
                    accept="image/*"
                    multiple required>
            </div>

            <div class="mb-3">
                <label class="form-label">Current Document</label><br>
                <a href="../../../uploads/documents/<?= $article['docfile'] ?>" target="_blank">
                    <?= $article['docfile'] ?>
                </a>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload New Document (Optional)</label>
                <input type="file" class="form-control" id="formFileMultiple"
                    name="docfile[]"
                    accept=".doc,.docx,.pdf,.txt"
                    multiple required aria-describedby="filehelp">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="viewarticlebyfaculty1.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <!-- Notification Button -->
    <button class="btn-notification" data-bs-toggle="modal" data-bs-target="#notificationModal">
        <i class="fas fa-bell"></i>
    </button>
    <!-- Include Notification Modal -->
    <?php include "notifications.php"; ?>

    <?php include "footer.php"; ?>
</body>

</html>