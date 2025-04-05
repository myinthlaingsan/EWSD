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

// Get reports
$mostViewedPages = $activityLogTable->getMostViewedPages();
$mostActiveUsers = $activityLogTable->getMostActiveUsers();
$browsers = $activityLogTable->getMostUsedBrowsers();

// Calculate total usage
$totalUsage = array_sum(array_column($browsers, 'total_usage'));

// Calculate percentages and prepare data for view
$mostUsedBrowsers = array_map(function($browser) use ($totalUsage) {
    $browser->percentage = $totalUsage > 0 ? round(($browser->total_usage / $totalUsage) * 100, 1) : 0;
    return $browser;
}, $browsers);
$BrowserName = new BrowserHelper();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Usage Reports</title>
    <meta name="description" content="Admin reports for system usage monitoring">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            padding: 0 15px;
        }

        .section-title {
            color: var(--primary-dark);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .card {
            background: var(--card-bg);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
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

        .table-icon {
            margin-right: 0.5rem;
            color: var(--text-muted);
        }

        .chart-container {
            position: relative;
            width: 80px;
            height: 80px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Main Content -->
    <main class="container py-5">
        <h1 class="text-center mb-4" style="color: var(--primary-dark); font-weight: 700;">System Usage Reports</h1>

        <!-- Most Viewed Pages -->
        <section class="mb-5">
            <h2 class="section-title"><i class="fas fa-eye table-icon"></i> Most Viewed Pages</h2>
            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th>Page Name</th>
                                <th>URL</th>
                                <th>View Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mostViewedPages as $page): ?>
                                <!-- <li class="list-group-item">
                                    <?= htmlspecialchars($page->page_url) ?>
                                    <span class="badge bg-primary"><?= $page->total_views ?> views</span>
                                </li> -->
                                <tr class="text-center">
                                    <td><?= $page->file_name ?></td>
                                    <td><?= $page->page_url ?></td>
                                    <td><?= $page->total_views ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Most Active Users -->
        <section class="mb-5">
            <h2 class="section-title"><i class="fas fa-users table-icon"></i> Most Active Users</h2>
            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Activity Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mostActiveUsers as $user): ?>
                                <tr class="text-center">
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->role_name ?></td>
                                    <td><?= $user->total_activity ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Browser Usage -->
        <section>
            <h2 class="section-title"><i class="fas fa-globe table-icon"></i> Browser Usage</h2>
            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-center">
                            <tr>
                                <th>Browser</th>
                                <th>Usage Count</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mostUsedBrowsers as $index => $browser):
                                $shortBrowserName = $BrowserName->getShortBrowserName($browser->browser);
                            ?>
                                <tr class="text-center">
                                    <td><?= htmlspecialchars($shortBrowserName) ?></td>
                                    <td><?= $browser->total_usage ?></td>
                                    <td><canvas id='browserChart<?= $index ?>' class='chart-container'></canvas></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include "footer.php"; ?>

    <!-- JavaScript for Pie Charts -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        <?php foreach ($mostUsedBrowsers as $index => $browser): ?>
            new Chart(document.getElementById('browserChart<?= $index ?>'), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [<?= $browser->percentage ?>, <?= 100 - $browser->percentage ?>],
                        backgroundColor: ['var(--primary-light)', '#e5e7eb'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed + '%';
                                }
                            }
                        }
                    }
                }
            });
        <?php endforeach; ?>
    });
</script>
</body>

</html>