<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;

$auth = AUTH::check();
$user_id = $auth->id;
$table = new ArticleTable(new MySQL);
$articles = $table->getArticlesByUserId($user_id);
foreach($articles as $article){
    $article_id = $article['article_id'];
}
$comments = $table->getCommnetbyarticleid($article_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>My Articles</h2>
        <?php if (!empty($articles)) : ?>
            <?php foreach ($articles as $article) : ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5><strong>Article Title:</strong> <?= htmlspecialchars($article['title']) ?></h5>
                        <p><strong>Status:</strong> <?= ucfirst($article['status']) ?></p>
                        <p><small>Created on: <?= date('F j, Y', strtotime($article['created_at'])) ?></small></p>

                        <!-- Document Attachments -->
                        <!-- <?php if ($article['docfile']) : ?>
                            <p><strong>Documents:</strong></p>
                            <ul>
                                <li><a href="../../../uploads/documents/<?= htmlspecialchars($article['docfile']) ?>" target="_blank"><?= htmlspecialchars($article['docfile']) ?></a></li>
                            </ul>
                        <?php endif; ?> -->

                        <!-- Document Attachments -->
                        <?php if ($article['docfile']) : ?>
                            <p><strong>Documents:</strong></p>
                            <ul>
                                <?php
                                $filePath = "../../../uploads/documents/" . htmlspecialchars($article['docfile']);
                                $fileExt = pathinfo($article['docfile'], PATHINFO_EXTENSION);
                                ?>

                                <?php if ($fileExt === 'txt'): ?>
                                    <!-- Open TXT directly -->
                                    <li><a href="<?= $filePath ?>" target="_blank"><?= htmlspecialchars($article['docfile']) ?></a></li>

                                <?php elseif ($fileExt === 'pdf'): ?>
                                    <!-- Open PDF directly -->
                                    <li><a href="<?= $filePath ?>" target="_blank"><?= htmlspecialchars($article['docfile']) ?></a></li>

                                <?php elseif ($fileExt === 'doc' || $fileExt === 'docx'): ?>
                                    <!-- Use Google Docs Viewer for DOC and DOCX -->
                                    <li>
                                        <a href="https://docs.google.com/gview?url=<?= urlencode('http://yourwebsite.com/uploads/documents/' . $article['docfile']) ?>&embedded=true" target="_blank">
                                            View <?= htmlspecialchars($article['docfile']) ?> Online
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <!-- For unsupported files, just provide a download link -->
                                    <li><a href="<?= $filePath ?>" download>Download <?= htmlspecialchars($article['docfile']) ?></a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>


                        <!-- Image Attachments -->
                        <?php if ($article['imagefile']) : ?>
                            <p><strong>Images:</strong></p>
                            <img src="../../../uploads/images/<?= htmlspecialchars($article['imagefile']) ?>" alt="Image" class="img-fluid rounded shadow" style="max-width: 200px;">
                        <?php endif; ?>
                        <form action="../code/comments.php" method="post">
                            <br>
                            
                            <label>articleID</label><br>
                            <input type="text" name="article_id" value="<?= $article['article_id'] ?>"><br>
                            <label>userID</label><br>
                            <input type="text" name="user_id" value="<?= $user_id ?>"><br>
                            <label>Commnets</label><br>
                            <input type="text" name="comment_text">
                            <input type="submit" value="Add commnet">

                            <?php if($article_id == $article['article_id']) : ?>
                                <?php foreach ($comments as $comment) : ?>
                                    <h1><?= $comment['comment_text'] ?></h1>
                                <?php endforeach ?>
                            <?php else : ?>
                                <h1>No comment found for articlecID<?= $article['article_id'] ?></h1>
                            <?php endif ?>


                            
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