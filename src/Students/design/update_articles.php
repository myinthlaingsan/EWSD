<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;
use Libs\Database\ActivityLogsTable;

$auth = Auth::check();
$table = new ArticleTable(new MySQL);
$article_id = $_GET['id'];
$article = $table->articlebyfacultydetail($article_id);

$user_id = $auth->id ?? null;
$activityLogTable = new ActivityLogsTable(new MySQL);
// Extract file name from the request URI
$requestUri = $_SERVER['REQUEST_URI'];
$fileName = basename($requestUri);

// Log the page visit
$activityLogTable->logPageView(
    $user_id,
    $_SERVER['REQUEST_URI'],
    $_SERVER['HTTP_USER_AGENT'],
    $_SERVER['REMOTE_ADDR'],
    $fileName
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .current-files {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .file-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            background-color: white;
        }
        .file-item img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 15px;
        }
        .file-actions {
            margin-left: auto;
        }
        .preview-image {
            max-width: 150px;
            max-height: 150px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
    </style>
    </style>
</head>

<body>

<div class="container mt-5">
        <h2 class="mb-4">Update Article</h2>

        <form action="../code/update_article.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="article_id" value="<?= htmlspecialchars($article['article_id']) ?>">

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control" name="status" value="<?= $article['status'] ?>" required>
            </div>
            <!-- Current Images -->
            <div class="mb-3 current-files">
                <label class="form-label">Current Images</label>
                <?php if (!empty($article['images'])): 
                    $images = explode(',', $article['images']);
                    foreach ($images as $image): 
                        $image = trim($image);
                        if (!empty($image)): ?>
                            <div class="file-item">
                                <img src="../../../uploads/images/<?= htmlspecialchars($image) ?>" alt="Article Image" class="img-thumbnail">
                                <span><?= htmlspecialchars($image) ?></span>
                                
                            </div>
                        <?php endif; 
                    endforeach; 
                else: ?>
                    <p class="text-muted">No images uploaded</p>
                <?php endif; ?>
            </div>

            <!-- New Images -->
            <div class="mb-3">
                <label class="form-label">Upload New Images (Optional)</label>
                <input type="file" class="form-control" name="imagefile[]" accept="image/*" multiple>
                <small class="text-muted">You can select multiple images</small>
                <div id="imagePreview" class="mt-2 d-flex flex-wrap"></div>
            </div>

            <!-- Current Documents -->
            <div class="mb-3 current-files">
                <label class="form-label">Current Documents</label>
                <?php if (!empty($article['documents'])): 
                    $documents = explode(',', $article['documents']);
                    foreach ($documents as $doc): 
                        $doc = trim($doc);
                        if (!empty($doc)): ?>
                            <div class="file-item">
                                <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                <span><?= htmlspecialchars($doc) ?></span>
                            </div>
                        <?php endif; 
                    endforeach; 
                else: ?>
                    <p class="text-muted">No documents uploaded</p>
                <?php endif; ?>
            </div>

            <!-- New Documents -->
            <div class="mb-3">
                <label class="form-label">Upload New Documents (Optional)</label>
                <input type="file" class="form-control" name="docfile[]" accept=".pdf,.doc,.docx,.txt" multiple>
                <small class="text-muted">You can select multiple documents (PDF, Word, TXT)</small>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Article
            </button>
            <a href="viewarticlebyfaculty1.php" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </form>
    </div>

    <script>
        // Image preview functionality
        document.querySelector('input[name="imagefile[]"]').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'preview-image img-thumbnail';
                        previewContainer.appendChild(img);
                    }
                    
                    reader.readAsDataURL(file);
                }
            }
        });

        function confirmDeleteImage(filename) {
            if (confirm('Are you sure you want to delete this image?')) {
                window.location.href = `../code/delete_file.php?article_id=<?= $article['article_id'] ?>&type=image&filename=${filename}`;
            }
        }

        function confirmDeleteDoc(filename) {
            if (confirm('Are you sure you want to delete this document?')) {
                window.location.href = `../code/delete_file.php?article_id=<?= $article['article_id'] ?>&type=doc&filename=${filename}`;
            }
        }
    </script>
</body>

</html>