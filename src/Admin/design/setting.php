<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container text-center mt-5" style="max-width: 680px">
        <form action="../code/setting.php" method="post" class="mb-2">
            <!-- <input type="text" class="form-control mb-2" name="academicyear" placeholder="Academic Year" required> -->
            <label>Submission Closure Date</label>
            <input type="date" class="form-control mb-2" name="closuredate" placeholder="Closure Date" required>
            <label>Final Closure Date</label>
            <input type="date" class="form-control mb-2" name="finalclosuredate" placeholder="Final Closure Date" required>
            <button class="btn btn-primary w-100">Set Settings</button>
        </form>
    </div>
    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>
<script src="../../../js/bootstrap.bundle.min.js"></script>

</html>