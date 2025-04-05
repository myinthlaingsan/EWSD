<?php 
include('../../../vendor/autoload.php');
use Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
// $auth = Auth::check();
$table = new UsersTable(new MySQL);
$faculties = $table->getAllFaculty();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../css/all.min1.css" />
    <style>
        body {
            background-color: #f8fafc; /* Light gray background */
        }
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card a {
            text-decoration: none; /* Remove underline from links */
            color: inherit; /* Inherit text color */
        }
        .category-header {
            background-color: #e9ecef; /* Light gray for category headers */
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <main class="container my-5">
    <div class="container text-center mt-4" style="max-width: 680px">
        <form action="../code/faculty.php" method="post" class="mb-2">
            <input type="text" class="form-control mb-2" name="faculty_name" placeholder="Faculty" required>
            <button class="btn btn-primary w-100">Add Faculty</button>
        </form>
    </div>

    <!-- Category 2: Health & Medical Sciences -->
    <div class="category-header">
        <h3 class="fw-bold fs-4">Health & Medical Sciences</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
        <?php foreach( $faculties as $faculty) : ?>
        <div class="col">
            <div class="card h-100 p-4">
                <a href="eachfaculty.php?id=<?= $faculty->id ?>" class="stretched-link">
                    <div class="card-body text-center">
                        <i class="fas fa-stethoscope fa-2x mb-3 text-primary"></i>
                        <h3 class="card-title fw-semibold"><?= $faculty->faculty_name; ?></h3>
                        <p class="card-text text-muted">General Medicine, Surgery, Pediatrics, etc.</p>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    </main>
    <?php include "footer.php"; ?>
</body>
<script src="../../../js/bootstrap.bundle.min.js"></script>

</html>