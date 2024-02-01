
<?php
session_start();


// Redirect to the login page if the 'user_users_username' session variable is not set
if (!isset($_SESSION['user_users_username'])) {
    header("Location: login_users.php");
    exit();
}

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
<!doctype html>
<html lang="en">
 
<head>

       <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            padding: 20px 0;
            color: #007BFF;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        form {
            display: none;
            background-color: #fff;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            color: #007BFF;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .cancel-report-btn {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 20px 0;
            cursor: pointer;
            border-radius: 4px;
        }

        .cancel-report-btn:hover {
            background-color: #0056b3;
        }

        /* Colors for Delivery Status */
        .status-processing {
            color: red;
        }

        .status-dispatch {
            color: deeppink;
        }

        .status-delivered {
            color: green;
        }
    </style>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>About Us</title>
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
    
    <!-- main wrapper -->
    
    <div class="dashboard-main-wrapper">
         
        <!-- navbar -->
        
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
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
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
                                <a class="dropdown-item" href="account_users.php"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="login_users.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                                <a class="dropdown-item" href="logout_users.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        
        <!-- end navbar -->
       
    <h1>Order Overview</h1>
    <h2><?php 
        // session_start();
         echo "Hello " . $_SESSION['user_users_username'];
    ?></h2>
    <div style="text-align: center;">
        <?php
        // Check if the user is not logged in
         

        // Replace these variables with your actual database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "onlinecakeshop";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $username = $_SESSION['user_users_username'];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["product_id"]) && isset($_POST["reason_of_cancel"])) {
        // Sanitize the values to prevent SQL injection (optional but recommended)
        $product_id = $conn->real_escape_string($_POST["product_id"]);
        $reason_of_cancel = $conn->real_escape_string($_POST["reason_of_cancel"]);
        $cancel_message = $conn->real_escape_string($_POST["cancel_message"]);
        $submitted_date = date('Y-m-d H:i:s');
        
        // Get the payment ID from the submitted form data
        $payment_id = $conn->real_escape_string($_POST["payment_id"]);

        // Insert the data into the 'report_order' table, including the payment ID
        $insertSql = "INSERT INTO report_order (username, product_id, reason_of_cancel, cancel_message, payment_id, submitted_date)
                    VALUES ('$username','$product_id', '$reason_of_cancel', '$cancel_message', '$payment_id', '$submitted_date')";
        if ($conn->query($insertSql) === TRUE) {
            // Display the thank you message after successful form submission
            echo "<h3>Thank you for your cancellation/report.</h3>";
            echo "<p>Refunds may take time due to review.</p>";
            echo "<p>Your feedback helps us improve.</p>";
            echo "<p>Sorry for any inconvenience.</p>";
            echo "<p>Live Bakery Nepaltar Customer Care (+977 9811077394, +025-560422, customersupport@nepaltar.com)</p>";
        } else {
            echo "Error inserting form details: " . $conn->error;
        }
    }
}


        $current_username = $_SESSION["user_users_username"];

        // SQL query to fetch data from the delivery_info table for the currently logged-in user
        $sql = "SELECT * FROM delivery_info WHERE username='$current_username' ORDER BY id DESC";

        // Execute the query
        $result = $conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Start generating the HTML table
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            // echo "<th>ID</th>";
            // echo "<th>Username</th>";
            echo "<th>Product Name</th>";
            echo "<th>Quantity</th>";
            echo "<th>Weight</th>";
            echo "<th>Paid Price</th>";
            echo "<th>Delivery Message</th>";
            echo "<th>Delivery Date</th>";
            echo "<th>Delivery Address</th>";
            echo "<th>Phone Number</th>";
            echo "<th>Payment Amount</th>";
            echo "<th>Purchased Date</th>";
            echo "<th>Delivery Status</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Loop through the data and display it inside table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                // echo "<td>" . $row["id"] . "</td>";
                // echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>" . $row["weight"] . "</td>";
                echo "<td>" . $row["paid_price"] . "</td>";
                echo "<td>" . $row["delivery_message"] . "</td>";
                echo "<td>" . $row["delivery_date"] . "</td>";
                echo "<td>" . $row["delivery_address"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td>" . $row["payment_amount"] . "</td>";
                echo "<td>" . $row["purchased_date"] . "</td>";
                echo "<td class='status-" . strtolower($row["delivery_status"]) . "'>";

                // Convert the numeric status to corresponding string value
                switch ($row["delivery_status"]) {
                    case 0:
                        echo "<span class='status-processing'>Processing</span>";
                        break;
                    case 1:
                        echo "<span class='status-dispatch'>Dispatch</span>";
                        break;
                    case 2:
                        echo "<span class='status-delivered'>Delivered</span>";
                        break;
                    case 3:
                        echo "<span class='status-cancel'>Cancel</span>";
                        break;
                    default:
                        echo "Unknown";
                }
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            // Display the cancel/report button
        echo '<button class="cancel-report-btn" onclick="showForm()">Cancel/Report</button>';

        // Display the cancel/report form
        echo "<form id='cancel-report-form' method='post' enctype='multipart/form-data'>";
        echo "<h2>Cancel/Report Form</h2>";
        echo "<label for='product_id'>Product:</label>";
        echo "<select name='product_id' id='product_id'>";

        // Loop through the data again to populate the product options in the dropdown
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["id"] . "'>" . $row["product_name"] . "</option>";
        }

        echo "</select><br><br>";
        echo "<label for='reason_of_cancel'>Reason of Cancel:</label>";
        echo "<input type='text' name='reason_of_cancel' id='reason_of_cancel' required><br><br>"; // Text input field for custom reason
        echo "<label for='cancel_message'>Message:</label>";
        echo "<textarea name='cancel_message' id='cancel_message' rows='5' required></textarea><br><br>";
echo"<input type='text' name='payment_id' id='payment_id' required><br><br>";
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
        } else {
            
            // If no rows found, display a message
            echo "<p>We have received your order and will update you shortly.</p>";
            echo "<p>Thank you for shopping with us!</p>";
        }

        // Close the connection
        $conn->close();
        ?>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/main-js.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>

        <script>
            function showForm() {
                var form = document.getElementById("cancel-report-form");
                form.style.display = "block";
            }
        </script>
    </div>
</body>
</html>
