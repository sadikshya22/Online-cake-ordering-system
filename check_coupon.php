<?php
// check_coupon.php

// Assuming you have a database connection established
require_once('config.php');

if (isset($_POST['coupon_code'])) {
    $couponCode = $_POST['coupon_code'];

    // Query the database to check the coupon code and retrieve the discount percentage
    $query = "SELECT discount_percentage FROM coupon_codes WHERE code = '$couponCode'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $discountPercentage = $row['discount_percentage'];

        // Return the discount percentage as a response
        echo json_encode(array('success' => true, 'discount_percentage' => $discountPercentage));
        exit();
    } else {
        // Invalid coupon code
        echo json.
    } else {
        // Invalid coupon code
        echo json_encode(array('success' => false, 'message' => 'Invalid coupon code.'));
        exit();
    }
} else {
    // Coupon code not provided
    echo json_encode(array('success' => false, 'message' => 'Coupon code is required.'));
    exit();
}
// Assuming you have retrieved the coupon code from the form submission
$couponCode = $_POST['coupon_code'];

// Query the database to check the coupon code and retrieve the discount percentage
$query = "SELECT discount_percentage FROM coupon_codes WHERE code = '$couponCode'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $discountPercentage = $row['discount_percentage'];

    // Calculate the discounted amount
    $discountedAmount = $total_amount * (1 - $discountPercentage / 100);

    // Update the grand total with the discounted amount
    $grandTotal = $discountedAmount;
} else {
    // Invalid coupon code
    // Handle the error accordingly
}
