<?php
include("../../../vendor/autoload.php");

use Libs\Database\ArticleTable;
use Libs\Database\MySQL;
// use Helpers\Auth;
// $auth = Auth::check();
// $faculty_id = $auth->faculty_id;
$table = new ArticleTable(new MySQL);
$notifications = $table->getCoordinatorNotifications($faculty_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .notification-modal .modal-content {
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .notification-item {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .notification-item:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <!-- Notification Modal -->
    <div class="modal fade notification-modal" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <?php if (!empty($notifications)) : ?>
                <?php foreach ($notifications as $notification) : ?>
                    <div class="notification-item">
                        <p class="mb-0">
                            <strong>New article submitted:</strong> 
                            <?= $notification['message'] ?> <?= $notification['deadline_date'] ?>.
                        </p>
                    </div>
                    <hr> <!-- Optional: Separate notifications -->
                <?php endforeach; ?>
            <?php else : ?>
                <div class="notification-item">
                    <p class="mb-0">No notifications</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

    </div>
</body>

</html>