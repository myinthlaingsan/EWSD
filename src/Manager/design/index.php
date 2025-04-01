<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "ewsd";
$port = "3306";

$con = new mysqli($host, $username, $password, $db, $port);
if ($con->connect_errno) {
    echo "Connection Failed";
}

// Faculty Contribution Percentage Query
$fac_cont_perc_q = "SELECT
                        f.faculty_name,
                        (COUNT(a.article_id) * 100.0 / (SELECT COUNT(*) FROM articles WHERE YEAR(created_at) = 2025)) AS contribution_percentage
                    FROM articles a
                    JOIN users u ON a.user_id = u.id
                    JOIN faculties f ON u.faculty_id = f.id
                    WHERE YEAR(a.created_at) = 2025
                    GROUP BY f.faculty_name;";

$fac_cont_perc_res = $con->query($fac_cont_perc_q);

// Prepare data points for faculty contribution chart
$fac_dataPoints = [];
while ($row = $fac_cont_perc_res->fetch_assoc()) {
    $fac_dataPoints[] = array("label" => $row['faculty_name'], "y" => (float)$row['contribution_percentage']);
}

echo "<script>console.log('Faculty Data:', " . json_encode($fac_dataPoints, JSON_NUMERIC_CHECK) . ");</script>";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script><!-- Chart Display -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a;
            /* Dark blue */
            --primary-light: #3b82f6;
            /* Light blue */
            --accent: #facc15;
            /* Yellow */
            --light-bg: #f8fafc;
            /* Light gray */
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

        .header-title {
            color: var(--primary-dark);
            font-size: 2rem;
            font-weight: 700;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .btn-download {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            border: none;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-download:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-download:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        .stat-value {
            color: var(--primary-light);
            font-weight: 700;
            font-size: 1.5rem;
        }

        .table th {
            background-color: var(--primary-dark);
            color: #ffffff;
        }

        .table td {
            color: var(--text-muted);
        }

        /* Pie Chart */
        .chart-containers {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .chart-container {
            flex: 1 1 45%;
            /* Allow two charts per row on large screens */
            max-width: 600px;
            /* Prevent excessive stretching */
            min-width: 300px;
            /* Prevent charts from getting too small */
            height: 400px;
            /* Set a fixed height */
        }

        @media (max-width: 768px) {
            .chart-container {
                flex: 1 1 100%;
            }
        }

        .canvasjs-chart-credit {
            display: none !important;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include "headermm.php"; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <h1 class="header-title mb-5 d-flex align-items-center">
            <i class="fas fa-briefcase me-3 text-primary-light"></i> Welcome!!!!<br> Marketing Manager Name
        </h1>

        <!-- Selected Contributions Overview -->
        <section class="mb-5">
            <div class="card p-4">
                <h2 class="fs-4 fw-bold text-primary-dark mb-4">Last 3 Selected Contributions</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Faculty</th>
                                <th>Student</th>
                                <th>Final Closure Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contributions = [
                                ["id" => 1, "title" => "AI Innovations", "faculty" => "Information Technology", "student" => "Kelvin", "final" => "2025-04-01"],
                                ["id" => 2, "title" => "Bridge Design", "faculty" => "Engineering", "student" => "Sophia", "final" => "2025-06-01"],
                                ["id" => 3, "title" => "Market Trends", "faculty" => "Business", "student" => "Jane", "final" => "2025-08-15"]
                            ];
                            foreach ($contributions as $contribution) {
                                echo "<tr>";
                                echo "<td>{$contribution['id']}</td>";
                                echo "<td>{$contribution['title']}</td>";
                                echo "<td>{$contribution['faculty']}</td>";
                                echo "<td>{$contribution['student']}</td>";
                                echo "<td>{$contribution['final']}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Statistics -->
        <section class="mb-5">
            <div class="card p-4">
                <h2 class="fs-4 fw-bold text-primary-dark mb-4">Statistics (2025 Academic Year)</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <p>Total Contributions: <span class="stat-value">45</span></p>
                    </div>
                    <div class="col-md-4">
                        <p>Total Contributors: <span class="stat-value">30</span></p>
                    </div>
                    <div class="col-md-4">
                        <p>Faculties Represented: <span class="stat-value">8</span></p>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Faculty</th>
                                <th>Contributions</th>
                                <th>Percentage</th>
                                <th>Contributors</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $facultyStats = [
                                ["faculty" => "Information Technology", "contributions" => 12, "percentage" => 26.7, "contributors" => 8],
                                ["faculty" => "Engineering", "contributions" => 10, "percentage" => 22.2, "contributors" => 7],
                                ["faculty" => "Business", "contributions" => 8, "percentage" => 17.8, "contributors" => 5],
                                ["faculty" => "Arts & Humanities", "contributions" => 6, "percentage" => 13.3, "contributors" => 4]
                            ];
                            foreach ($facultyStats as $stats) {
                                echo "<tr>";
                                echo "<td>{$stats['faculty']}</td>";
                                echo "<td>{$stats['contributions']}</td>";
                                echo "<td>{$stats['percentage']}%</td>";
                                echo "<td>{$stats['contributors']}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pie Chart Contribution by each facuty  -->
                <div class="chart-containers">
                    <div id="facultyChartContainer" class="chart-container"></div>
                    
                </div>

                <script>
                    window.onload = function() {
                        var facultyChart = new CanvasJS.Chart("facultyChartContainer", {
                            animationEnabled: true,
                            title: {
                                text: "Faculty Article Contribution (2025)"
                            },
                            data: [{
                                type: "pie",
                                showInLegend: true,
                                legendText: "{label}",
                                indexLabel: "{label} - #percent%",
                                yValueFormatString: "#,##0.##%",
                                dataPoints: <?php echo json_encode($fac_dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });

                        facultyChart.render();
                    };
                </script>
            </div>
        </section>

        <!-- Exception Reports -->
        <section class="mb-5">
            <div class="card p-4">
                <h2 class="fs-4 fw-bold text-primary-dark mb-4">Exception Reports</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Faculty</th>
                                <th>Student</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $exceptionReports = [
                                ["id" => 1, "title" => "Photo Essay", "faculty" => "Arts & Humanities", "student" => "Michale", "description" => "No Comments"],
                                ["id" => 2, "title" => "Data Analysis", "faculty" => "Information Technology", "student" => "Jane", "description" => "Without a Comments after 14 days"],
                                ["id" => 3, "title" => "Bridge Safety", "faculty" => "Engineering", "student" => "Sophia", "description" => "No Comments"]
                            ];
                            foreach ($exceptionReports as $report) {
                                echo "<tr>";
                                echo "<td>{$report['id']}</td>";
                                echo "<td>{$report['title']}</td>";
                                echo "<td>{$report['faculty']}</td>";
                                echo "<td>{$report['student']}</td>";
                                echo "<td>{$report['description']}</td>";
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
    <?php include "footer.php"; ?>

    
</body>

</html>