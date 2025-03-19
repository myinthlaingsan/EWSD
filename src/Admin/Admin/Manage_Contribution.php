<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contribution</title>
    <meta name="description" content="Manage university contribution entries">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            --accent: #facc15;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-muted: #64748b;
            --numbers: #87ceeb;
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
        }
        .search-container {
            max-width: 40rem;
            margin: 0 auto 3rem;
        }
        .search-input {
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }
        .btn-search {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .card {
            background: var(--card-bg);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .id-circle {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.25rem;
        }
        .contribution-title {
            color: var(--primary-dark);
            font-size: 1.25rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headeradm.html"; ?>

    <!-- Main Content -->
    <main class="container py-5">
        <h1 class="text-center fw-bold mb-5" style="color: var(--primary-dark);">Manage Contribution</h1>

        <!-- Search Bar -->
        <div class="search-container">
            <form class="d-flex">
                <div class="input-group">
                    <input type="text" class="form-control search-input" placeholder="Search contributions...">
                    <button class="btn btn-search text-white" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Contribution Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php 
            $contributions = [
                ["id" => 1, "name" => "Science Symposium 2025", "closure" => "2025-03-15", "final" => "2025-04-01", "faculty" => "Science", "students" => 25],
                ["id" => 2, "name" => "Engineering Expo", "closure" => "2025-05-10", "final" => "2025-06-01", "faculty" => "Engineering", "students" => 18],
                ["id" => 3, "name" => "Business Case Challenge", "closure" => "2025-07-20", "final" => "2025-08-15", "faculty" => "Business", "students" => 30],
                ["id" => 4, "name" => "Arts Festival", "closure" => "2025-09-05", "final" => "2025-10-01", "faculty" => "Arts & Humanities", "students" => 22]
            ];

            foreach ($contributions as $contribution) {
            ?>
            <div class="col">
                <div class="card p-4">
                    <div class="d-flex align-items-center">
                        <div class="id-circle me-3"> <?php echo $contribution['id']; ?> </div>
                        <div class="flex-grow-1">
                            <h3 class="contribution-title"> <?php echo $contribution['name']; ?> </h3>
                            <p class="text-muted mb-1"><i class="fas fa-calendar-alt me-2"></i>Closure Date: <?php echo $contribution['closure']; ?></p>
                            <p class="text-muted mb-1"><i class="fas fa-calendar-check me-2"></i>Final Closure Date: <?php echo $contribution['final']; ?></p>
                            <p class="text-muted mb-1"><i class="fas fa-building me-2"></i>Faculty: <?php echo $contribution['faculty']; ?></p>
                            <p class="text-muted mb-1"><i class="fas fa-users me-2"></i>Total Students: <span class="fw-bold" style="color: var(--primary-light);"> <?php echo $contribution['students']; ?> </span></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include "footer.html"; ?>
</body>
</html>
