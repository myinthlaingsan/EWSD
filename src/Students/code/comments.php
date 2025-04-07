<?php 
include("../../../vendor/autoload.php");
use Helpers\HTTP;
use Libs\Database\ArticleTable;
use Libs\Database\UsersTable;
use Libs\Database\MySQL;

$table = new ArticleTable(new MySQL);
$usertable = new UsersTable(new MySQL);
$article_id = $_POST['article_id'];
$article = $table->getArticleById($article_id);

$role = $usertable->getUserRoleName($_POST['user_id']);
$created_at = new DateTime($article['created_at']);
$now = new DateTime();
$interval_days = $created_at->diff($now)->days;

// If Coordinator and more than 14 days passed → block comment
if (strtolower($role) === 'coordinator' && $interval_days > 14) {
    $_SESSION['error'] = "You can only comment within 14 days of article upload.";
    HTTP::redirect("/src/Coordinator/design/viewdetail.php?id=" . $article_id);
}
$table->insertComment([
    "user_id" => $_POST['user_id'],
    "article_id" => $_POST['article_id'],
    "comment_text" => $_POST['comment_text'],
]);
// Get all comments for the article
$comments = $table->getCommnetbyarticleid($article_id);// Get the last inserted comment (assuming it's the one we just added)
$lastComment = end($comments);

if (!empty($lastComment['role_name'])) {
    switch ($lastComment['role_name']) {
        case "Student":
            HTTP::redirect("/src/Students/design/view_articles.php");
            break;
        case "Coordinator":
            // $_SESSION['error'] = "You can only comment within 14 days of article upload.";
            HTTP::redirect("/src/Coordinator/design/viewdetail.php?id=" . $article_id , "comment=error");
            break;
        default:
            HTTP::redirect("/src/Auth/design/login.php", "unauthorized=1");
    }
} else {
    // If no role_name found, redirect to login
    HTTP::redirect("/src/Auth/design/login.php", "unauthorized=1");
}
?>