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
  <!-- Main CSS Link -->
  <link rel="stylesheet" href="../university.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary-dark: #1e40af;
      --primary-light: #3b82f6;
      /* Add other variables as needed */
    }

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
  <!-- nav bar start -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand me-5 text-light" href="#">
        <h3>Riverstone University</h3>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasNavbar"
        aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title hearder1" id="offcanvasNavbarLabel">
            Riverstone University
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="navbar-nav offcanvas-body justify-content-lg-end mb-lg-0">
          <li class="nav-item me-5">
            <a
              class="nav-link"
              aria-current="page"
              href="./dashboard.php">Home</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="create_articles.php">Add Article</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="view_articles.php">View Article</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" aria-current="page" href="#aboutus">Aboout</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" href="#contactpage">Contact Us</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <!-- <li class="nav-item">
              <a class="nav-link" href="../../Auth/design/register.php"
                ><i class="fa-solid me-2 fa-arrow-right-to-bracket"></i>Sign
                In</a
              >
            </li> -->
          <li class="nav-item">
            <a class="nav-link" href="../../Auth/code/logout.php"><i class="fa-solid me-2 fa-arrow-right-from-bracket"></i>Logout</a>
          </li>
        </div>
      </div>
    </div>
  </nav>
  <!-- Nav bar end -->
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
  <?php if (isset($_SESSION['update'])): ?>
    <div class="alert alert-success">
      <?= $_SESSION['update']; ?>
    </div>
    <?php unset($_SESSION['update']); ?>
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
                <p><?= $profile->id ?></p>
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

  <!-- footer start -->
  <footer>
    <div class="container-fluid">
      <div class="row text-light text-center justify-content-center">
        <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
          <h3><i class="fa-solid fa-location-dot"></i></h3>
          <h5>Address</h5>
          <h6>
            Riverstone University <br />
            456 Elm St, Springfield, IL 62704, USA
          </h6>
        </div>
        <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
          <h3><i class="fa-solid fa-square-phone"></i></h3>
          <h5>Call Us</h5>
          <h6>+1 (555) 123-4567</h6>
        </div>
        <div class="col-12 col-lg-3 p-lg-4 mt-4">
          <iframe
            class="footermap1 img img-fluid rounded"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3045.624315425934!2d-89.650847684609!3d39.781734979425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8875395a5b8f5b5f%3A0x1f1e5b5b5b5b5b5b!2s456%20Elm%20St%2C%20Springfield%2C%20IL%2062704%2C%20USA!5e0!3m2!1sen!2sus!4v1633024000000!5m2!1sen!2sus"
            style="border: 0"
            allowfullscreen=""
            loading="lazy">
          </iframe>
        </div>
        <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
          <h3><i class="fa-solid fa-envelope-open-text"></i></h3>
          <h5>Email</h5>
          <h6>info@riverstone.edu</h6>
        </div>
        <div class="col-6 col-lg-2 p-lg-4 mt-sm-4">
          <h3><i class="fa-regular fa-thumbs-up"></i></h3>
          <h5>Follow us</h5>
          <h6>
            <i class="me-1 fa-brands fa-facebook"></i>
            <i class="me-1 fa-brands fa-youtube"></i>
            <i class="me-1 fa-brands fa-x-twitter"></i>
            <i class="me-1 fa-brands fa-instagram"></i>
          </h6>
        </div>
        <div class="col-12 mb-4 mt-2">
          <iframe
            class="footermap2 img img-fluid rounded"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3045.624315425934!2d-89.650847684609!3d39.781734979425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8875395a5b8f5b5f%3A0x1f1e5b5b5b5b5b5b!2s456%20Elm%20St%2C%20Springfield%2C%20IL%2062704%2C%20USA!5e0!3m2!1sen!2sus!4v1633024000000!5m2!1sen!2sus"
            style="border: 0"
            allowfullscreen=""
            loading="lazy">
          </iframe>
        </div>
        <div class="col-12 my-3">
          <h6>Copyright © 2025 Riverstone University. All Rights reserved</h6>
          <h6>
            Designed by <b class="text-danger"> Error 404 Team Found </b>
          </h6>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer end -->
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
<!-- Main JS Link -->
<script src="../main.js"></script>

</html>