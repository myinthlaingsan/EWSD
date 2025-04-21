<?php
include("../../../vendor/autoload.php");

use Helpers\Auth;
use Helpers\HTTP;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\ArticleTable;
use Libs\Database\ActivityLogsTable;

$auth = Auth::check();
$table = new UsersTable(new MySQL);
$articleTable = new ArticleTable(new MySQL);
$user = $table->getuserbyId($auth->id);
$user_id = $auth->id ?? null;
$role = $table->getUserRoleName($user_id);
if ($role !== 'Student') {
  HTTP::redirect('/unauthorized.php'); // Create this page to show access denied
  exit();
}
// Get closure date information
$closureDate = $table->selectClosureDate();
$submissionsClosed = ($closureDate && date('Y-m-d') > $closureDate);

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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Submit Article</title>
  <!-- Font Awesome Link -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <!-- Main CSS Link -->
  <link rel="stylesheet" href="../university.css" />
  <!-- Bootstrap CSS CDN LInk -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <style>
    .readonly-field {
      background-color: #e9ecef;
      cursor: not-allowed;
    }

    .form-control:disabled,
    .form-control[readonly] {
      background-color: #e9ecef;
    }
  </style>
</head>

<body>
  <!-- nav bar start -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand me-5 text-light" href="Studenthomepage.html">
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
            <a
              class="nav-link"
              aria-current="page"
              href="Studenthomepage.html#aboutus">About</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" href="Studenthomepage.html#contactpage">Contact Us</a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../Auth/code/logout.php"><i class="fa-solid me-2 fa-arrow-right-from-bracket"></i>Logout</a>
          </li>
        </div>
      </div>
    </div>
  </nav>
  <!-- Nav bar end -->
  <?php if (isset($_SESSION['login_message'])): ?>
    <div class="alert alert-info">
      <?= $_SESSION['login_message'] ?>
    </div>
    <?php unset($_SESSION['login_message']); ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
      <?= $_SESSION['error'] ?>
    </div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>
  <!-- Form start -->
  <div class="registerform container my-5 text-black pt-4 pb-3 w-75">
    <h1 class="article_header">Riverstone University</h1>
    <h5>Please fill out the article submit form carefully!</h5>
    <br />
    <br />
    <p class="stuinfo">Submit Articles</p>
    <hr />

    <?php if ($submissionsClosed): ?>
      <div class="alert alert-danger">
        <h4>Submissions Closed!</h4>
        <p>New article submissions are no longer being accepted as the deadline has passed.</p>
        <p>The submission deadline was: <?= date('F j, Y', strtotime($closureDate)) ?></p>
        <a href="dashboard.php" class="btn btn-primary">Return to Dashboard</a>
      </div>
    <?php else: ?>
      <form class="row g-3 needs-validation" action="../code/create_articles.php" method="post" enctype="multipart/form-data" novalidate>
        <div class="col-md-12">
          <label for="inputname" class="form-label">Article Title *</label>
          <input type="text" class="form-control" id="inputname" name="title" required />
          <div class="invalid-feedback">
            Please provide an article title.
          </div>
        </div>
        <div class="col-md-12">
          <label for="userid" class="form-label">Author ID *</label>
          <input type="text" class="form-control" id="userid" name="userid" value="<?= htmlspecialchars($user->id) ?>" readonly required />
        </div>
        <div class="col-md-12">
          <label for="username" class="form-label">Author Name *</label>
          <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user->name) ?>" readonly required />
        </div>
        <div class="col-md-12">
          <label for="userid" class="form-label">Add Your Academic Year</label>
          <input type="text" class="form-control" id="academicyear" name="academicyear" required />
        </div>
        <div class="col-md-6">
          <label for="docFiles" class="form-label">Upload Files *</label>
          <input
            class="form-control"
            type="file"
            id="docFiles"
            name="docfile[]"
            accept=".doc,.docx,.pdf,.txt"
            multiple required aria-describedby="fileHelp" />
          <div id="fileHelp" class="form-text text-dark">Accepted formats: DOC, DOCX, PDF, TXT</div>
          <div class="invalid-feedback">
            Please upload at least one document file.
          </div>
        </div>

        <div class="col-md-6">
          <label for="imageFiles" class="form-label">Upload Images *</label>
          <input
            class="form-control"
            type="file"
            id="imageFiles"
            name="imagefile[]"
            accept="image/*"
            multiple required />
          <div class="form-text text-dark">Accepted formats: JPG, PNG</div>
          <div class="invalid-feedback">
            Please upload at least one image.
          </div>
        </div>

        <div class="col-12 mb-lg-2">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="agreeTerms" name="agree" required />
            <label class="form-check-label" for="agreeTerms">
              I agree to the Terms and Conditions *
            </label>
            <div class="invalid-feedback">
              You must agree to the Terms and Conditions before submitting.
            </div>
          </div>
        </div>

        <div class="col-12">
          <p class="text-danger"><strong>Important Notes:</strong></p>
          <p class="text-danger">
            Please submit articles before <?= date('F j, Y', strtotime($closureDate)) ?> <br />
            We will not accept any articles submitted beyond this date. <br />
            You can edit/modify your articles until <?= date('F j, Y', strtotime($closureDate . ' + 14 days')) ?>
          </p>
        </div>

        <div class="col-12 submitearticle">
          <button type="submit" class="btn btn-primary">Submit Article</button>
          <a href="dashboard.php" class="btn btn-secondary ms-2">Cancel</a>
        </div>
      </form>
    <?php endif; ?>
  </div>
  <!-- Form end -->

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

  <!-- Main JS Link -->
  <script src="../main.js"></script>

  <!-- Bootstrap JS CDN Link -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <!-- Form Validation Script -->
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>
</body>

</html>