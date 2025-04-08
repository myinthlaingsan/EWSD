<?php
include('../../../vendor/autoload.php');

use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\ArticleTable;

$auth = Auth::check();
$user_id = $auth->id ?? null;
$faculty_id = $auth->faculty_id ?? null;
$usertable = new UsersTable(new MySQL);
$table = new ArticleTable(new MySQL);
$profile = $usertable->getuserbyId($user_id);
$rolename = $usertable->getUserRoleName($user_id);
$facultyname = $table->getfacultyname($faculty_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | Riverstone University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Profile Page Styles */
        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .profile-card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            object-fit: cover;
            margin-bottom: 1rem;
        }

        .profile-body {
            padding: 2rem;
            background-color: white;
        }

        .profile-section {
            margin-bottom: 2rem;
        }

        .profile-section-title {
            color: var(--primary-dark);
            border-bottom: 2px solid var(--primary-light);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .info-item {
            margin-bottom: 1rem;
        }

        .info-label {
            font-weight: 600;
            color: var(--primary-dark);
        }

        .edit-btn {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .edit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    <?php include "headermc.php"; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php
            switch ($_GET['error']) {
                case 'current_incorrect':
                    echo "Current password is incorrect";
                    break;
                case 'new_mismatch':
                    echo "New passwords don't match";
                    break;
                default:
                    echo "An error occurred";
            }
            ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>


    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-avatar">
                <h2><?= $profile->name ?></h2>
                <p class="mb-0">Administrator</p>
            </div>

            <div class="profile-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-section">
                            <h3 class="profile-section-title"><i class="fas fa-info-circle me-2"></i>Personal Information</h3>
                            <div class="info-item">
                                <span class="info-label">Full Name:</span>
                                <p><?= $profile->name ?></p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <p><?= $profile->email ?></p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Phone:</span>
                                <p><?= $profile->phone ?></p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Date of Birth:</span>
                                <p>January 15, 1985</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="profile-section">
                            <h3 class="profile-section-title"><i class="fas fa-briefcase me-2"></i>Professional Information</h3>
                            <div class="info-item">
                                <span class="info-label">Position:</span>
                                <p><?= $rolename ?></p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Department:</span>
                                <p><?= $facultyname ?></p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Employee ID:</span>
                                <p>RU-IT-0042</p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Join Date:</span>
                                <p><?= $profile->created_at ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3 class="profile-section-title"><i class="fas fa-lock me-2"></i>Account Security</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="info-label">Last Login:</span>
                                <p><?= $profile->last_login ?></p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Last Update Time:</span>
                                <p><?= $profile->updated_at ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-end">
                            <a href="changepassword.php?id=<?= $user_id ?>" class="edit-btn me-2"><i class="fas fa-key me-1"></i> Change Password</a>
                            <a href="update.php?id=<?= $user_id ?>" class="edit-btn me-2"><i class="fas fa-key me-1"></i> Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
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