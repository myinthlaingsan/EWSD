<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .password-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .password-header {
            text-align: center;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
        }
        .success-message {
            color: #28a745;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<?php include "headermc.php"; ?>
    <div class="container">
        <div class="password-container">
            <div class="password-header">
                <h3>Change Password</h3>
            </div>
            <form action="../code/update_password.php" method="POST">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($_GET['id']) ?>">
                
                <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" class="form-control" id="newPassword" name="new_password" required>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                    <div class="error-message" id="passwordMatchError"></div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <a href="profile.php" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simple password match validation
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordMatchError = document.getElementById('passwordMatchError');

        confirmPassword.addEventListener('input', function() {
            if (newPassword.value !== confirmPassword.value) {
                passwordMatchError.textContent = 'Passwords do not match';
            } else {
                passwordMatchError.textContent = '';
            }
        });
    </script>
</body>
</html>