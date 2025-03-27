<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Coordinator Contributions</title>
    <meta name="description" content="Contributions managed by Marketing Coordinator">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a; /* Dark blue */
            --primary-light: #3b82f6; /* Light blue */
            --accent: #facc15; /* Yellow */
            --light-bg: #f8fafc; /* Light gray */
            --card-bg: #ffffff;
            --text-muted: #64748b;
            --contributors-color: #2ecc71; /* Green for Total Contributors */
            --closure-date-color: #e74c3c; /* Red for Closure Date */
            --final-closure-color: #8e44ad; /* Purple for Final Closure Date */
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
        }
        .faculty-header {
            color: var(--primary-dark);
            font-size: 1.25rem;
            font-weight: 500;
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
        .search-input {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .search-input:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
            outline: none;
        }
        .detail-label {
            color: var(--text-muted);
            font-size: 0.875rem;
        }
        .detail-value-contributors {
            color: var(--contributors-color);
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }
        .detail-value-closure {
            color: var(--closure-date-color);
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }
        .detail-value-final-closure {
            color: var(--final-closure-color);
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }
        .btn-search {
            background-color: var(--primary-light);
            border: none;
            font-weight: 500;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-search:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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
        .faculty-icon {
            color: var(--primary-light);
            margin-right: 0.5rem;
        }
        .detail-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headermc.html"; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <div class="card">
            <!-- Faculty Header with Search -->
            <div class="p-4 border-bottom border-gray-200 d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="faculty-header d-flex align-items-center"><i class="fa-solid fa-microchip faculty-icon"></i>
                        Faculty of Information & Technology
                    </h2>
                    <div class="mt-2 text-sm text-muted">
                        <span>Marketing Coordinator - Mr Kelvin</span>
                    </div>
                    <div class="mt-2 text-sm text-muted">
                        <span>Total Students - 15</span>
                    </div>
                </div>
                <div class="mt-3 mt-md-0 col-md-6 d-flex align-items-end">
                    <input type="text" id="search" class="form-control search-input me-2" placeholder="Search contributions...">
                    <button class="btn-search px-4 py-2 rounded-pill shadow-sm d-flex align-items-center">
                        <i class="fas fa-search me-2"></i> Search
                    </button>
                </div>
            </div>

            <!-- Contribution Cards -->
            <div class="p-4">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 g-4">
                    <?php
                    $contributions = [
                        [
                            "id" => 1, 
                            "name" => "AI Innovations", 
                            "contributors" => 3, 
                            "closureDate" => "2025-03-15", 
                            "finalClosureDate" => "2025-04-01",
                            "contributorsList" => [
                                ["name" => "Kelvin", "role" => "Lead Researcher"],
                                ["name" => "Sophia", "role" => "Designer"],
                                ["name" => "Jane", "role" => "Writer"]
                            ]
                        ],
                        [
                            "id" => 2, 
                            "name" => "Data Trends", 
                            "contributors" => 2, 
                            "closureDate" => "2025-05-10", 
                            "finalClosureDate" => "2025-06-01",
                            "contributorsList" => [
                                ["name" => "Michale", "role" => "Analyst"],
                                ["name" => "Liam", "role" => "Editor"]
                            ]
                        ]
                    ];
                    foreach ($contributions as $contribution) {
                    ?>
                    <div class="col">
                        <div class="card p-4">
                            <h3 class="text-center text-lg font-medium text-gray-900"><?php echo $contribution['name']; ?></h3>
                            <div class="mt-4 space-y-3">
                                <div class="detail-row">
                                    <span class="detail-label">Total Contributors:</span>
                                    <span class="detail-value-contributors"><?php echo $contribution['contributors']; ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Closure Date:</span>
                                    <span class="detail-value-closure"><?php echo $contribution['closureDate']; ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Final Closure Date:</span>
                                    <span class="detail-value-final-closure"><?php echo $contribution['finalClosureDate']; ?></span>
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <a href="Contribution_Details.php" class="btn btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
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