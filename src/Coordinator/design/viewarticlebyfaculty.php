<?php 
include("../../../vendor/autoload.php");
use Helpers\Auth;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;

$auth=Auth::check();
$faculty_id = $auth->faculty_id;
$table = new ArticleTable(new MySQL);
$facultyArticles = $table->getFacultyArticles($faculty_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($facultyArticles as $facultyArticle) : ?>
        <h1><?= $facultyArticle['title'] ?></h1>
        <h1><?= $facultyArticle['docfile'] ?></h1>
        <h1><?= $facultyArticle['imagefile'] ?></h1>
    <?php endforeach ?>
</body>
</html>