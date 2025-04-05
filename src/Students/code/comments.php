<?php 
include("../../../vendor/autoload.php");
use Helpers\HTTP;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;

$table = new ArticleTable(new MySQL);

$article_id = $_POST['article_id'];
$table->insertComment([
    "user_id" => $_POST['user_id'],
    "article_id" => $_POST['article_id'],
    "comment_text" => $_POST['comment_text'],
]);

// Get all comments for the article
$comments = $table->getCommnetbyarticleid($article_id);

// Get the last inserted comment (assuming it's the one we just added)
$lastComment = end($comments);

if (!empty($lastComment['role_name'])) {
    switch ($lastComment['role_name']) {
        case "Student":
            HTTP::redirect("/src/Students/design/view_articles.php");
            break;
        case "Coordinator":
            HTTP::redirect("/src/Coordinator/design/viewdetail.php?id=" . $article_id);
            break;
        default:
            HTTP::redirect("/src/Auth/design/login.php", "unauthorized=1");
    }
} else {
    // If no role_name found, redirect to login
    HTTP::redirect("/src/Auth/design/login.php", "unauthorized=1");
}
?>