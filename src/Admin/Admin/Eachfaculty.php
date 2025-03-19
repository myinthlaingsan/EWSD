<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Details</title>
    <meta name="description" content="Details of a specific university faculty">
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
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
        }
        .faculty-header {
            color: var(--primary-dark);
            font-size: 1.75rem;
            font-weight: 700;
        }
        .faculty-card, .member-card {
            background: var(--card-bg);
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .faculty-card:hover, .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .faculty-details {
            color: var(--text-muted);
            font-size: 1rem;
        }
        .member-icon {
            font-size: 3rem;
            width: 5rem;
            height: 5rem;
            color: var(--primary-light);
            background-color:rgb(255, 255, 255);
            border-radius: 50%;
            display: flex;
            align-items: center;
            border: 1px solid #000000;
            justify-content: center;
            flex-shrink-0;
        }
        .member-name {
            color: var(--primary-dark);
            font-size: 1.125rem;
            font-weight: 500;
        }
        .member-info {
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        .section-title {
            color: var(--primary-dark);
            font-size: 1.5rem;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "headeradm.html"; ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-5">
        <!-- Faculty Overview Section -->
        <section class="mb-5">
            <h1 class="faculty-header mb-4 d-flex align-items-center">
                <i class="fas fa-microchip me-3 text-primary-light"></i> Faculty of Information Technology 
            </h1>
            <div class="faculty-card p-4">
                <div class="faculty-details">
                    <p class="mb-3"><i class="fas fa-building me-2 text-primary-light"></i>Department: Science and Technology</p>
                    <p class="mb-3"><i class="fas fa-users me-2 text-primary-light"></i>Total Students: 25</p>
                    <p class="mb-0"><i class="fas fa-user-tie me-2 text-primary-light"></i>Marketing Coordinator: Mickey</p>
                </div>
            </div>
        </section>

        <!-- Faculty Members Section -->
        <section class="mb-5">
            <h2 class="section-title mb-4">Faculty Members</h2>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <!-- Faculty Member 1 -->
                <div class="col">
                    <div class="member-card p-4">
                        <div class="d-flex align-items-start">
                            <div class="member-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="ms-4">
                                <h3 class="member-name">Name: Kelvin</h3>
                                <p class="member-info mt-2"><i class="fas fa-file-alt me-2 text-primary-light"></i>Total Contribution: 2</p>
                                <p class="member-info mt-1"><i class="fas fa-calendar-alt me-2 text-primary-light"></i>Since: 2025</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Faculty Member 2 -->
                <div class="col">
                    <div class="member-card p-4">
                        <div class="d-flex align-items-start">
                            <div class="member-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="ms-4">
                                <h3 class="member-name">Name: Sophia</h3>
                                <p class="member-info mt-2"><i class="fas fa-file-alt me-2 text-primary-light"></i>Total Contribution: 3</p>
                                <p class="member-info mt-1"><i class="fas fa-calendar-alt me-2 text-primary-light"></i>Since: 2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Faculty Member 3 -->
                <div class="col">
                    <div class="member-card p-4">
                        <div class="d-flex align-items-start">
                            <div class="member-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="ms-4">
                                <h3 class="member-name">Name: Michale</h3>
                                <p class="member-info mt-2"><i class="fas fa-file-alt me-2 text-primary-light"></i>Total Contribution: 1</p>
                                <p class="member-info mt-1"><i class="fas fa-calendar-alt me-2 text-primary-light"></i>Since: 2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Faculty Member 4 -->
                <div class="col">
                    <div class="member-card p-4">
                        <div class="d-flex align-items-start">
                            <div class="member-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="ms-4">
                                <h3 class="member-name">Name: Jane</h3>
                                <p class="member-info mt-2"><i class="fas fa-file-alt me-2 text-primary-light"></i>Total Contribution: 5</p>
                                <p class="member-info mt-1"><i class="fas fa-calendar-alt me-2 text-primary-light"></i>Since: 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include "footer.html"; ?>
</body>
</html>