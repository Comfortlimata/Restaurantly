<?php
// includes/db.php
$host = 'localhost';
$db   = 'restaurantproject_db';
$user = 'root';      // Change if needed
$pass = '';          // Change if you have a password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
