
<?php
require 'includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['customer_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $guests = (int)($_POST['guests'] ?? 1);
    $seating = $_POST['seating_preference'] ?? '';
    $requests = $_POST['special_requests'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO reservations (customer_name, phone, email, date, time, guests, seating_preference, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $phone, $email, $date, $time, $guests, $seating, $requests])) {
        $message = "Reservation successfully made! We will contact you to confirm.";
        // TODO: Send confirmation email/SMS here
    } else {
        $message = "Error making reservation. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Reservations - Restaurantly</title>
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

<h1>Make a Reservation</h1>

<?php if ($message): ?>
  <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" action="reservations.php">
  <label>Name:</label>
  <input type="text" name="customer_name" required />

  <label>Phone:</label>
  <input type="tel" name="phone" required />

  <label>Email:</label>
  <input type="email" name="email" required />

  <label>Date:</label>
  <input type="date" name="date" required />

  <label>Time:</label>
  <input type="time" name="time" required />

  <label>Number of Guests:</label>
  <input type="number" name="guests" min="1" value="1" required />

  <label>Seating Preference:</label>
  <select name="seating_preference">
    <option value="Indoor">Indoor</option>
    <option value="Outdoor">Outdoor</option>
    <option value="Booth">Booth</option>
  </select>

  <label>Special Requests:</label>
  <textarea name="special_requests" rows="3"></textarea>

  <button type="submit">Reserve Table</button>
</form>

</body>
</html>
