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
    <?php include "headeradm.html"; ?>

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
                            <?php
                            $pages = [
                                ["name" => "Dashboard", "url" => "/Admin/index.php", "views" => 1200],
                                ["name" => "Contributions", "url" => "/Admin/All_Contribution.php", "views" => 950],
                                ["name" => "Reports", "url" => "/Admin/All_Reports.php", "views" => 780],
                                ["name" => "Statistics", "url" => "/Admin/Statistics.php", "views" => 620],
                                ["name" => "Profile", "url" => "/profile.php", "views" => 450]
                            ];
                            foreach ($pages as $page) {
                                echo "<tr class='text-center'>";
                                echo "<td>{$page['name']}</td>";
                                echo "<td>{$page['url']}</td>";
                                echo "<td>{$page['views']}</td>";
                                echo "</tr>";
                            }
                            ?>
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
                            <?php
                            $users = [
                                ["username" => "admin_kelvin", "role" => "Admin", "activity" => 320],
                                ["username" => "coord_sophia", "role" => "Marketing Coordinator", "activity" => 280],
                                ["username" => "mgr_jane", "role" => "Marketing Manager", "activity" => 250],
                                ["username" => "user_michale", "role" => "Admin", "activity" => 190],
                                ["username" => "coord_emma", "role" => "Marketing Coordinator", "activity" => 150]
                            ];
                            foreach ($users as $user) {
                                echo "<tr class='text-center'>";
                                echo "<td>{$user['username']}</td>";
                                echo "<td>{$user['role']}</td>";
                                echo "<td>{$user['activity']}</td>";
                                echo "</tr>";
                            }
                            ?>
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
                            <?php
                            $browsers = [
                                ["browser" => "Chrome", "count" => 1800, "percentage" => 60],
                                ["browser" => "Firefox", "count" => 600, "percentage" => 20],
                                ["browser" => "Safari", "count" => 300, "percentage" => 10],
                                ["browser" => "Edge", "count" => 240, "percentage" => 8],
                                ["browser" => "Other", "count" => 60, "percentage" => 2]
                            ];
                            foreach ($browsers as $index => $browser) {
                                echo "<tr class='text-center'>";
                                echo "<td>{$browser['browser']}</td>";
                                echo "<td>{$browser['count']}</td>";
                                echo "<td><canvas id='browserChart{$index}' class='chart-container'></canvas></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include "footer.html"; ?>

    <!-- JavaScript for Pie Charts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <?php
            foreach ($browsers as $index => $browser) {
                $percentage = $browser['percentage'];
                $remaining = 100 - $percentage;
                echo "
                new Chart(document.getElementById('browserChart{$index}'), {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [{$percentage}, {$remaining}],
                            backgroundColor: ['var(--primary-light)', '#e5e7eb'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%', // Thin ring
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed + '%';
                                    }
                                }
                            }
                        },
                        animation: { animateScale: true }
                    }
                });
                ";
            }
            ?>
        });
    </script>
</body>
</html>