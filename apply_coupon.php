<?php
session_start();

// Database connection details
$host = "localhost";
$config_username = "root";
$password = "";
$db = "onlinecakeshop";

$conn = mysqli_connect($host, $config_username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Calculate the total amount
$totalAmount = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId) {
        $productId = mysqli_real_escape_string($conn, $productId);
        $select = "SELECT * FROM cake_shop_product WHERE product_id = '$productId'";
        $query = mysqli_query($conn, $select);

        if (!$query) {
            die("Query failed: " . mysqli_error($conn));
        }

        $res = mysqli_fetch_assoc($query);
        $totalAmount += $res['product_price'];
    }
}

// Check if a coupon code is provided
$couponApplied = false;
$finalPrice = $totalAmount;

if (isset($_POST['coupon'])) {
    $couponCode = $_POST['coupon'];
    if (!empty($couponCode)) {
        // Retrieve the coupon code and percentage from the database
        $couponCode = mysqli_real_escape_string($conn, $couponCode);
        $sql = "SELECT percentage FROM coupons WHERE code = '$couponCode'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $percentage = $row['percentage']; // Get the discount percentage

            // Calculate the discounted amount
            $discountedAmount = $totalAmount * ($percentage / 100);
            $finalPrice = $totalAmount - $discountedAmount;
            $couponApplied = true;
        }
    }
}

$conn->close();

// Return the response as JSON
$response = array(
    // 'status' => 'success',
     $finalPrice
);
echo json_encode($response);
?>