<?php
session_start();
require '../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body>

<h2>Admin Login</h2>

<?php if ($message): ?>
  <p class="error"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="">
  <label>Username:</label>
  <input type="text" name="username" required />

  <label>Password:</label>
  <input type="password" name="password" required />

  <button type="submit">Login</button>
</form>

</body>
</html>
