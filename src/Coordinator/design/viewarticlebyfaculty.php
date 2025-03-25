<?php 
include("../../../vendor/autoload.php");
use Helpers\Auth;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;

$auth=Auth::check();
$faculty_id = $auth->faculty_id;
$user_id = $auth->id;
$table = new ArticleTable(new MySQL);
$facultyArticles = $table->getFacultyArticles($faculty_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Font Awesome Link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Main CSS Link -->
    <link rel="stylesheet" href="../university.css" />

    <!-- Bootstrap CSS CDN LInk -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
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
            <li class="nav-item">
              <a class="nav-link" href="../../Auth/design/register.php"
                ><i class="fa-solid me-2 fa-arrow-right-to-bracket"></i>Sign
                In</a
              >
            </li>
          </div>
        </div>
      </div>
    </nav>
    <!-- Nav bar end -->
    <div class="container mt-4">
        <h2>My Articles</h2>
        <?php if (!empty($facultyArticles)) : ?>
            <?php foreach ($facultyArticles as $facultyArticle) : ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5><strong>Article Title:</strong> <?= htmlspecialchars($facultyArticle['title']) ?></h5>
                        <p><strong>Status:</strong> <?= ucfirst($facultyArticle['status']) ?></p>
                        <p><small>Created on: <?= date('F j, Y', strtotime($facultyArticle['created_at'])) ?></small></p>

                        <!-- Document Attachments -->
                        <?php if ($facultyArticle['docfile']) : ?>
                            <p><strong>Documents:</strong></p>
                            <ul>
                                <?php
                                $filePath = "../../../uploads/documents/" . htmlspecialchars($facultyArticle['docfile']);
                                $fileExt = pathinfo($facultyArticle['docfile'], PATHINFO_EXTENSION);
                                ?>

                                <?php if ($fileExt === 'txt'): ?>
                                    <!-- Open TXT directly -->
                                    <li><a href="<?= $filePath ?>" target="_blank"><?= htmlspecialchars($facultyArticle['docfile']) ?></a></li>

                                <?php elseif ($fileExt === 'pdf'): ?>
                                    <!-- Open PDF directly -->
                                    <li><a href="<?= $filePath ?>" target="_blank"><?= htmlspecialchars($facultyArticle['docfile']) ?></a></li>

                                <?php elseif ($fileExt === 'doc' || $fileExt === 'docx'): ?>
                                    <!-- Use Google Docs Viewer for DOC and DOCX -->
                                    <li>
                                        <a href="https://docs.google.com/gview?url=<?= urlencode('http://yourwebsite.com/uploads/documents/' . $article['docfile']) ?>&embedded=true" target="_blank">
                                            View <?= htmlspecialchars($facultyArticle['docfile']) ?> Online
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <!-- For unsupported files, just provide a download link -->
                                    <li><a href="<?= $filePath ?>" download>Download <?= htmlspecialchars($facultyArticle['docfile']) ?></a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>

                        <!-- Image Attachments -->
                        <?php if ($facultyArticle['imagefile']) : ?>
                            <p><strong>Images:</strong></p>
                            <img src="../../../uploads/images/<?= htmlspecialchars($facultyArticle['imagefile']) ?>" alt="Image" class="img-fluid rounded shadow" style="max-width: 200px;">
                        <?php endif; ?>

                        <!-- Fetch and Display Comments for This Article -->
                        <?php
                        $comments = $table->getCommnetbyarticleid($facultyArticle['article_id']);
                        ?>
                        <div class="mt-3">
                            <h6>Comments:</h6>
                            <?php if (!empty($comments)) : ?>
                                <ul class="list-group">
                                    <?php foreach ($comments as $comment) : ?>
                                        <li class="list-group-item">
                                            <?= htmlspecialchars($comment['comment_text']) ?>
                                            <small class="text-muted">(ROLE: <?= $comment['role_name'] ?>)</small>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php else : ?>
                                <p class="text-muted">No comments found for this article.</p>
                            <?php endif ?>
                        </div>

                        <!-- Comment Form -->
                        <form action="../../Students/code/comments.php" method="post" class="mt-3">
                            <input type="hidden" name="article_id" value="<?= $facultyArticle['article_id'] ?>">
                            <input type="text" name="user_id" value="<?= $user_id ?>">
                            <div class="mb-3">
                                <label for="comment_text" class="form-label">Add a Comment:</label>
                                <textarea name="comment_text" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-muted">No articles found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>