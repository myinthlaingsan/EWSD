<?php
include('../../../vendor/autoload.php');
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ReportGenerator;

$auth = Auth::check();
$table = new ReportGenerator(new MySQL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribution Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #64748b;
            --light-bg: #f8fafc;
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .report-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .report-card:hover {
            transform: translateY(-5px);
        }
        .report-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
        }
        .percentage-bar {
            height: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
        }
        .percentage-fill {
            height: 100%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }
        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
        }
        .nav-pills .nav-link {
            color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <div class="container py-4">
        <h2 class="mb-4 text-center">Contribution Reports</h2>
        
        <!-- Report Navigation -->
        <ul class="nav nav-pills mb-4 justify-content-center" id="reportTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="contributions-tab" data-bs-toggle="pill" data-bs-target="#contributions" type="button" role="tab">
                    <i class="fas fa-chart-bar me-2"></i>Contributions by Faculty
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="percentage-tab" data-bs-toggle="pill" data-bs-target="#percentage" type="button" role="tab">
                    <i class="fas fa-percentage me-2"></i>Contribution Percentage
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contributors-tab" data-bs-toggle="pill" data-bs-target="#contributors" type="button" role="tab">
                    <i class="fas fa-users me-2"></i>Contributors by Faculty
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="no-comments-tab" data-bs-toggle="pill" data-bs-target="#no-comments" type="button" role="tab">
                    <i class="fas fa-comment-slash me-2"></i>No Comments
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="late-comments-tab" data-bs-toggle="pill" data-bs-target="#late-comments" type="button" role="tab">
                    <i class="fas fa-clock me-2"></i>Overdue Comments
                </button>
            </li>
        </ul>

        <!-- Report Content -->
        <div class="tab-content" id="reportTabsContent">
            <!-- Contributions by Faculty -->
            <div class="tab-pane fade show active" id="contributions" role="tabpanel">
                <div class="card report-card mb-4">
                    <div class="card-header report-header">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Number of Contributions by Faculty</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Academic Year</th>
                                        <th>Faculty</th>
                                        <th>Contributions</th>
                                        <th>Visual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contributionsByFaculty = $table->getContributionsByFacultyAndYear();
                                    foreach ($contributionsByFaculty as $report): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($report['academicyear']) ?></td>
                                        <td><?= htmlspecialchars($report['faculty_name']) ?></td>
                                        <td><?= htmlspecialchars($report['contribution_count']) ?></td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" 
                                                     style="width: <?= min($report['contribution_count'] * 5, 100) ?>%" 
                                                     aria-valuenow="<?= $report['contribution_count'] ?>" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="20">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Percentage by Faculty -->
            <div class="tab-pane fade" id="percentage" role="tabpanel">
                <div class="card report-card mb-4">
                    <div class="card-header report-header">
                        <h5 class="mb-0"><i class="fas fa-percentage me-2"></i>Percentage of Contributions by Faculty</h5>
                    </div>
                    <div class="card-body">
                        <form class="mb-4 row g-3">
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Faculty</th>
                                        <th>Contributions</th>
                                        <th>Percentage</th>
                                        <th>Visual</th>
                                    </tr>
                                </thead>
                                <tbody id="percentageReportBody">
                                    <?php
                                    $percentageByFaculty = $table->getContributionPercentageByFaculty('2025');
                                    foreach ($percentageByFaculty as $report): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($report['faculty_name']) ?></td>
                                        <td><?= htmlspecialchars($report['contribution_count']) ?></td>
                                        <td><?= htmlspecialchars($report['percentage']) ?>%</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="percentage-fill" style="width: <?= $report['percentage'] ?>%">
                                                    <?= $report['percentage'] ?>%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contributors by Faculty -->
            <div class="tab-pane fade" id="contributors" role="tabpanel">
                <div class="card report-card mb-4">
                    <div class="card-header report-header">
                        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Number of Contributors by Faculty</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Academic Year</th>
                                        <th>Faculty</th>
                                        <th>Contributors</th>
                                        <th>Visual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contributorsByFaculty = $table->getContributorsByFacultyAndYear();
                                    foreach ($contributorsByFaculty as $report): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($report['academicyear']) ?></td>
                                        <td><?= htmlspecialchars($report['faculty_name']) ?></td>
                                        <td><?= htmlspecialchars($report['contributor_count']) ?></td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" role="progressbar" 
                                                     style="width: <?= min($report['contributor_count'] * 10, 100) ?>%" 
                                                     aria-valuenow="<?= $report['contributor_count'] ?>" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="10">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Articles without comments -->
            <div class="tab-pane fade" id="no-comments" role="tabpanel">
                <div class="card report-card mb-4">
                    <div class="card-header report-header">
                        <h5 class="mb-0"><i class="fas fa-comment-slash me-2"></i>Contributions Without Comments</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Faculty</th>
                                        <th>Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $articlesWithoutComments = $table->getArticlesWithoutComments();
                                    foreach ($articlesWithoutComments as $article): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($article['title']) ?></td>
                                        <td><?= htmlspecialchars($article['author']) ?></td>
                                        <td><?= htmlspecialchars($article['faculty_name']) ?></td>
                                        <td><?= date('M j, Y', strtotime($article['created_at'])) ?></td>
                                        <td>
                                            <a href="viewdetail.php?id=<?= $article['article_id'] ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>View
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Articles without comments after 14 days -->
            <div class="tab-pane fade" id="late-comments" role="tabpanel">
                <div class="card report-card mb-4">
                    <div class="card-header report-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Contributions Without Comments After 14 Days</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Faculty</th>
                                        <th>Days Overdue</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $lateArticles = $table->getArticlesWithoutCommentsAfterDeadline();
                                    foreach ($lateArticles as $article): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($article['title']) ?></td>
                                        <td><?= htmlspecialchars($article['author']) ?></td>
                                        <td><?= htmlspecialchars($article['faculty_name']) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $article['days_without_comment'] > 21 ? 'danger' : 'warning' ?>">
                                                <?= htmlspecialchars($article['days_without_comment']) ?> days
                                            </span>
                                        </td>
                                        <td>
                                            <a href="viewdetail.php?id=<?= $article['article_id'] ?>" class="btn btn-sm btn-outline-primary me-2">
                                                <i class="fas fa-eye me-1"></i>View
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-bell me-1"></i>Remind
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // AJAX for percentage report generation
        document.getElementById('generatePercentageReport').addEventListener('click', function() {
            const year = document.getElementById('academicYearSelect').value;
            
            fetch(`get_percentage_report.php?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    let html = '';
                    data.forEach(report => {
                        html += `
                            <tr>
                                <td>${report.faculty_name}</td>
                                <td>${report.contribution_count}</td>
                                <td>${report.percentage}%</td>
                                <td>
                                    <div class="percentage-bar">
                                        <div class="percentage-fill" style="width: ${report.percentage}%">
                                            ${report.percentage}%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                    document.getElementById('percentageReportBody').innerHTML = html;
                });
        });

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // You can add Chart.js initialization here for visual charts
        });
    </script>
</body>
</html>