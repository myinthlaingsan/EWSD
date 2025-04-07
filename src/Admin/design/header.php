<?php
include('../../../vendor/autoload.php');

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\ActivityLogsTable;

if (!isset($auth)) {
    $auth = Auth::check();
}
$user_id = $auth->id ?? null;
$activityLogTable = new ActivityLogsTable(new MySQL);
// Extract file name from the request URI
$requestUri = $_SERVER['REQUEST_URI'];
$fileName = basename($requestUri);

// Log the page visit
$activityLogTable->logPageView(
    $user_id,
    $_SERVER['REQUEST_URI'],
    $_SERVER['HTTP_USER_AGENT'],
    $_SERVER['REMOTE_ADDR'],
    $fileName
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Header</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <script src="../../../js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            --accent: #facc15;
            --light-bg: #f8fafc;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        }

        .navbar {
            padding: 1rem;
            position: relative;
        }

        .nav-link:hover {
            color: var(--accent) !important;
        }

        /* Sidebar for Mobile */
        @media (max-width: 991px) {
            .sidebar {
                position: fixed;
                top: 0;
                right: -100%;
                width: 75%;
                height: 100vh;
                background: var(--primary-dark);
                padding: 4rem 2rem;
                transition: right 0.4s ease-in-out;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
                z-index: 1100;
            }

            .sidebar.show {
                right: 0;
            }

            .sidebar .close-btn {
                position: absolute;
                top: 1rem;
                right: 1.5rem;
                font-size: 1.5rem;
                color: white;
                cursor: pointer;
            }

            .backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                visibility: hidden;
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
                z-index: 1099;
            }

            .backdrop.show {
                visibility: visible;
                opacity: 1;
            }
        }

        /* Keep default navbar for Desktop */
        @media (min-width: 992px) {

            .sidebar,
            .backdrop,
            .navbar-toggler {
                display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark gradient-bg shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white" href="index.php"><i class="fas fa-university"></i> Riverstone University</a>
            <button class="navbar-toggler" id="menuToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="desktopNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="./index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./role.php"><i class="fas fa-calendar-alt"></i> Create Role</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./permissions.php"><i class="fas fa-calendar-alt"></i> Create Permission</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./faculty.php"><i class="fas fa-building"></i> Add Faculties</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../../statistics/piechart.php"><i class="fas fa-chart-bar"></i> View Statistics</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="Reports.php"><i class="fa-solid fa-flag"></i> Reports</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../../Auth/code/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./setting.php"><i class="fa-solid fa-gear"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar" id="sidebarMenu">
        <span class="close-btn" id="closeMenu">&times;</span>
        <ul class="navbar-nav text-white mt-4">
            <li class="nav-item"><a class="nav-link text-white" href="./index.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="./role.php"><i class="fas fa-calendar-alt"></i> Create Role</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="./permissions.php"><i class="fas fa-calendar-alt"></i> Create Permission</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="./faculty.php"><i class="fas fa-building"></i>Add Faculties</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="../../statistics/piechart.php"><i class="fas fa-chart-bar"></i> View Statistics</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="Reports.php"><i class="fa-solid fa-flag"></i> Reports</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="../../Auth/code/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="./setting.php"><i class="fa-solid fa-gear"></i></a></li>
        </ul>
    </div>
    <div class="backdrop" id="backdrop"></div>
    <?php if (isset($_SESSION['login_message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['login_message'] ?>
        </div>
        <?php unset($_SESSION['login_message']); ?>
    <?php endif; ?>
    <script>
        document.getElementById("menuToggle").addEventListener("click", function() {
            document.getElementById("sidebarMenu").classList.add("show");
            document.getElementById("backdrop").classList.add("show");
        });
        document.getElementById("closeMenu").addEventListener("click", function() {
            document.getElementById("sidebarMenu").classList.remove("show");
            document.getElementById("backdrop").classList.remove("show");
        });
        document.getElementById("backdrop").addEventListener("click", function() {
            document.getElementById("sidebarMenu").classList.remove("show");
            document.getElementById("backdrop").classList.remove("show");
        });
    </script>
</body>

</html>