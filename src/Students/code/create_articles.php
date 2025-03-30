<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../../../vendor/autoload.php");

use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;
use Libs\Database\UsersTable;
// $table = new ArticleTable(new MySQL);
$table = new ArticleTable(new MySQL);
$table2 = new UsersTable(new MySQL);
$closuredate = $table2->selectClosureDate();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['agree'])) {
        die("You must agree to the Terms and Conditions.");
    }
    // Check if new submissions are allowed
    // if ($closuredate && date('Y-m-d') > $closuredate) {
    //     die("New article submissions are closed.");
    // }
    // Get form data
    $id = $_POST['userid'];
    $title = $_POST['title'];
    // Insert article metadata
    $article_id = $table->articleInsert([
        "user_id" => $id,
        // "setting_id" => 1,
        "title" => $title,
        "status" => "submitted",
        
    ]);
    if (!$article_id) {
        die("Failed to insert article.");
    }
    // Handle Word Document Uploads
    if (!empty($_FILES['docfile']['name'][0])) {
        $uploadDir = "../../../uploads/documents/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES['docfile']['tmp_name'] as $key => $tmp_name) {
            $fileName = time() . "_" . basename($_FILES['docfile']['name'][$key]);
            $filePath = $uploadDir . $fileName;
            $fileExtension = pathinfo($_FILES['docfile']['name'][$key], PATHINFO_EXTENSION);

            if (in_array($fileExtension, ["doc", "docx", "txt", "pdf"])) {
                if (move_uploaded_file($tmp_name, $filePath)) {
                    if (!$table->insertDoc([
                        "article_id" => $article_id,
                        "docfile" => $fileName,
                    ])) {
                        error_log("Failed to insert document: " . $fileName);
                    }
                } else {
                    error_log("Failed to move uploaded file: " . $fileName);
                }
            }
        }
    }

    // Handle Image Uploads
    if (!empty($_FILES['imagefile']['name'][0])) {
        $imageDir = "../../../uploads/images/";
        if (!file_exists($imageDir)) {
            mkdir($imageDir, 0777, true);
        }

        foreach ($_FILES['imagefile']['tmp_name'] as $key => $tmp_name) {
            $imageName = time() . "_" . basename($_FILES['imagefile']['name'][$key]);
            $imagePath = $imageDir . $imageName;
            $imageExtension = pathinfo($_FILES['imagefile']['name'][$key], PATHINFO_EXTENSION);

            if (in_array($imageExtension, ["jpg", "png"])) {
                if (move_uploaded_file($tmp_name, $imagePath)) {
                    $result = $table->insertImage([
                        "article_id" => $article_id,
                        "imagefile" => $imageName,
                    ]);
                    print_r($result);
                } else {
                    echo "Error moving image file!";
                }
            } else{
                echo "Invalid image format!";
            }
        }
    }

    if ($article_id) {
        // Get all marketing coordinators
        $coordinators = $table2->getCoorEmail();
        
        // Create notification for each coordinator
        foreach ($coordinators as $coordinator) {
            $deadline = date('Y-m-d', strtotime('+14 days'));
            
            $table->insertNotification([
                "article_id" => $article_id,
                "user_id" => $coordinator->id,
                "message" => "New article submitted: '$title' requires your review within 14 days.",
                "deadline_date" => $deadline
            ]);
            
            // Send email notification
            // $this->sendEmailNotification(
            //     $coordinator->email,
            //     "New Article Submission",
            //     "A new article '$title' has been submitted for your review. Please provide comments by $deadline.",
            //     HTTP::redirect('/coordinator/review.php?id='.$article_id)
            // );
        }
         // Rest of your success handling...
    }
    HTTP::redirect('/src/Students/design/create_articles.php');
}
?>
