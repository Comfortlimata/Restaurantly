<?php
$pdo = new PDO("mysql:host=localhost;dbname=restaurantproject_db", "root", "");

// Your desired login credentials
$username = "admin";
$password = password_hash("1234", PASSWORD_DEFAULT); // ← sets password to '1234'

$stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
$stmt->execute([$username, $password]);

echo "Admin added successfully!";
?>
