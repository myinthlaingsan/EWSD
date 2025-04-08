<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ArticleTable;

$auth = Auth::check();
$faculty_id = $auth->faculty_id;
$user_id = $auth->id;
$table = new ArticleTable(new MySQL);
$article_id = $_GET['id'];
$details = $table->articlebyfacultydetail($article_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Details</title>
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

        .card {
            background: var(--card-bg);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .contributor-icon {
            width: 2.5rem;
            height: 2.5rem;
            background-color: #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .submission-image {
            width: 100%;
            height: 12rem;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .submission-image:hover {
            transform: scale(1.05);
        }

        .modal-fullscreen .modal-content {
            background-color: rgba(0, 0, 0, 0.9);
            border: none;
        }

        .modal-fullscreen img {
            max-width: 90%;
            max-height: 90vh;
            margin: auto;
            display: block;
        }

        .pdf-link-btn {
            background-color: var(--primary-light);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .pdf-link-btn:hover {
            background-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .pdf-link-btn i {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include "headermm.php"; ?>
    <!-- <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?> -->
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <div class="card p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4"><?php echo $details['faculty_name']; ?> - Submission Details</h3>

            <!-- Student Profile with Selection Button -->
            <div class="d-flex align-items-center mb-4">
                <div class="contributor-icon me-3"><?php echo substr($details['name'], 0, 1); ?></div>
                <div>
                    <span class="font-medium text-gray-900"><?php echo $details['name']; ?></span>
                    <div class="text-sm text-muted">Upload Time: <?php echo $details['created_at']; ?></div>
                </div>
                <form action="../code/updatestatus.php" method="post" class="ms-auto">
                    <input type="hidden" name="article_id" value="<?= $article_id ?>">
                    <?php if ($details['status'] == "selected") : ?>
                        <h3>Article has been selected</h3>
                    <?php else: ?>
                        <button class="btn-selection ms-auto"><i class="fas fa-star"></i> Selection</button>
                    <?php endif ?>
                </form>
            </div>

            <!-- Image Section -->
            <div class="mb-4">
                <h4 class="text-md font-medium text-gray-900 mb-2">Images</h4>
                <div class="row g-3">
                    <?php
                    if (!empty($details['images'])) {
                        $images = explode(',', $details['images']);
                        foreach ($images as $image) {
                            $image = trim($image);
                            if (!empty($image)) {
                    ?>
                                <div class="col-md-4">
                                    <img
                                        src="../../../uploads/images/<?php echo htmlspecialchars($image); ?>"
                                        alt="<?php echo htmlspecialchars($details['name']); ?>'s image"
                                        class="submission-image"
                                        data-bs-toggle="modal"
                                        data-bs-target="#imageModal<?php echo md5($image); ?>">

                                    <!-- Modal for Fullscreen Image -->
                                    <div class="modal fade modal-fullscreen" id="imageModal<?php echo md5($image); ?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    <img src="../../../uploads/images/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($details['name']); ?>'s full image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    } else {
                        echo '<p class="text-muted">No images available</p>';
                    }
                    ?>
                </div>
            </div>

            <!-- PDF Link -->
            <div class="mb-4">
                <h4 class="text-md font-medium text-gray-900 mb-2">Document Files</h4>
                <?php
                if (!empty($details['documents'])) {
                    $documents = explode(',', $details['documents']);
                    foreach ($documents as $doc) {
                        $doc = trim($doc);
                        if (!empty($doc)) {
                ?>
                            <div class="mb-2">
                                <a href="../../../uploads/documents/<?php echo htmlspecialchars($doc); ?>" target="_blank" class="pdf-link-btn">
                                    <i class="fas fa-file-pdf"></i> <?php echo htmlspecialchars($doc); ?>
                                </a>
                            </div>
                <?php
                        }
                    }
                } else {
                    echo '<p class="text-muted">No documents available</p>';
                }
                ?>
            </div>

            <!-- Action Buttons -->
            <div class="mt-2 d-flex gap-2">
                <a href="index.php" class="btn btn-outline-primary">
                    <i class="fa-solid fa-arrow-left p-2"></i> Back
                </a>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>