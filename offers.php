<!DOCTYPE html>
<html>
<head>
    <title>Offers</title>
</head>
<body>
    <h1>Offers</h1>

    <?php
    // Retrieve the coupon details from POST parameters
    $code = isset($_POST["code"]) ? $_POST["code"] : "";
    $percentage = isset($_POST["percentage"]) ? $_POST["percentage"] : "";

    // Display the coupon details
    if (!empty($code) && !empty($percentage)) {
        echo "<p>Coupon Code: " . $code . "</p>";
        echo "<p>Discount Percentage: " . $percentage . "%</p>";
    } else {
        echo "<p>No coupon details found.</p>";
    }
    ?>
</body>
</html>
