<?php
require 'includes/db.php';

$message = '';
$cart = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_submit'])) {
    $name = $_POST['customer_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $items = $_POST['items'] ?? [];

    // Calculate total
    $total = 0;
    $order_details = [];
    foreach ($items as $item_id => $quantity) {
        if ($quantity <= 0) continue;

        $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id = ?");
        $stmt->execute([$item_id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $order_details[] = $item['name'] . " x $quantity";
            $total += $item['price'] * $quantity;
        }
    }

    if ($total > 0) {
        $order_text = implode(", ", $order_details);
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, phone, email, address, order_details, total) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $phone, $email, $address, $order_text, $total])) {
            $message = "Order placed successfully! Total: $" . number_format($total, 2);
        } else {
            $message = "Failed to place order.";
        }
    } else {
        $message = "Please select at least one item.";
    }
}

// Fetch available menu items for order form
$stmt = $pdo->query("SELECT * FROM menu_items WHERE is_available = 1");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Order Online - Restaurantly</title>
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

<h1>Order Online</h1>

<?php if ($message): ?>
  <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="order.php">
  <h3>Select Items</h3>
  <?php foreach ($items as $item): ?>
    <div class="order-item">
      <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" />
      <strong><?= htmlspecialchars($item['name']) ?></strong>
      <p><?= htmlspecialchars($item['description']) ?></p>
      <p>Price: $<?= number_format($item['price'], 2) ?></p>
      Quantity:
      <input type="number" name="items[<?= $item['id'] ?>]" min="0" value="0" />
    </div>
  <?php endforeach; ?>

  <h3>Your Details</h3>
  <label>Name:</label>
  <input type="text" name="customer_name" required />

  <label>Phone:</label>
  <input type="tel" name="phone" required />

  <label>Email:</label>
  <input type="email" name="email" required />

  <label>Delivery Address:</label>
  <textarea name="address" rows="3" required></textarea>

  <button type="submit" name="order_submit">Place Order</button>
</form>

</body>
</html>
