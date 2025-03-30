<?php
include('../../../vendor/autoload.php');

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;

$auth = Auth::check();
$table = new ArticleTable(new MySQL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $article_id = $_POST['article_id'];
    $title = $_POST['title'];
    $status = $_POST['status'];

    // Update article metadata
    $updated = $table->updateArticle([
        "article_id" => $article_id,
        "title" => $title,
        "status" => $status,
    ]);

    if (!$updated) {
        die("Failed to update article.");
    }

    // Handle Document Updates
    if (!empty($_FILES['docfile']['name'][0])) {
        $table->deleteArticleDocs($article_id); // Remove old docs
        $uploadDir = "../../../uploads/documents/";

        foreach ($_FILES['docfile']['tmp_name'] as $key => $tmp_name) {
            $fileName = time() . "_" . basename($_FILES['docfile']['name'][$key]);
            $filePath = $uploadDir . $fileName;
            $fileExtension = pathinfo($_FILES['docfile']['name'][$key], PATHINFO_EXTENSION);

            if (in_array($fileExtension, ["doc", "docx", "txt", "pdf"])) {
                if (move_uploaded_file($tmp_name, $filePath)) {
                    $table->insertDoc([
                        "article_id" => $article_id,
                        "docfile" => $fileName,
                    ]);
                }
            }
        }
    }

    // Handle Image Updates
    if (!empty($_FILES['imagefile']['name'][0])) {
        $table->deleteArticleImages($article_id); // Remove old images
        $imageDir = "../../../uploads/images/";

        foreach ($_FILES['imagefile']['tmp_name'] as $key => $tmp_name) {
            $imageName = time() . "_" . basename($_FILES['imagefile']['name'][$key]);
            $imagePath = $imageDir . $imageName;
            $imageExtension = pathinfo($_FILES['imagefile']['name'][$key], PATHINFO_EXTENSION);

            if (in_array($imageExtension, ["jpg", "png"])) {
                if (move_uploaded_file($tmp_name, $imagePath)) {
                    $table->insertImage([
                        "article_id" => $article_id,
                        "imagefile" => $imageName,
                    ]);
                }
            }
        }
    }

    $comments = $table->getCommnetbyarticleid($facultyArticle['article_id']);
    if ($comments['role_name'] === "Student") {
        HTTP::redirect('/src/Coordinator/design/view_detail.php?id=' . $article_id);
    } else {
        HTTP::redirect('/src/Coordinator/design/view_detail.php?id=' . $article_id);
    }
    //HTTP::redirect('/src/Coordinator/design/view_detail.php?id=' . $article_id);
}
