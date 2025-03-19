


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Faculty Management</title>
    <meta name="description" content="University faculty management system with closure dates and statistics">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    <!-- Header Section -->
    <?php include "headeradm.html";
    ?>

    <!-- Main Content -->
    <main class="container my-5">
        <h2 class="text-center mb-4 fw-bold fs-2">Faculties</h2>

        <!-- Category 1: Science & Technology -->
        <div class="category-header">
            <h3 class="fw-bold fs-4">Science & Technology</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="eachfaculty.php" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-flask fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Science</h3>
                            <p class="card-text text-muted">Biology, Chemistry, Physics, Mathematics, Environmental Science</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="eachfaculty.php" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-cogs fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Engineering</h3>
                            <p class="card-text text-muted">Civil, Mechanical, Electrical, Computer, etc.</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="eachfaculty.php" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-microchip fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Information Technology</h3>
                            <p class="card-text text-muted">Computer Science and IT disciplines</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Category 2: Health & Medical Sciences -->
        <div class="category-header">
            <h3 class="fw-bold fs-4">Health & Medical Sciences</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="eachfaculty.php" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-stethoscope fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Medicine</h3>
                            <p class="card-text text-muted">General Medicine, Surgery, Pediatrics, etc.</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="eachfaculty.php" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-tooth fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Dentistry</h3>
                            <p class="card-text text-muted">Dental care and oral health</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#pharmacy" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-prescription-bottle fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Pharmacy</h3>
                            <p class="card-text text-muted">Pharmaceutical sciences</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#nursing" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-user-nurse fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Nursing & Allied Health</h3>
                            <p class="card-text text-muted">Medical Lab Tech, Radiology, Physiotherapy</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Category 3: Business & Economics -->
        <div class="category-header">
            <h3 class="fw-bold fs-4">Business & Economics</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#business" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-briefcase fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Business Administration</h3>
                            <p class="card-text text-muted">Marketing, HR, Management, Finance</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#economics" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-line fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Economics</h3>
                            <p class="card-text text-muted">Economic theory and analysis</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#commerce" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-calculator fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Commerce & Accounting</h3>
                            <p class="card-text text-muted">Accounting and commercial studies</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Category 4: Humanities & Social Sciences -->
        <div class="category-header">
            <h3 class="fw-bold fs-4">Humanities & Social Sciences</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#arts" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-palette fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Arts & Humanities</h3>
                            <p class="card-text text-muted">Literature, History, Philosophy, Linguistics</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#social-sciences" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Social Sciences</h3>
                            <p class="card-text text-muted">Sociology, Anthropology, Psychology</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#law" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-balance-scale fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Law</h3>
                            <p class="card-text text-muted">Legal studies and justice</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Category 5: Education & Communication -->
        <div class="category-header">
            <h3 class="fw-bold fs-4">Education & Communication</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#education" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-chalkboard-teacher fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Education</h3>
                            <p class="card-text text-muted">Teacher Training, Special Education</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#journalism" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-newspaper fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Journalism & Mass Comm</h3>
                            <p class="card-text text-muted">Media and communication studies</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Category 6: Agriculture & Environmental Studies -->
        <div class="category-header">
            <h3 class="fw-bold fs-4">Agriculture & Environmental Studies</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#agriculture" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-tractor fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Agriculture</h3>
                            <p class="card-text text-muted">Agricultural sciences and farming</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 p-4">
                    <a href="#environmental" class="stretched-link">
                        <div class="card-body text-center">
                            <i class="fas fa-leaf fa-2x mb-3 text-primary"></i>
                            <h3 class="card-title fw-semibold">Faculty of Environmental Science</h3>
                            <p class="card-text text-muted">Sustainability and environmental studies</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <?php include"footer.html"; ?>
</body>
</html>