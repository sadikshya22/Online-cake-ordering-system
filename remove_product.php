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

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    
    // Remove the product from the session cart
    if (($key = array_search($productId, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

$conn->close();

// Redirect back to the cart page
header("Location: cart.php");
exit;
?>
