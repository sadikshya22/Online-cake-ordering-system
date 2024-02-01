<?php
session_start();

// Check if the cart session variable exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Remove the product from the cart
if (isset($_GET['remove'])) {
    $productId = $_GET['remove'];

    // Iterate over the cart items and remove the matching product
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['product_id'] == $productId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

// Add the product to the cart
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Check if the product already exists in the cart
    $productExists = false;
    foreach ($_SESSION['cart'] as $cartItem) {
        if ($cartItem['product_id'] == $productId) {
            $productExists = true;
            break;
        }
    }

    if (!$productExists) {
        $productName = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $weight = $_POST['weight'];
        $price = $_POST['price'];
        
        // Calculate the total price based on quantity, weight, and price
        $totalPrice = $price * $quantity * $weight;

        // Prepare the cart item
        $cartItem = [
            'product_id' => $productId,
            'product_name' => $productName,
            'quantity' => $quantity,
            'weight' => $weight,
            'price' => $totalPrice,
            
        ];

        // Add the cart item to the cart session variable
        $_SESSION['cart'][] = $cartItem;
    }
}

// Calculate the total amount
$totalAmount = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cartItem) {
        $totalAmount += $cartItem['price'];
    }
}

// Set the totalAmount in the session
$_SESSION['totalAmount'] = $totalAmount;

// Check if a coupon code is provided
if (isset($_POST['coupon_code'])) {
    $couponCode = $_POST['coupon_code'];

    // Retrieve the coupon code and percentage from the database
    $host = "localhost";
    $config_username = "root";
    $password = "";
    $db = "onlinecakeshop";

    $conn = mysqli_connect($host, $config_username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $couponCode = mysqli_real_escape_string($conn, $couponCode);
    $select = "SELECT percentage FROM pushed_coupons WHERE code = '$couponCode'";
    $query = mysqli_query($conn, $select);

    if (!$query) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($query);

    if ($row) {
        $percentage = $row['percentage']; // Get the discount percentage

        // Calculate the discounted amount and final amount
        $discountedAmount = $totalAmount * ($percentage / 100);
        $finalAmount = $totalAmount - $discountedAmount;

        // Set the finalAmount in the session
        $_SESSION['finalAmount'] = $finalAmount;
    } else {
        // Invalid coupon code
        $errorMessage = "Invalid coupon code. Please try again.";
    }

    $conn->close();
}

// Calculate the payment amount
$paymentAmount = $totalAmount;
if (isset($_SESSION['finalAmount']) && $_SESSION['finalAmount'] > 0) {
    $paymentAmount = $_SESSION['finalAmount'];
} else {
    unset($_SESSION['finalAmount']); // Clear the finalAmount if not set
}

if (!empty($_SESSION['user_users_id']) && !empty($_SESSION['user_users_username'])) {
    $printUsername = $_SESSION['user_users_username'];
} else {
    $printUsername = "None"; 
}

if (!empty($_SESSION['cart'])) {
    $printCount = count($_SESSION['cart']);
} else {
    $printCount = 0;
}

// Check if user is logged in before proceeding to checkout
if ($printUsername == "None") {
    echo "<script>alert('Please login to proceed!')</script>";
    echo "<script>window.location.assign('login_users.php')</script>";
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .cart-title {
            margin-bottom: 20px;
        }

        .cart-table {
            width: 100%;
            margin-top: 70px;
        }

        .cart-table th,
        .cart-table td {
            padding: 10px;
        }

        .cart-table .product-name {
            width: 40%;
        }

        .cart-table .product-quantity {
            width: 20%;
        }

        .cart-table .product-weight {
            width: 20%;
        }

        .cart-table .product-price {
            width: 20%;
        }

        
        .cart-table .product-action {
            width: 20%;
        }

        .coupon-form {
            margin-top: 20px;
        }

        .coupon-form .form-group {
            display: flex;
        }

        .coupon-form .form-group input {
            flex: 1;
            margin-right: 10px;
        }

        .coupon-form .form-group button {
            flex-shrink: 0;
        }
        .cart-total {
            margin-top: 20px;
            font-weight: bold;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        #news-bar {
            overflow: hidden;
            white-space: nowrap;
            animation: marquee 20s linear infinite;
            margin-top: 100px;
        }

        #news-bar strong {
            font-weight: bold;
            font-size: 1.2em; /* Adjust the font size as needed */
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }
      </style>";

    </style>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>OCS - Product Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
</head>

<body>
    <div class="container">
        

         <?php 
         if (!empty($_SESSION['cart'])) {
    $printCount = count($_SESSION['cart']);
}
else {
    $printCount = 0;
}
if (!empty($_SESSION['user_users_id']) && !empty($_SESSION['user_users_username'])) {
    $printUsername = $_SESSION['user_users_username'];
}
else {
    $printUsername = "None"; 
}

         ?>
         <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.php">Live Bakery Nepaltar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars mx-3
"></i></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
                            <?php
                            require_once('config.php');
                            $select = "SELECT * FROM cake_shop_category";
                            $query = mysqli_query($conn, $select);
                            while ($res = mysqli_fetch_assoc($query)) {
                            ?>
                                <a class="dropdown-item" href="shop.php?category=<?php echo $res['category_id'];?>">
                                    <?php echo $res['category_name'];?>
                                </a>
                            <?php
                            }
                            ?>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span class="badge badge-pill badge-secondary"><?php echo $printCount;?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="uploads/default-image.png" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $printUsername;?></h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                
                                 <a class="dropdown-item" href="fetch_delivery_info.php"><i class="fas fa-sign-in-alt mr-2"></i>History</a>
                                <a class="dropdown-item" href="login_users.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                                <a class="dropdown-item" href="logout_users.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div id="news-bar">
            <?php
            // Database connection details
            $host = "localhost";
            $config_username = "root";
            $password = "";
            $db = "onlinecakeshop";

            // Connect to the database
            $conn = mysqli_connect($host, $config_username, $password, $db);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch coupon codes and percentages from the database
            $query = "SELECT code, percentage FROM pushed_coupons";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Use code <strong>" . $row['code'] . "</strong> and get flat <strong>" . $row['percentage'] . "%</strong> discount! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

                }
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>

        <h1 class="cart-title"></h1>

        <?php if (!empty($_SESSION['cart'])) : ?>
            <table class="cart-table" border="1px">
                <thead>
                    <tr>
                        <th class="product-name">Product</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-weight">Weight (kg)</th>
                        <th class="product-price">Price</th>
                       
                        <th class="product-action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $key => $cartItem) : ?>
                        <tr>
                            <td class="product-name"><?php echo $cartItem['product_name']; ?></td>
                            <td class="product-quantity"><?php echo $cartItem['quantity']; ?></td>
                            <td class="product-weight"><?php echo $cartItem['weight']; ?></td>
                            <td class="product-price"><?php echo $cartItem['price']; ?></td>
                           
                            <td class="product-action"><a href="cart.php?remove=<?php echo $cartItem['product_id']; ?>" class="btn btn-danger btn-sm">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

           
  
    <div class="cart-total">
        <p>Total Price: <?php echo $totalAmount; ?></p>
    </div>

    <!-- Coupon Code Form -->
    <form action="" method="post" class="coupon-form">
        <div class="form-group">
            <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Enter coupon code">
            <button type="submit" class="btn btn-primary">Apply Coupon</button>
        </div>
        <?php if (isset($errorMessage)) : ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
    </form>
   


    <!-- Delivery Details Form -->
    <form action="submit.php" method="post" class="delivery-form">
       
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" name="delivery_message" id="message" rows="3"></textarea>
        </div>
        <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" class="form-control" name="phone_number" id="phone_number" required maxlength="10" onkeypress="return validateNumber(event)">
    </div>
    <div class="form-group">
        <label for="delivery_date">Delivery Date:</label>
        <input type="date" class="form-control" name="delivery_date" id="delivery_date" required min="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
    </div>
    <div class="form-group">
        <label for="delivery_address">Delivery Address:</label>
        <textarea class="form-control" name="delivery_address" id="delivery_address" rows="3" required></textarea>
    </div>

        <!-- Hidden input fields for product details -->
    <?php
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        echo '<input type="hidden" name="product_id[]" value="' . $cartItem['product_id'] . '">';
        echo '<input type="hidden" name="product_name[]" value="' . $cartItem['product_name'] . '">';
        echo '<input type="hidden" name="quantity[]" value="' . $cartItem['quantity'] . '">';
        echo '<input type="hidden" name="weight[]" value="' . $cartItem['weight'] . '">';
        echo '<input type="hidden" name="price[]" value="' . $cartItem['price'] . '">';
    }
    ?>
      <?php if (isset($percentage) && $percentage > 0) : ?>
                <div class="cart-total">
                    <p>Coupon Discount: <?php echo $discountedAmount; ?></p>
                    <p>Final Amount: <?php echo $finalAmount; ?></p>
                </div>
            <?php endif; ?>

    <!-- Payment Code -->
    <?php require('config1.php'); ?>

  

    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $publishableKey ?>"
        data-amount="<?php echo $paymentAmount ?>"
        data-name="Live Bakery Nepaltar"
        data-description="Live Bakery Nepaltar desc"
        data-image="https://c8.alamy.com/comp/TADP3M/creative-slice-of-cake-logo-vector-design-icon-symbol-illustration-TADP3M.jpg"
        data-currency="USD"
        data-email="info@livebakerynepaltar.com"
    ></script>
</form>

<?php else : ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

    </div>

    <!-- Optional JavaScript -->
    <script src="js/bootstrap.bundle.js"></script>
    <script type="text/javascript">
        function validateNumber(event) {
        // Allow only numeric characters and restrict to 10 digits
        const charCode = (event.which) ? event.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) || event.target.value.length >= 10) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    function validateForm() {
        const deliveryDate = new Date(document.getElementById('delivery_date').value);
        const currentDate = new Date();
        const sevenDaysFromNow = new Date(currentDate);
        sevenDaysFromNow.setDate(currentDate.getDate() + 7);

        if (deliveryDate.getTime() < sevenDaysFromNow.getTime()) {
            alert('Please select a delivery date that is at least 7 days from now.');
            return false;
        }

        return true;
    }
    </script>
      <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/main-js.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
</body>

</html>




