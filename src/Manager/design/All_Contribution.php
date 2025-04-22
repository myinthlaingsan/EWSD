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

// Check if download was requested
if (isset($_GET['download_all']) || isset($_GET['download_single'])) {
    handleDownload($table, $articleTable, $user_id);
}

// Get data for display
$userRole = $table->getUserRoleName($user_id);
$finalClosureDate = $table->selectFinalClosureDate();
$currentDate = date('Y-m-d');
$selectedArticles = $articleTable->getAllSelectedArticles();

function handleDownload($table, $articleTable, $user_id)
{
    $userRole = $table->getUserRoleName($user_id);
    if ($userRole != 'Manager') {
        HTTP::redirect("/article/selected_articles.php", "error=unauthorized");
    }

    // Get selected articles
    $selectedArticles = $articleTable->getAllSelectedArticles();
    if (empty($selectedArticles)) {
        HTTP::redirect("/article/selected_articles.php", "error=no_articles");
    }

    $baseUploadPath = realpath(__DIR__ . "/../../../uploads/") . DIRECTORY_SEPARATOR;
    $zipDir = $baseUploadPath . "zips" . DIRECTORY_SEPARATOR;

    if (!file_exists($zipDir)) {
        mkdir($zipDir, 0755, true);
    }

    if (isset($_GET['download_all'])) {
        // Create parent zip containing all articles
        $parentZipFileName = "All_Selected_Articles_" . date('Y-m-d') . ".zip";
        $parentZipFilePath = $zipDir . $parentZipFileName;

        $parentZip = new ZipArchive();
        if ($parentZip->open($parentZipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            HTTP::redirect("/article/selected_articles.php", "error=zip_failed");
        }

        foreach ($selectedArticles as $article) {
            $filesToZip = [];
            addFilesToZip($article, $baseUploadPath, $filesToZip);

            if (!empty($filesToZip)) {
                // Create folder for each article in the parent zip
                $articleFolder = "Article_" . $article['article_id'] . "_" . preg_replace('/[^a-zA-Z0-9]/', '_', $article['title']) . "/";

                foreach ($filesToZip as $file) {
                    if (file_exists($file['path'])) {
                        $parentZip->addFile(
                            $file['path'],
                            $articleFolder . $file['type'] . "s/" . basename($file['path'])
                        );
                    }
                }
            }
        }

        if ($parentZip->numFiles == 0) {
            $parentZip->close();
            unlink($parentZipFilePath);
            HTTP::redirect("/article/selected_articles.php", "error=no_files");
        }

        $parentZip->close();

        // Download the file
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=" . basename($parentZipFileName));
        header("Content-length: " . filesize($parentZipFilePath));
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile($parentZipFilePath);

        // Clean up
        unlink($parentZipFilePath);
        exit;
    } elseif (isset($_GET['download_single'])) {
        // Single article download
        $articleId = (int)$_GET['download_single'];
        if ($articleId <= 0) {
            HTTP::redirect("/article/selected_articles.php", "error=invalid_id");
        }

        $article = null;
        foreach ($selectedArticles as $a) {
            if ($a['article_id'] == $articleId) {
                $article = $a;
                break;
            }
        }

        if (!$article) {
            HTTP::redirect("/article/selected_articles.php", "error=article_not_found");
        }

        $filesToZip = [];
        addFilesToZip($article, $baseUploadPath, $filesToZip);

        if (empty($filesToZip)) {
            HTTP::redirect("/article/selected_articles.php", "error=no_files");
        }

        $zipFileName = "Selected_Article_" . $article['article_id'] . "_" .
            preg_replace('/[^a-zA-Z0-9]/', '_', $article['title']) . "_" .
            date('Y-m-d') . ".zip";
        $zipFilePath = $zipDir . $zipFileName;

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            HTTP::redirect("/article/selected_articles.php", "error=zip_failed");
        }

        foreach ($filesToZip as $file) {
            if (file_exists($file['path'])) {
                $zip->addFile($file['path'], $file['type'] . "s/" . basename($file['path']));
            }
        }

        $zip->close();

        // Download the file
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=" . basename($zipFileName));
        header("Content-length: " . filesize($zipFilePath));
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile($zipFilePath);

        // Clean up
        unlink($zipFilePath);
        exit;
    }
}

function addFilesToZip($article, $basePath, &$filesArray)
{
    // Handle multiple documents
    if (!empty($article['docfiles'])) {
        $docFiles = explode('|||', $article['docfiles']);
        foreach ($docFiles as $docFile) {
            if (!empty($docFile)) {
                $filePath = $basePath . "documents" . DIRECTORY_SEPARATOR . $docFile;
                if (file_exists($filePath)) {
                    $filesArray[] = [
                        'type' => 'document',
                        'path' => $filePath,
                        'name' => $docFile
                    ];
                }
            }
        }
    }

    // Handle multiple images
    if (!empty($article['imagefiles'])) {
        $imageFiles = explode('|||', $article['imagefiles']);
        foreach ($imageFiles as $imageFile) {
            if (!empty($imageFile)) {
                $filePath = $basePath . "images" . DIRECTORY_SEPARATOR . $imageFile;
                if (file_exists($filePath)) {
                    $filesArray[] = [
                        'type' => 'image',
                        'path' => $filePath,
                        'name' => $imageFile
                    ];
                }
            }
        }
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

        a {
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
            text-decoration: none;
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title">All Selected Articles</h2>
            <?php if (!empty($selectedArticles) && strtotime($currentDate) >= strtotime($finalClosureDate)): ?>
                <a href="?download_all=1" class="btn-download">
                    <i class="fas fa-arrow-down me-1"></i> Download All Selected Articles
                </a>
            <?php endif; ?>
        </div>

        <!-- Error message display -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php
                $errors = [
                    'unauthorized' => 'You are not authorized to download files.',
                    'no_articles' => 'No selected articles found.',
                    'zip_failed' => 'Failed to create ZIP file.',
                    'no_files' => 'No files found to download.',
                    'invalid_id' => 'Invalid article ID.',
                    'article_not_found' => 'Article not found.'
                ];
                echo $errors[$_GET['error']] ?? 'An error occurred.';
                ?>
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
                            <?php foreach ($selectedArticles as $article) : ?>
                                <tr class="text-center">
                                    <td><?= htmlspecialchars($article['title']) ?></td>
                                    <td><?= htmlspecialchars($article['name']) ?></td>
                                    <td><?= htmlspecialchars($article['faculty_name']) ?></td>
                                    <td><?= htmlspecialchars($article['name']) ?></td>
                                    <td><?= htmlspecialchars($finalClosureDate) ?></td>
                                    <td>
                                        <?php if (strtotime($currentDate) >= strtotime($finalClosureDate)): ?>
                                            <a href="?download_single=<?= $article['article_id'] ?>" class="btn-download">
                                                Download
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">Available after <?= $finalClosureDate ?></span>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">No selected articles found</td>
                            </tr>
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