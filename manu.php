<?php
require 'includes/db.php';

// Get distinct categories for filter
$catStmt = $pdo->query("SELECT DISTINCT category FROM menu_items");
$categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);

// Optionally filter by category
$filterCategory = $_GET['category'] ?? null;
if ($filterCategory) {
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE category = ? AND is_available = 1");
    $stmt->execute([$filterCategory]);
} else {
    $stmt = $pdo->query("SELECT * FROM menu_items WHERE is_available = 1");
}
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Menu - Restaurantly</title>
<link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>

<header>
  <nav>
    <a href="index.php">Home</a>
    <a href="menu.php">Menu</a>
    <a href="reservations.php">Reservations</a>
    <a href="order.php">Order Online</a>
    <a href="about.php">About</a>
    <a href="contact.php">Contact</a>
    <a href="admin/login.php">Admin</a>
  </nav>
</header>

<h1>Menu</h1>

<div class="filters">
  <strong>Filter by category:</strong>
  <a href="menu.php">All</a>
  <?php foreach ($categories as $cat): ?>
    <a href="menu.php?category=<?= urlencode($cat) ?>"><?= htmlspecialchars($cat) ?></a>
  <?php endforeach; ?>
</div>

<div class="menu-items">
  <?php foreach ($items as $item): ?>
    <div class="menu-item">
      <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" />
      <h3><?= htmlspecialchars($item['name']) ?></h3>
      <p><?= htmlspecialchars($item['description']) ?></p>
      <p><strong>$<?= number_format($item['price'], 2) ?></strong></p>
    </div>
  <?php endforeach; ?>
</div>

</body>
</html>
