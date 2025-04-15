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
    <!-- Main CSS Link -->
    <link rel="stylesheet" href="../university.css" />
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
        <!-- nav bar start -->
    <nav class="navbar navbar-expand-lg sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand me-5 text-light" href="#">
          <h3>Riverstone University</h3>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="offcanvas offcanvas-end"
          tabindex="-1"
          id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel"
        >
          <div class="offcanvas-header">
            <h5 class="offcanvas-title hearder1" id="offcanvasNavbarLabel">
              Riverstone University
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="navbar-nav offcanvas-body justify-content-lg-end mb-lg-0">
            <li class="nav-item me-5">
              <a
                class="nav-link"
                aria-current="page"
                href="./dashboard.php"
                >Home</a
              >
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" aria-current="page" href="create_articles.php"
                >Add Article</a
              >
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" aria-current="page" href="view_articles.php"
                >View Article</a
              >
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" aria-current="page" href="#aboutus">Aboout</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" href="#contactpage">Contact Us</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="../../Auth/design/register.php"
                ><i class="fa-solid me-2 fa-arrow-right-to-bracket"></i>Sign
                In</a
              >
            </li> -->
            <li class="nav-item">
            <a class="nav-link" href="../../Auth/code/logout.php"><i class="fa-solid me-2 fa-arrow-right-from-bracket"></i>Logout</a>
          </li>
          </div>
        </div>
      </div>
    </nav>
    <!-- Nav bar end -->
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
            <div class="mb-3">
                <label class="form-label">Academic Year</label>
                <input type="text" class="form-control" name="academicyear" value="<?= $article['academicyear'] ?>" required>
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

    <!-- footer start -->
    <footer>
      <div class="container-fluid mt-5">
        <div class="row text-light text-center justify-content-center">
          <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
            <h3><i class="fa-solid fa-location-dot"></i></h3>
            <h5>Address</h5>
            <h6>
              Riverstone University <br />
              456 Elm St, Springfield, IL 62704, USA
            </h6>
          </div>
          <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
            <h3><i class="fa-solid fa-square-phone"></i></h3>
            <h5>Call Us</h5>
            <h6>+1 (555) 123-4567</h6>
          </div>
          <div class="col-12 col-lg-3 p-lg-4 mt-4">
            <iframe
              class="footermap1 img img-fluid rounded"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3045.624315425934!2d-89.650847684609!3d39.781734979425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8875395a5b8f5b5f%3A0x1f1e5b5b5b5b5b5b!2s456%20Elm%20St%2C%20Springfield%2C%20IL%2062704%2C%20USA!5e0!3m2!1sen!2sus!4v1633024000000!5m2!1sen!2sus"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
            >
            </iframe>
          </div>
          <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
            <h3><i class="fa-solid fa-envelope-open-text"></i></h3>
            <h5>Email</h5>
            <h6>info@riverstone.edu</h6>
          </div>
          <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
            <h3><i class="fa-regular fa-thumbs-up"></i></h3>
            <h5>Follow us</h5>
            <h6>
              <i class="me-1 fa-brands fa-facebook"></i>
              <i class="me-1 fa-brands fa-youtube"></i>
              <i class="me-1 fa-brands fa-x-twitter"></i>
              <i class="me-1 fa-brands fa-instagram"></i>
            </h6>
          </div>
          <div class="col-12 mb-4 mt-2">
            <iframe
              class="footermap2 img img-fluid rounded"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3045.624315425934!2d-89.650847684609!3d39.781734979425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8875395a5b8f5b5f%3A0x1f1e5b5b5b5b5b5b!2s456%20Elm%20St%2C%20Springfield%2C%20IL%2062704%2C%20USA!5e0!3m2!1sen!2sus!4v1633024000000!5m2!1sen!2sus"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
            >
            </iframe>
          </div>
          <div class="col-12 my-3">
            <h6>Copyright © 2025 Riverstone University. All Rights reserved</h6>
            <h6>
              Designed by <b class="text-danger"> Error 404 Team Found </b>
            </h6>
          </div>
        </div>
      </div>
    </footer>
    <!-- footer end -->

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