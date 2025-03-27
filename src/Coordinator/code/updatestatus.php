<?php
include('../../../vendor/autoload.php');

use Helpers\HTTP;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];

    $table = new ArticleTable(new MySQL);
    $table->updateArticleStatus($article_id); // Pass only the ID, not an array

    HTTP::redirect('/src/Coordinator/design/viewarticlebyfaculty.php');
} else {
    echo "Invalid request.";
}
?>