<?php
session_start();

$pushedCoupon = isset($_SESSION["pushedCoupon"]) ? json_decode($_SESSION["pushedCoupon"], true) : null;

// Clear the pushed coupon from the session
unset($_SESSION["pushedCoupon"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Offers</title>
</head>
<body>
    <h1>Offers</h1>

    <?php if ($pushedCoupon): ?>
        <h2>APPLY BELOW CODE AND GET DISCOUNT</h2>
        <p>Code: <?php echo $pushedCoupon["code"]; ?></p>
        <p>Percentage: <?php echo $pushedCoupon["percentage"]; ?></p>
    <?php endif; ?>
    
    <!-- Rest of the page content -->
</body>
</html>