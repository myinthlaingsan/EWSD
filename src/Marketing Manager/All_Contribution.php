<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Contributions</title>
    <meta name="description" content="View all selected university contributions">
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
        .section-title {
            color: var(--primary-dark);
            font-size: 1.5rem;
            font-weight: 600;
        }
        .card {
            background: var(--card-bg);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
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
        .btn-download {
            background: var(--primary-light);
            border: none;
            color: #ffffff;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }
        .btn-download:hover {
            background: var(--primary-dark);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headermm.html"; ?>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title">All Selected Articles</h2>
            <button class="btn-download"><i class="fas fa-arrow-down me-1"></i> Download All Articles</button>
        </div>
        
        <!-- Article Table -->
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>Article Name</th>
                            <th>Student Name</th>
                            <th>Faculty</th>
                            <th>Marketing Coordinator</th>
                            <th>Final Closure Date</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contributions = [
                            ["name" => "AI Innovations", "student" => "Kelvin", "faculty" => "Information Technology", "coordinator" => "Mickey", "closureDate" => "2025-04-01"],
                            ["name" => "Bridge Design", "student" => "Sophia", "faculty" => "Engineering", "coordinator" => "Alex", "closureDate" => "2025-06-01"],
                            ["name" => "Market Trends", "student" => "Jane", "faculty" => "Business", "coordinator" => "Emma", "closureDate" => "2025-08-15"],
                            ["name" => "Cultural Study", "student" => "Michale", "faculty" => "Arts & Humanities", "coordinator" => "Liam", "closureDate" => "2025-10-01"]
                        ];
                        foreach ($contributions as $index => $contribution) {
                            echo "<tr class='text-center'>";
                            echo "<td>{$contribution['name']}</td>";
                            echo "<td>{$contribution['student']}</td>";
                            echo "<td>{$contribution['faculty']}</td>";
                            echo "<td>{$contribution['coordinator']}</td>";
                            echo "<td>{$contribution['closureDate']}</td>";
                            echo "<td><button class='btn-download' data-index='{$index}'><i class='fas fa-arrow-down me-1'></i> Download</button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include "footer.html"; ?>
</body>
</html>