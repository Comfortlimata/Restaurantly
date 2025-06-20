<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require '../includes/db.php';

$message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dish = $_POST['special_dish'];
    $desc = $_POST['special_desc'];
    $image = $_FILES['special_image'];

    // Save uploaded image
    if ($image['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($image['name']);
        $targetPath = "../assets/images/" . $imageName;
        move_uploaded_file($image['tmp_name'], $targetPath);
    }

    // Save special to a file or DB
    $special = [
        'dish' => $dish,
        'desc' => $desc,
        'image' => "assets/images/$imageName"
    ];
    file_put_contents('../special.json', json_encode($special));
    $message = "Special updated!";
}
?>

<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h2>Welcome, <?= htmlspecialchars($_SESSION['admin_username']) ?></h2>
<a href="logout.php">Logout</a>

<h3>Update Today's Special</h3>
<?php if ($message) echo "<p style='color:green;'>$message</p>"; ?>

<form method="post" enctype="multipart/form-data">
  <input type="text" name="special_dish" placeholder="Dish Name" required><br>
  <textarea name="special_desc" placeholder="Description" required></textarea><br>
  <input type="file" name="special_image" accept="image/*" required><br>
  <button type="submit">Update Special</button>
</form>
</body>
</html>
