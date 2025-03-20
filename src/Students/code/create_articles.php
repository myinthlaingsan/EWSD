<?php
include("../../../vendor/autoload.php");

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;

// $table = new ArticleTable(new MySQL);
$table = new ArticleTable(new MySQL);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['agree'])) {
        die("You must agree to the Terms and Conditions.");
    }

    // Get form data
    $title = $_POST['title'];

    // Insert article metadata
    $article_id = $table->articleInsert([
        "title" => $title,
    ]);

    // Handle Word Document Uploads
    if (!empty($_FILES['docfiles']['name'][0])) {
        $uploadDir = "../../../uploads/documents/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES['docfiles']['tmp_name'] as $key => $tmp_name) {
            $fileName = time() . "_" . basename($_FILES['docfiles']['name'][$key]);
            $filePath = $uploadDir . $fileName;
            $fileExtension = pathinfo($_FILES['docfiles']['name'][$key], PATHINFO_EXTENSION);

            if (in_array($fileExtension, ["doc", "docx"])) {
                if (move_uploaded_file($tmp_name, $filePath)) {
                    $table->insertDoc([
                        "article_id" => $article_id,
                        "docfile" => $fileName,
                    ]);
                }
            }
        }
    }

    // Handle Image Uploads
    if (!empty($_FILES['imagefiles']['name'][0])) {
        $imageDir = "../../../uploads/images/";
        if (!file_exists($imageDir)) {
            mkdir($imageDir, 0777, true);
        }

        foreach ($_FILES['imagefiles']['tmp_name'] as $key => $tmp_name) {
            $imageName = time() . "_" . basename($_FILES['imagefiles']['name'][$key]);
            $imagePath = $imageDir . $imageName;
            $imageExtension = pathinfo($_FILES['imagefiles']['name'][$key], PATHINFO_EXTENSION);

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

    HTTP::redirect('/src/Admin/design/article.php');
}
?>
