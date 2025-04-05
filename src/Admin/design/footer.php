<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        :root {
            --primary-dark: #1e3a8a;
            --primary-light: #3b82f6;
            --secondary: #64748b;
            --accent: #facc15;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
        }
        footer {
            background: var(--primary-dark);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
            position: relative;
            z-index: 900;
        }

        footer a {
            color: var(--accent);
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="fs-5 mb-2">Riverstone University</p>
            <p class="text-light opacity-75 mb-3">Empowering education through innovative management solutions</p>
            <p class="mb-2"><strong>Quick Links:</strong> 
                <a href="index.php">Home</a> | 
                <a href="Contact_Us.html">Contact Us</a> | 
                <a href="#">About Us</a>
            </p>
            <p><strong>Contact Us:</strong> Block 21, University Avenue, New York, US | Phone: +422 234 124 54</p>
        </div>
    </footer>
</body>
</html>