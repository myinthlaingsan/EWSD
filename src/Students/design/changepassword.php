<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../university.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .password-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .password-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
        }

        .success-message {
            color: #28a745;
            font-size: 0.9rem;
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
    <div class="container">
        <div class="password-container">
            <div class="password-header">
                <h3>Change Password</h3>
            </div>

            <form action="../code/update_password.php" method="POST">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($_GET['id']) ?>">

                <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="new_password" required>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                    <div class="error-message" id="passwordMatchError"></div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <a href="profile.php" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
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
              loading="lazy"
            >
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
              loading="lazy"
            >
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
        // Simple password match validation
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordMatchError = document.getElementById('passwordMatchError');

        confirmPassword.addEventListener('input', function() {
            if (newPassword.value !== confirmPassword.value) {
                passwordMatchError.textContent = 'Passwords do not match';
            } else {
                passwordMatchError.textContent = '';
            }
        });
    </script>
</body>

</html>