<?php
session_start();

// Database connection details
$host = "localhost";
$config_username = "root";
$password = "";
$db = "onlinecakeshop";

// Create a connection
$conn = mysqli_connect($host, $config_username, $password, $db);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['user_users_username'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login_users.php");
    exit();
}

// Get the logged-in username from the session
$username = $_SESSION['user_users_username'];

// Check if the payment is successful
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stripeToken'])) {
    // Retrieve the payment details
    $finalAmount = $_SESSION['finalAmount'] ?? $_SESSION['totalAmount'];
    $paymentCurrency = 'USD';
    $paymentToken = $_POST['stripeToken'];

    // Process the payment using Stripe API
    require_once('stripe-php-master/init.php');

    // Set your Stripe API keys
    $stripeSecretKey = 'sk_test_51NQkugC8xqRNwIOSbyWbU1NFU4U12ICl8X3U7G3YeCeyTxOD2UWnxAWBM0ba8Ue9ac9j3wSSZiYWGvgKRJn1o22e00gGbfJIqV';
    \Stripe\Stripe::setApiKey($stripeSecretKey);

    try {
        // Create a charge
        $charge = \Stripe\Charge::create([
            'amount' => $finalAmount * 100, // Convert the amount to cents
            'currency' => $paymentCurrency,
            'description' => 'Payment for Cake Order',
            'source' => $paymentToken,
        ]);

        // Payment successful
        $paymentId = $charge->id;
        $paymentAmount = $charge->amount / 100; // Retrieve the actual payment amount
        $paymentSuccessDate = date('Y-m-d H:i:s'); // Get the current date and time

        // Retrieve the product details from the session
        $productIds = $_POST['product_id'];
        $productNames = $_POST['product_name'];
        $quantities = $_POST['quantity'];
        $weights = $_POST['weight'];
        $prices = $_POST['price'];
        $deliveryMessage = mysqli_real_escape_string($conn, $_POST['delivery_message']);
        $deliveryDate = $_POST['delivery_date'];
        $deliveryAddress = mysqli_real_escape_string($conn, $_POST['delivery_address']);
        $phoneNumber = $_POST['phone_number'];

        // Store the order and product details in the bakery_order table
        $host = "localhost";
        $config_username = "root";
        $password = "";
        $db = "onlinecakeshop";

        $conn = mysqli_connect($host, $config_username, $password, $db);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and execute the SQL query to insert the order details into the database
        $insertOrderQuery = "INSERT INTO bakery_order (username, payment_id, payment_amount, payment_success_date) VALUES ('$username', '$paymentId', '$paymentAmount', '$paymentSuccessDate')";

        if (mysqli_query($conn, $insertOrderQuery)) {
            // Get the auto-generated order ID
            $orderId = mysqli_insert_id($conn);

            // Prepare and execute the SQL query to insert the product details into the database
            $insertProductQuery = "INSERT INTO bakery_order (username, product_name, quantity, weight, paid_price, delivery_message, delivery_date, delivery_address, phone_number, payment_id, payment_amount, payment_success_date) VALUES ";
            for ($i = 0; $i < count($productIds); $i++) {
                $productId = mysqli_real_escape_string($conn, $productIds[$i]);
                $productName = mysqli_real_escape_string($conn, $productNames[$i]);
                $quantity = mysqli_real_escape_string($conn, $quantities[$i]);
                $weight = mysqli_real_escape_string($conn, $weights[$i]);
                $paidPrice = $prices[$i]; // Use the original price from the form

                $insertProductQuery .= "('$username', '$productName', '$quantity', '$weight', '$paidPrice', '$deliveryMessage', '$deliveryDate', '$deliveryAddress', '$phoneNumber', '$paymentId', '$paymentAmount', '$paymentSuccessDate')";

                if ($i < count($productIds) - 1) {
                    $insertProductQuery .= ",";
                }
            }

            if (mysqli_query($conn, $insertProductQuery)) {
                // Order and product details stored successfully
                echo "Order placed successfully!";
                // Clear the cart after the order is placed
                unset($_SESSION['cart']);
                unset($_SESSION['totalAmount']);
                unset($_SESSION['finalAmount']);

                 header("Location: fetch_delivery_info.php");
    exit;
            } else {
                // Failed to store product details
                echo "Failed to store product details: " . mysqli_error($conn);
            }
        } else {
            // Failed to store payment details
            echo "Failed to store payment details: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } catch (\Stripe\Exception\CardException $e) {
        // Payment failed
        $error = $e->getError();
        echo "Payment failed: " . $error['message'];
    }
} else {
    // Invalid payment request
    echo "Invalid payment request.";
}
?>
