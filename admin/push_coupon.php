<?php
// Connect to the database
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

// Start the session
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["code"]) && isset($_POST["percentage"])) {
        $code = $_POST["code"];
        $percentage = $_POST["percentage"];
        $active = isset($_POST["active"]) ? 1 : 0;

        try {
            // Insert the coupon into the database
            $query = "INSERT INTO pushed_coupons (code, percentage, created_at) VALUES (?, ?, NOW())";
            $stmt = $db->prepare($query);
            $stmt->execute([$code, $percentage]);

            // Store the pushed coupon information in the session
            $_SESSION["pushedCoupon"] = json_encode([
                "code" => $code,
                "percentage" => $percentage
            ]);

            echo "Coupon pushed successfully!";
        } catch (PDOException $e) {
            echo "Failed to push the coupon: " . $e->getMessage();
        }
    } else {
        echo "Invalid coupon data!";
    }
} else {
    echo "Invalid request!";
}
