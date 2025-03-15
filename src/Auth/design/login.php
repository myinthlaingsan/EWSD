<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css"/>
</head>
<body>
    <h1>Login</h1>
    <div class="container text-center" style="max-width: 680px">
        <form action="../code/login.php" method="post" class="mb-2">
            <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>
            <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>
            <button class="btn btn-primary w-100">Login</button>
        </form>
        <a href="register.php">Register</a>
    </div>
    
</body>
<script src="../../../js/bootstrap.bundle.min.js"></script>
</html>