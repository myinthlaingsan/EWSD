<?php
include("../../../vendor/autoload.php");

use Helpers\BrowserHelper;
use Libs\Database\MySQL;
use Libs\Database\ActivityLogsTable;
use Helpers\Auth;

$auth = Auth::check();
$userId = $auth->id ?? null; // Get logged-in user ID


// Create database connection
$activityLogTable = new ActivityLogsTable(new MySQL);
// Log the page visit
// $activityLogTable->logPageView(
//     $userId,
//     $_SERVER['REQUEST_URI'],
//     $_SERVER['HTTP_USER_AGENT'],
//     $_SERVER['REMOTE_ADDR']
// );

// Get reports
$mostViewedPages = $activityLogTable->getMostViewedPages();
$mostActiveUsers = $activityLogTable->getMostActiveUsers();
$mostUsedBrowsers = $activityLogTable->getMostUsedBrowsers();
$BrowserName = new BrowserHelper();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Reports</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
</head>
<body>
    
    <div class="container mt-5">
        <h2 class="text-center">System Usage Reports</h2>
        
        <div class="row mt-4">
            <!-- Most Viewed Pages -->
            <div class="col-md-4">
                <h4>Most Viewed Pages</h4>
                <ul class="list-group">
                    <?php foreach ($mostViewedPages as $page): ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($page->page_url) ?> 
                            <span class="badge bg-primary"><?= $page->total_views ?> views</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Most Active Users -->
            <div class="col-md-4">
                <h4>Most Active Users</h4>
                <ul class="list-group">
                    <?php foreach ($mostActiveUsers as $user): ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($user->name) ?> 
                            <span class="badge bg-success"><?= $user->total_activity ?> actions</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Most Used Browsers -->
            <div class="col-md-4">
                <h4>Most Used Browsers</h4>
                <ul class="list-group">
                    <?php foreach ($mostUsedBrowsers as $browser): 
                        $shortBrowserName = $BrowserName->getShortBrowserName($browser->browser);
                        ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($shortBrowserName) ?> 
                            <span class="badge bg-warning"><?= $browser->total_usage ?> users</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
