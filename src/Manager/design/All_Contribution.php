<?php
include("../../../vendor/autoload.php");
use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\ArticleTable;

$auth = Auth::check();
$user_id = $auth->id;
$table = new UsersTable(new MySQL);
$articleTable = new ArticleTable(new MySQL);
// check if download was requested
if (isset($_GET['download_all']) || isset($_GET['download_single'])){
    handleDownload($table,$articleTable,$user_id);
}
//Get data for display
$userRole = $table->getUserRoleName($user_id);
$finalclosuredate = $table->selectFinalClosureDate();
$currentDate = date('Y-m-d');
$selectedArticles = $articleTable->getSelectedArticles();

function handleDownload($table,$articleTable,$user_id) {
    $userRole = $table->getUserRoleName($user_id);
    if($userRole != 'Manager'){
        die("You are not authorized to download this file.");
    }

    // Closure date check
    $finalclosuredate = $table->selectFinalClosureDate();
    $currentDate = date('Y-m-d');
    // if (strtotime($currentDate) < strtotime($finalClosureDate)) {
    //     die("Download is only allowed after the final closure date ($finalClosureDate)");
    // }

    //get selected articles
    $selectedArticles = $articleTable->getSelectedArticles();
    if (empty($selectedArticles)) {
        die("No selected contributions found.");
    }

    //prepare Zip file
    $filesToZip = [];
    $baseUploadPath = __DIR__ . "/../../../uploads/";
    if(isset($_GET['download_all'])){
        //All selected articles
        foreach($selectedArticles as $selectedArticle){
            addFilesToZip($selectedArticle,$baseUploadPath,$filesToZip);
        }
        $zipFileName = "All selected_articles_" . date('Y-m-d') . ".zip";
    }
    elseif(isset($_GET['download_single'])){
        //single article download
        $articleId = (int)$_GET['download_single'];
        $article = null;

        //find the request article
        foreach($selectedArticles as $a){
            if($a['article_id'] == $articleId){
                $article = $a;
                break;
            }
        }
        if(!$article){
            die("Article not found or not selected");
        }
        addFilesToZip($article,$baseUploadPath,$filesToZip); // in this $article is from $article = $a 
        $zipFileName = "selected_articles_" . "(" . $a['title'] . ")" . date('Y-m-d') . ".zip";
    }
    $zipDir = $baseUploadPath . "zips/";
    if(!file_exists($zipDir)){
        mkdir($zipDir, 0777, true);
    }
    
    $zipFilePath = $zipDir . $zipFileName;

    //Create ZIP
    $zip = new ZipArchive();
    if($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE){
        die ("Failed to create ZIP file. Check directory permissions.");
    }

    //Add files to ZIP
    foreach($filesToZip as $file){
        if(file_exists($file['path'])){
            $zip->addFile($file['path'], $file['type'] . "s/" . basename($file['name']));
        }
    }
    $zip->close();

    // Download the file
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename=$zipFileName");
    header("Content-length: " . filesize($zipFilePath));
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile($zipFilePath);
    exit;
}
function addFilesToZip($selectedArticle,$basePath , &$filesArray){
    if(!empty($selectedArticle['docfile'])) {
        $filesArray[] = [
            'type' => 'document',
            'path' => $basePath . "documents/" . $selectedArticle['docfile'],
            'name' => $selectedArticle['docfile']
        ];
    }
    if(!empty($selectedArticle['imagefile'])) {
        $filesArray[] = [
            'type' => 'image',
            'path' => $basePath . "images/" . $selectedArticle['imagefile'],
            'name' => $selectedArticle['imagefile']
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Contributions</title>
    <meta name="description" content="View all selected university contributions">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            --accent: #facc15;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-muted: #64748b;
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        a{
            text-decoration: none;
        }
        .container {
            max-width: 1200px;
        }
        .section-title {
            color: var(--primary-dark);
            font-size: 1.5rem;
            font-weight: 600;
        }
        .card {
            background: var(--card-bg);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .table thead {
            background: var(--primary-dark);
            color: white;
        }
        .table th {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .table tbody tr {
            transition: background-color 0.2s ease-in-out;
        }
        .table tbody tr:hover {
            background-color: #f1f5f9;
        }
        .btn-download {
            background: var(--primary-light);
            border: none;
            color: #ffffff;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }
        .btn-download:hover {
            background: var(--primary-dark);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headermm.php"; ?>

    <!-- Main Content -->
    <main class="container py-5">
        <h2 class="section-title mb-4">All Selected Articles</h2>

        <!-- Download All button -->
        <?php if (!empty($selectedArticles) && strtotime(date('Y-m-d')) >= strtotime($finalclosuredate)): ?>
        <div class="mb-4 text-end">
            <a href="?download_all=1" class="btn btn-primary">
                <i class="fas fa-file-archive"></i> Download All Selected Articles
            </a>
        </div>
    <?php endif; ?>
        <!-- Contribution Table -->
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>Contribution Name</th>
                            <th>Student Name</th>
                            <th>Faculty</th>
                            <th>Marketing Coordinator</th>
                            <th>Final Closure Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($selectedArticles)): ?>
                            <?php foreach ($selectedArticles as $selectedArticle) : ?>
                                <tr class="text-center">
                                    <td><?=  $selectedArticle['title'] ?></td>
                                    <td><?= $selectedArticle['name'] ?></td>
                                    <td><?= $selectedArticle['faculty_name'] ?></td>
                                    <td><?= $selectedArticle['name'] ?></td>
                                    <td>Final Date</td>
                                    <td>
                                    <?php if (strtotime(date('Y-m-d')) < strtotime($finalclosuredate)): ?>
                                            <h1><?= $finalclosuredate ?></h1>
                                        <?php else : ?>
                                        <a href="?download_single=<?= $selectedArticle['article_id'] ?>" class="btn-download">
                                            <i class="fas fa-arrow-down"></i> Download
                                        </a>
                                        <?php endif ?>
                                    </td>
                                    
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <h1>No selected Articles</h1>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>
</html>
