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
                <div class="notification-item">
                    <p class="mb-0"><strong>New Submission:</strong> Kelvin submitted to AI Innovations on <?php echo date('Y-m-d'); ?>.</p>
                </div>
                <div class="notification-item">
                    <p class="mb-0"><strong>Comment Added:</strong> Sophia commented on a submission on <?php echo date('Y-m-d', strtotime('-1 day')); ?>.</p>
                </div>
                <div class="notification-item">
                    <p class="mb-0"><strong>Deadline Approaching:</strong> Closure date for Data Trends is in 2 days.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>