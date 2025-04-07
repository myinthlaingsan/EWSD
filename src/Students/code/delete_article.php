<?php
include('../../../vendor/autoload.php');
use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;
// $articleManager = new ArticleTable(new MySQL);
$auth = Auth::check();
$article_id = $_GET['id'];
$user_id = $auth->id ?? null;;

$articleManager = new ArticleTable(new MySQL);

try {
    if ($articleManager->deleteArticle($article_id, $user_id)) {
        $_SESSION['success'] = "Article and all related data deleted successfully.";
    } else {
        $_SESSION['error'] = "Article not found or permission denied.";
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
}
HTTP::redirect('/src/Students/design/view_articles.php');
?>