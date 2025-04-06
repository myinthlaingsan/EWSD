<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;
use Libs\Database\ActivityLogsTable;

$auth = Auth::check();
$user_id = $auth->id ?? null;
$table = new ArticleTable(new MySQL);
$articles = $table->getArticlesByUserId($user_id);

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
  <title>My Articles</title>
  <!-- Font Awesome Link -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

  <!-- Main CSS Link -->
  <link rel="stylesheet" href="../university.css" />

  <!-- Bootstrap CSS CDN LInk -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
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
            <a
              class="nav-link"
              aria-current="page"
              href="./dashboard.php">Home</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="create_articles.php">Add Article</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link active" aria-current="page" href="view_articles.php">View Article</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="#aboutus">About</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" href="#contactpage">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../Auth/code/logout.php"><i class="fa-solid me-2 fa-arrow-right-from-bracket"></i>Logout</a>
          </li>
        </div>
      </div>
    </div>
  </nav>
  <!-- Nav bar end -->

  <div class="container mt-4">
    <h2>My Articles</h2>
    <?php if (!empty($articles)) : ?>
      <?php foreach ($articles as $article) : ?>
        <div class="card mb-4">
          <div class="card-body">
            <h5><strong>Article Title:</strong> <?= htmlspecialchars($article['title']) ?></h5>
            <p><strong>Status:</strong> <span class="badge bg-<?= $article['status'] === 'selected' ? 'success' : ($article['status'] === 'pending' ? 'warning' : 'secondary') ?>"><?= ucfirst($article['status']) ?></span></p>
            <p><small>Created on: <?= date('F j, Y, g:i a', strtotime($article['created_at'])) ?></small></p>

            <!-- Document Attachments -->
            <?php if (!empty($article['docfiles'])) : ?>
              <p><strong>Documents:</strong></p>
              <ul class="list-group mb-3">
                <?php
                $documents = explode('|||', $article['docfiles']);
                foreach ($documents as $docfile) {
                  if (empty($docfile)) continue;

                  $filePath = "../../../uploads/documents/" . htmlspecialchars($docfile);
                  $fileExt = pathinfo($docfile, PATHINFO_EXTENSION);
                ?>

                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php if ($fileExt === 'txt' || $fileExt === 'pdf'): ?>
                      <!-- Open TXT and PDF directly -->
                      <a href="<?= $filePath ?>" target="_blank">
                        <i class="fas fa-file-<?= $fileExt === 'pdf' ? 'pdf' : 'alt' ?> me-2"></i>
                        <?= htmlspecialchars($docfile) ?>
                      </a>

                    <?php elseif ($fileExt === 'doc' || $fileExt === 'docx'): ?>
                      <!-- Use Google Docs Viewer for DOC and DOCX -->
                      <!-- <a href="https://docs.google.com/gview?url=<?= urlencode('http://' . $_SERVER['HTTP_HOST'] . '/uploads/documents/' . $docfile) ?>&embedded=true" target="_blank">
                        <i class="fas fa-file-word me-2"></i>
                        <?= htmlspecialchars($docfile) ?>
                      </a> -->
                      <a href="../../../uploads/documents/<?php echo htmlspecialchars($docfile); ?>" target="_blank" class="pdf-link-btn">
                          <i class="fas fa-file-pdf"></i> <?php echo htmlspecialchars($docfile); ?>
                        </a>
                    <?php else: ?>
                      <!-- For unsupported files, provide download link -->
                      <a href="<?= $filePath ?>" download>
                        <i class="fas fa-file-download me-2"></i>
                        <?= htmlspecialchars($docfile) ?>
                      </a>
                    <?php endif; ?>

                    <span class="badge bg-primary rounded-pill"><?= strtoupper($fileExt) ?></span>
                  </li>
                <?php } ?>
              </ul>
            <?php endif; ?>

            <!-- Image Attachments -->
            <?php if (!empty($article['imagefiles'])) : ?>
              <p><strong>Images:</strong></p>
              <div class="d-flex flex-wrap gap-3 mb-3">
                <?php
                $images = explode('|||', $article['imagefiles']);
                foreach ($images as $imagefile) {
                  if (empty($imagefile)) continue;
                ?>
                  <div class="position-relative">
                    <img src="../../../uploads/images/<?= htmlspecialchars($imagefile) ?>"
                      alt="Article Image"
                      class="img-thumbnail"
                      style="max-width: 200px; height: auto;">
                    <a href="../../../uploads/images/<?= htmlspecialchars($imagefile) ?>"
                      target="_blank"
                      class="position-absolute top-0 end-0 m-1 bg-white rounded-circle p-1">
                      <i class="fas fa-expand"></i>
                    </a>
                  </div>
                <?php } ?>
              </div>
            <?php endif; ?>

            <!-- Fetch and Display Comments for This Article -->
            <?php
            $comments = $table->getCommnetbyarticleid($article['article_id']);
            ?>
            <div class="mt-3">
              <h6>Comments:</h6>
              <?php if (!empty($comments)) : ?>
                <ul class="list-group mb-3">
                  <?php foreach ($comments as $comment) : ?>
                    <li class="list-group-item">
                      <div class="d-flex justify-content-between">
                        <div>
                          <?= htmlspecialchars($comment['comment_text']) ?>
                        </div>
                        <div>
                          <small class="text-muted"><?= date('M j, g:i a', strtotime($comment['created_at'])) ?></small>
                          <span class="badge bg-<?= $comment['role_name'] === 'Coordinator' ? 'danger' : 'info' ?> ms-2">
                            <?= ucfirst($comment['role_name']) ?>
                          </span>
                        </div>
                      </div>
                    </li>
                  <?php endforeach ?>
                </ul>
              <?php else : ?>
                <div class="alert alert-info">No comments yet.</div>
              <?php endif ?>
            </div>

            <!-- Comment Form -->
            <form action="../code/comments.php" method="post" class="mt-3">
              <input type="hidden" name="article_id" value="<?= $article['article_id'] ?>">
              <input type="hidden" name="user_id" value="<?= $user_id ?>">
              <div class="mb-3">
                <label for="comment_text" class="form-label">Add a Comment:</label>
                <textarea name="comment_text" class="form-control" rows="3" required placeholder="Write your comment here..."></textarea>
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-comment me-1"></i> Add Comment
                </button>
                <!-- Update Button (Link to Update Page) -->
                <a href="update_articles.php?id=<?= $article['article_id'] ?>" class="btn btn-warning">
                  <i class="fas fa-edit me-1"></i> Edit Article
                </a>
                <?php if ($article['status'] !== 'selected') : ?>
                  <a href="../code/delete_article.php?id=<?= $article['article_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">
                    <i class="fas fa-trash me-1"></i> Delete
                  </a>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i> You haven't submitted any articles yet.
        <a href="create_articles.php" class="alert-link">Create your first article</a>
      </div>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>