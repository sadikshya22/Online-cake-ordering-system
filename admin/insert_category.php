<?php
require_once('../config.php');

$category_name = $_POST['category_name'];
$file_name = $_FILES['category_image']['name'];

// Check if category_name already exists in the database
$sql = "SELECT * FROM cake_shop_category WHERE category_name='$category_name'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // Category already exists, display an alert
    echo "<script type='text/javascript'>alert('Category already exists, please try another.')</script>";
} else {
    if ($file_name != "") {
        $f_name = Date('ymdhis');
        $file_array = explode('.', $file_name);
        $ext = $file_array[count($file_array) - 1];
        $new_file_name = $f_name . '.' . $ext;
        $destination = "../uploads/" . $new_file_name;
        $source = $_FILES['category_image']['tmp_name'];
        move_uploaded_file($source, $destination);
    } else {
        // Use default image if no category image is provided
        $default = "default-image.jpg";
        $new_file_name = $default;
    }

    // Insert category details into the database
    $insert = "INSERT INTO cake_shop_category (category_name, category_image) VALUES ('$category_name', '$new_file_name')";
    mysqli_query($conn, $insert);

    // Redirect to add_category.php with success message
    header('Location: add_category.php?add_msg=1');
}
?>
