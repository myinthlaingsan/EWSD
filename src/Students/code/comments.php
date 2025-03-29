<?php 
include("../../../vendor/autoload.php");
use Helpers\HTTP;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;

$table = new ArticleTable(new MySQL);
$table->insertComment([
    "user_id" => $_POST['user_id'],
    "article_id" => $_POST['article_id'],
    "comment_text" => $_POST['comment_text'],
]);
$comments = $table->getCommnetbyarticleid($facultyArticle['article_id']);
if($comments['role_name'] === "Student"){
    HTTP::redirect("/src/Students/design/view_articles.php");
}else{
    HTTP::redirect("/src/Coordinator/design/viewdetail.php");
}

?>