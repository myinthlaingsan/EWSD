<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'ewsd';
$port = '3306';

$con = new mysqli($host, $username, $password, $db, $port);
if ($con->connect_errno) {
    echo "Connection Failed";
}

// Total Student
//Total number of students in the entire university

$total_students_q = "SELECT COUNT(users.id) AS total_students
                    FROM users
                    JOIN role_user ON users.id = role_user.user_id
                    WHERE role_user.role_id = 2;";
$total_students_res = $con->query($total_students_q);
$total_students_count = $total_students_res->fetch_assoc()['total_students'];
// echo "Total Students = ",$total_students_count;

// Total Contribution
$total_articles_q = "SELECT COUNT(*) AS total_articles
                     FROM articles a
                     JOIN users u ON a.user_id = u.id
                     JOIN faculties f ON u.faculty_id = f.id";
$total_articles_res = $con->query($total_articles_q);
$total_articles_count = $total_articles_res->fetch_assoc()['total_articles'];
// echo "Total Articles = ",$total_articles_count;

// Total Faculty
$total_faculties_q = "SELECT COUNT(*) AS total_faculties
                    FROM faculties;";
$total_faculties_res = $con->query($total_faculties_q);
$total_faculties_count = $total_faculties_res->fetch_assoc()['total_faculties'];
// echo "Total Faculties in Riverstone University = ", $total_faculties_count;

// Total Marketing Coordinator
$total_managers_q = "SELECT COUNT(users.id) AS total_managers
                    FROM users
                    JOIN role_user ON users.id = role_user.user_id
                    WHERE role_user.role_id = 3;";
$total_managers_res = $con->query($total_managers_q);
$total_managers_count = $total_managers_res->fetch_assoc()['total_managers'];
// echo "Total Managers = ", $total_managers_count;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Annual Magazine</title>
    <meta name="description" content="Manage university closure dates and track student contributions">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            --secondary: #64748b;
            --accent: #facc15;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        }

        .text-primary-custom {
            color: var(--primary-dark);
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            background: var(--card-bg);
            padding: 1.5rem;
            border-left: 4px solid var(--primary-light);
        }

        .main-content {
            position: relative;
            z-index: 900;
        }

        .welcome-section {
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background: var(--primary-light);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
            /* Remove underline */
        }

        .btn-custom:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            /* Ensure no underline on hover */
        }

        .btn-custom:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .deadline-date {
            color: #dc3545;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <!-- header -->
    <?php include "headeradm.html"; ?>

    <!-- Main Content Wrapper -->
    <div class="main-content">
        <!-- Welcome Section -->
        <div class="container my-5 welcome-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="text-primary-custom">Welcome Admin Name</h2>
                    <h1 class="text-primary-custom">Contribution Management</h1>
                </div>
                <a href="ContributionEntry.php" class="btn-custom">Add New Contribution</a>
            </div>

            <!-- Last Contribution Card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="card-title text-center text-primary-custom mb-3">The Last Contribution Name</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <p><i class="fas fa-calendar me-2"></i> Last Deadline Date: <span class="deadline-date">20.2.2025</span></p>
                            <p><i class="fas fa-university me-2"></i> Faculty: Arts</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-users me-2"></i> Contribution Total Upload: 12 Students</p>
                            <p><i class="fas fa-user-tie me-2"></i> Faculty Marketing Coordinator: Mr Kelvin</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="card stat-card shadow">
                        <div class="card-body">
                            <h3 class="text-primary-custom"><i class="fas fa-file-alt me-2"></i> Total Contribution</h3>
                            <p class="fs-2 fw-bold text-secondary"><?php echo $total_articles_count; ; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow">
                        <div class="card-body">
                            <h3 class="text-primary-custom"><i class="fas fa-user-graduate me-2"></i> Total Student</h3>
                            <p class="fs-2 fw-bold text-secondary"><?php echo $total_students_count; ; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card shadow">
                        <div class="card-body">
                            <h3 class="text-primary-custom"><i class="fas fa-building me-2"></i> Total Faculty</h3>
                            <p class="fs-2 fw-bold text-secondary"><?php echo $total_faculties_count; ; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Delete or Stay -->
                <div class="col-md-3">
                    <div class="card stat-card shadow">
                        <div class="card-body">
                            <h3 class="text-primary-custom"><i class="fas fa-user-tie me-2"></i> Total Marketing Coordinator</h3>
                            <p class="fs-2 fw-bold text-secondary"><?php echo $total_managers_count; ; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.html"; ?>

</body>

</html>