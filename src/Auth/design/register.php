<?php
include('../../../vendor/autoload.php');

use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$table = new UsersTable(new MySQL);
$faculties = $table->getAllFaculty();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center" style="max-width: 600px">
        <h1 class="h3 my-4">Register</h1>
        <form action="../code/register.php" method="post" class="mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
            <label for="Address">Address</label>
            <input type="text" name="address" class="form-control mb-2" placeholder="Address" required>
            <label for="Phone">Phone</label>
            <input type="number" name="phone" class="form-control mb-2" placeholder="Phone" required>
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <label class="form-label">Select your faculty</label>
            <select name="faculty_id" class="form-control mb-2">
                <option value="">Select Faculty</option>
                <?php foreach ($faculties as $faculty): ?>
                    <option value="<?= $faculty->id ?>">
                        <?= $faculty->faculty_name ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-primary w-180">Register</button>
        </form>
        <a href="login.php">Login</a>
    </div>
</body>

</html>