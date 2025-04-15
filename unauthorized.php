<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied | Riverstone University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #d32f2f;
            --secondary-color: #f44336;
            --text-color: #333;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            color: var(--text-color);
        }
        
        .unauthorized-container {
            max-width: 600px;
            text-align: center;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background: white;
            border-top: 5px solid var(--primary-color);
        }
        
        .unauthorized-icon {
            font-size: 5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        
        .btn-return {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
        }
        
        .btn-return:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: white;
        }
        
        .contact-info {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="unauthorized-container">
        <div class="unauthorized-icon">
            <i class="fas fa-ban"></i>
        </div>
        <h1>Access Denied</h1>
        <p>You are not authorized to access this page. Please contact your administrator if you believe this is an error.</p>
        <a href="login.php" class="btn-return">
            <i class="fas fa-arrow-left me-2"></i>Return to Login
        </a>
        
        <div class="contact-info mt-4">
            <p>Need help? Contact the IT Support Team at <a href="mailto:support@riverstone.edu">support@riverstone.edu</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>