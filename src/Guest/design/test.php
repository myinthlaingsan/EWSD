<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;
use Libs\Database\ActivityLogsTable;

$auth = Auth::check();
$user_id = $auth->id ?? null;
$faculty_id = $auth->faculty_id;
$table = new ArticleTable(new MySQL);
$articles = $table->getSelectedArticles($faculty_id);

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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Selected Articles - Riverstone University</title>
  <!-- Font Awesome Link -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

  <!-- Main CSS Link -->
  <link rel="stylesheet" href="../../Students/university.css" />

  <!-- Bootstrap CSS CDN LInk -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
    
  <style>
    .file-icon {
      font-size: 1.2rem;
      margin-right: 8px;
    }
    .file-list {
      list-style-type: none;
      padding-left: 0;
    }
    .file-list li {
      margin-bottom: 8px;
    }
    .gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 15px;
    }
    .gallery img {
      max-width: 200px;
      height: auto;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: transform 0.3s;
    }
    .gallery img:hover {
      transform: scale(1.05);
    }
    .card {
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border: none;
    }
    .card-header {
      background-color: #f8f9fa;
      border-bottom: 1px solid #eee;
      font-weight: 600;
    }
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
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title hearder1" id="offcanvasNavbarLabel">
            Riverstone University
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="navbar-nav offcanvas-body justify-content-lg-end mb-lg-0">
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="./dashboard.php">Home</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="create_articles.php">Add Article</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="viewselected.php">View Article</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="#aboutus">About</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" href="#contactpage">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../Auth/code/logout.php">
              <i class="fa-solid me-2 fa-arrow-right-to-bracket"></i>
              Logout
            </a>
          </li>
        </div>
      </div>
    </div>
  </nav>
  <!-- Nav bar end -->
  
  <div class="container mt-4 mb-5">
    <h2 class="mb-4">Selected Articles</h2>
    
    <?php if (!empty($articles)) : ?>
      <?php foreach ($articles as $article) : 
        // Process multiple files
        $docFiles = !empty($article['docfiles']) ? explode('|||', $article['docfiles']) : [];
        $imageFiles = !empty($article['imagefiles']) ? explode('|||', $article['imagefiles']) : [];
      ?>
        <div class="card mb-4">
          <div class="card-header">
            <?= htmlspecialchars($article['title']) ?>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <p><strong>Author:</strong> <?= htmlspecialchars($article['name']) ?></p>
                <p><strong>Faculty:</strong> <?= htmlspecialchars($article['faculty_name']) ?></p>
              </div>
              <div class="col-md-6 text-md-end">
                <p class="text-muted"><small>Created on: <?= date('F j, Y', strtotime($article['created_at'])) ?></small></p>
                <span class="badge bg-<?= $article['status'] === 'selected' ? 'success' : 'primary' ?>">
                  <?= ucfirst($article['status']) ?>
                </span>
              </div>
            </div>
            
            <!-- Document Attachments -->
            <?php if (!empty($docFiles)) : ?>
              <div class="mt-3">
                <h5>Document Attachments</h5>
                <ul class="file-list">
                  <?php foreach ($docFiles as $docFile) : 
                    $filePath = "../../../uploads/documents/" . htmlspecialchars($docFile);
                    $fileExt = pathinfo($docFile, PATHINFO_EXTENSION);
                    $fileIcon = getFileIcon($fileExt);
                  ?>
                    <li>
                      <i class="fas <?= $fileIcon ?> file-icon"></i>
                      <?php if (in_array($fileExt, ['txt', 'pdf'])) : ?>
                        <a href="<?= $filePath ?>" target="_blank"><?= htmlspecialchars($docFile) ?></a>
                      <?php elseif (in_array($fileExt, ['doc', 'docx'])) : ?>
                        <a href="https://docs.google.com/gview?url=<?= urlencode('http://' . $_SERVER['HTTP_HOST'] . '/uploads/documents/' . $docFile) ?>&embedded=true" target="_blank">
                          View <?= htmlspecialchars($docFile) ?>
                        </a>
                        
                      <?php else : ?>
                        <a href="<?= $filePath ?>" download>Download <?= htmlspecialchars($docFile) ?></a>
                      <?php endif; ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
            
            <!-- Image Attachments -->
            <?php if (!empty($imageFiles)) : ?>
              <div class="mt-3">
                <h5>Image Attachments</h5>
                <div class="gallery">
                  <?php foreach ($imageFiles as $imageFile) : ?>
                    <a href="../../../uploads/images/<?= htmlspecialchars($imageFile) ?>" target="_blank">
                      <img src="../../../uploads/images/<?= htmlspecialchars($imageFile) ?>" 
                           alt="Article Image" 
                           class="img-fluid rounded shadow">
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <div class="alert alert-info">
        No selected articles found for your faculty.
      </div>
    <?php endif; ?>
  </div>

  <script src="../../Students/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
function getFileIcon($extension) {
    $icons = [
        'pdf' => 'fa-file-pdf',
        'doc' => 'fa-file-word',
        'docx' => 'fa-file-word',
        'txt' => 'fa-file-alt',
        'jpg' => 'fa-file-image',
        'jpeg' => 'fa-file-image',
        'png' => 'fa-file-image',
        'gif' => 'fa-file-image',
        'zip' => 'fa-file-archive',
        'rar' => 'fa-file-archive',
        'xls' => 'fa-file-excel',
        'xlsx' => 'fa-file-excel',
        'ppt' => 'fa-file-powerpoint',
        'pptx' => 'fa-file-powerpoint'
    ];
    
    return $icons[strtolower($extension)] ?? 'fa-file';
}
?>