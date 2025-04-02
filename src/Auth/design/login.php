<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Font Awesome Link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Main CSS Link -->
    <link rel="stylesheet" href="../../Students/university.css" />

    <!-- Bootstrap CSS CDN LInk -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <!-- Form start -->
    <div class="container stulogin my-5 pt-4 pb-3 text-dark" style="max-width: 900px">
     <form action="../code/login.php" method="post">
        <h1>Riverstone University</h1>
        <h5>Please Login!</h5>
        <hr />
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" name="email" class="form-control" id="staticEmail" placeholder="emailexample@.com" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="inputPassword" required>
            </div>
          </div>
          <div class="col-auto mb-3">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="autoSizingCheck">
              <label class="form-check-label" for="autoSizingCheck">
                Remember me
              </label>
            </div>
          </div>
          <div class="form-text text-dark mb-2">
            If you don't have an account, click <a href="studentregister.html">here!</a>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
    </form>
  </div>

    <!-- Form end -->
  </body>
  <!-- Main JS Link -->
  <script src="main.js"></script>

  <!-- Bootstrap JS CDN Link -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</html>
