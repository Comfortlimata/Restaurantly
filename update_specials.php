<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['dish_name'];
    $desc = $_POST['dish_desc'];
    $image = $_FILES['dish_image'];

    $target_dir = "assets/images/";
    $image_name = basename($image["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        $special = [
            'name' => $name,
            'desc' => $desc,
            'image' => $target_file
        ];
        file_put_contents('special.json', json_encode($special));
        echo "<script>alert('Special updated!'); window.location.href='admin_home.php';</script>";
    } else {
        echo "<script>alert('Image upload failed.'); window.history.back();</script>";
    }
}
?>
