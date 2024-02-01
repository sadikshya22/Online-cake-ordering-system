<?php
// Connect to the database (same database credentials as in the original code)
$host = 'localhost'; // Update with your database host
$dbName = 'onlinecakeshop'; // Update with your database name
$username = 'root'; // Update with your database username
$password = ''; // Update with your database password

try {
    $db = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get the pushed coupon data from the POST request
$code = $_POST["code"];
$percentage = $_POST["percentage"];

// Insert the coupon into the pushed_coupons table
$query = "INSERT INTO pushed_coupons (code, percentage) VALUES (?, ?)";
$stmt = $db->prepare($query);
$stmt->execute([$code, $percentage]);

echo "Coupon pushed successfully!";
?>
