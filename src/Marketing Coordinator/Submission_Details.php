<?php
$contributions = [
    1 => [
        "name" => "AI Innovations",
        "submissions" => [
            1 => [
                "name" => "Kelvin",
                "uploadTime" => "2025-03-10 14:30",
                "images" => ["Images/test.jpg"],
                "pdf" => "Files/Test.pdf",
                "comments" => [
                    ["user" => "Mr. Kelvin", "text" => "Great work on the AI model!", "date" => "2025-03-11"],
                    ["user" => "Sophia", "text" => "Could use more diagrams.", "date" => "2025-03-12"]
                ]
            ],
            2 => [
                "name" => "Sophia",
                "uploadTime" => "2025-03-11 09:15",
                "images" => ["Images/test1.jpg", "Images/test2.jpg"],
                "pdf" => "Files/Test.pdf",
                "comments" => [
                    ["user" => "Jane", "text" => "Nice design layout!", "date" => "2025-03-12"]
                ]
            ],
            3 => [
                "name" => "Jane",
                "uploadTime" => "2025-03-12 16:45",
                "images" => ["Images/test2.jpg"],
                "pdf" => "Files/Test.pdf",
                "comments" => []
            ]
        ]
    ]
];
$contribution_id = isset($_GET['contribution_id']) ? (int)$_GET['contribution_id'] : 1;
$submission_id = isset($_GET['submission_id']) ? (int)$_GET['submission_id'] : 1;
$contribution = isset($contributions[$contribution_id]) ? $contributions[$contribution_id] : $contributions[1];
$submission = isset($contribution['submissions'][$submission_id]) ? $contribution['submissions'][$submission_id] : $contribution['submissions'][1];
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
        .comment-section {
            max-height: 300px;
            overflow-y: auto;
        }
        .comment-card {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .btn-submit-comment {
            background-color: var(--primary-light);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.2s ease;
        }
        .btn-submit-comment:hover {
            background-color: var(--primary-dark);
        }
        .btn-submit-comment i {
            font-size: 1rem;
        }
        .btn-selection {
            background-color: var(--primary-light);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }
        .btn-selection:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        .btn-selection i {
            font-size: 1rem;
        }
        .btn-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--primary-light);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .btn-notification:hover {
            background-color: var(--primary-dark);
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headermc.html"; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <div class="card p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4"><?php echo $contribution['name']; ?> - Submission Details</h3>

            <!-- Student Profile with Selection Button -->
            <div class="d-flex align-items-center mb-4">
                <div class="contributor-icon me-3"><?php echo substr($submission['name'], 0, 1); ?></div>
                <div>
                    <span class="font-medium text-gray-900"><?php echo $submission['name']; ?></span>
                    <div class="text-sm text-muted">Upload Time: <?php echo $submission['uploadTime']; ?></div>
                </div>
                <button class="btn-selection ms-auto">
                    <i class="fas fa-star"></i> Selection
                </button>
            </div>

            <!-- Image Section -->
            <div class="mb-4">
                <h4 class="text-md font-medium text-gray-900 mb-2">Images</h4>
                <div class="row g-3">
                    <?php foreach ($submission['images'] as $index => $image) { ?>
                    <div class="col-md-4">
                        <img 
                            src="<?php echo $image; ?>" 
                            alt="<?php echo $submission['name']; ?>'s image" 
                            class="submission-image" 
                            data-bs-toggle="modal" 
                            data-bs-target="#imageModal<?php echo $index; ?>">
                    </div>
                    <!-- Modal for Fullscreen Image -->
                    <div class="modal fade modal-fullscreen" id="imageModal<?php echo $index; ?>" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <img src="<?php echo $image; ?>" alt="<?php echo $submission['name']; ?>'s full image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <!-- PDF Link -->
            <div class="mb-4">
                <h4 class="text-md font-medium text-gray-900 mb-2">PDF Document</h4>
                <a href="<?php echo $submission['pdf']; ?>" target="_blank" class="pdf-link-btn">
                    <i class="fas fa-file-pdf"></i> View PDF File
                </a>
            </div>

            <!-- Comments Section -->
            <div class="mb-4">
                <h4 class="text-md font-medium text-gray-900 mb-2">Comments</h4>
                <div class="comment-section">
                    <?php if (empty($submission['comments'])) { ?>
                        <p class="text-muted">No comments yet.</p>
                    <?php } else { ?>
                        <?php foreach ($submission['comments'] as $comment) { ?>
                        <div class="comment-card">
                            <div class="d-flex justify-content-between">
                                <span class="font-medium text-gray-900"><?php echo $comment['user']; ?></span>
                                <span class="text-sm text-muted"><?php echo $comment['date']; ?></span>
                            </div>
                            <p class="text-sm text-gray-700 mt-1"><?php echo $comment['text']; ?></p>
                        </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <!-- Comment Form -->
                <form action="Submission_Details.php" class="mt-3">
                    <div class="mb-2">
                        <textarea class="form-control" rows="3" placeholder="Add a comment..." required></textarea>
                    </div>
                    <button type="submit" class="btn-submit-comment">
                        Post Comment <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <!-- Back Button -->
            <div class="mt-2">
                <a href="Contribution_Details.php" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-left p-2"></i>Back</a>
            </div>
        </div>
    </main>
    <!-- Notification Button -->
    <button class="btn-notification" data-bs-toggle="modal" data-bs-target="#notificationModal">
        <i class="fas fa-bell"></i>
    </button>

    <!-- Include Notification Modal -->
    <?php include "notification.php"; ?>
    
    <!-- Footer -->
    <?php include "footer.html"; ?>
</body>
</html>