<?php
include("../../../vendor/autoload.php");
use Helpers\Auth;
use Libs\Database\ArticleTable;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$auth = Auth::check();
$user_id = $auth->id;
$table = new UsersTable(new MySQL);
$articleTable = new ArticleTable(new MySQL);

$userRole = $table->getUserRoleName($user_id);
if($userRole != 'Manager'){
    die("You are not authorized to download this file.");
    // die("$auth->id");
}

//check final closure date
$finalclosuredate = $table->selectFinalClosureDate();
// if (strtotime($finalclosuredate) > time()) {
//     die("Download is not allowed before the final closure date.");
// }

// Fetch selected contributions
$selectedArticles = $articleTable->getSelectedArticles();
// if (empty($contributions)) {
//     die("No selected contributions found.");
// }

//create ZIp Archive
$zip = new ZipArchive();
$zipFileName = "selected_contributions.zip";
$zipFilePath = __DIR__ . "/upload/" . $zipFileName;

// if($zip->open($zipFilePath,ZipArchive::CREATE) === TRUE) {
//     foreach ($selectedArticles as $selectedArticle){
//         // add document file
//         if(!empty($selectedArticle['docfile'])){
//             $docPath = __DIR__ . "/uploads/documents/" . $selectedArticle['docfile'];
//             if(file_exists($docPath)){
//                 $zip->addFile($docPath,"documents/" . $selectedArticle['docfile']);
//             }
//         }

//         //add image file
//         if(!empty($selectedArticle['imagefile'])){
//             $imgPath = __DIR__ . "/uploads/images/" . $selectedArticle['imagefile'];
//             if(file_exists($imgPath)){
//                 $zip->addFile($imgPath, "images/" . $selectedArticle['imagefile']);
//             }
//         }
//     }
//     $zip->close();
// }else{
//     die("failed to create ZIP file.");
// }
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
        <h2 class="section-title mb-4">All Selected Contributions</h2>
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
                                    <td></td>
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
