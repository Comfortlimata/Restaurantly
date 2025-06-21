<?php
session_start();

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin/dashboard.php');
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Simple admin credentials (in production, use proper authentication)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: admin/dashboard.php');
        exit();
    } else {
        $error_message = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Restaurantly</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <nav>
        <div class="logo">
            <a href="index.php">Restaurantly</a>
        </div>
        <div class="nav-links">
            <a href="index.php">Back to Home</a>
        </div>
    </nav>
</header>

<div class="login-container">
    <h2>Admin Login</h2>
    
    <?php if (isset($error_message)): ?>
        <div class="error-message" style="background: #fee; color: #c33; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit">Login</button>
    </form>
    
    <div style="margin-top: 2rem; text-align: center; color: #666;">
        <p><strong>Demo Credentials:</strong></p>
        <p>Username: admin</p>
        <p>Password: admin123</p>
    </div>
</div>

<script>
// Add some styling for the error message
document.addEventListener('DOMContentLoaded', function() {
    const errorMessage = document.querySelector('.error-message');
    if (errorMessage) {
        errorMessage.style.animation = 'fadeInUp 0.5s ease-out';
    }
});
</script>

</body>
</html>
