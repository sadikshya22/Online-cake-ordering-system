<?php
session_start();

// Check if the necessary data is provided
if (isset($_GET['id'], $_GET['quantity'], $_GET['weight'], $_GET['price'])) {
    // Retrieve the data from the request
    $product_id = $_GET['id'];
    $quantity = $_GET['quantity'];
    $weight = $_GET['weight'];
    $price = $_GET['price'];

    // Calculate the final price based on the weight and quantity
    $total_price = $price * $weight * $quantity;

    // Prepare the cart item
    $cart_item = array(
        'product_id' => $product_id,
        'quantity' => $quantity,
        'weight' => $weight,
        'price' => $total_price
    );

    // Check if the cart session variable exists
    if (!isset($_SESSION['cart'])) {
        // If the cart doesn't exist, create it as an empty array
        $_SESSION['cart'] = array();
    }

    // Add the cart item to the cart session variable
    $_SESSION['cart'][] = $cart_item;

    // Return the updated cart as a response (optional)
    echo json_encode($_SESSION['cart']);
}
?>
