<?php
session_start();
if (isset($_SESSION['user_admin_id']) && $_SESSION['user_admin_id'] != null) {
    $admin_username = $_SESSION['user_admin_username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delivery</title>
    <style>
        /* Your existing CSS styles go here */
    </style>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome-all.css">
</head>
<body>
<!-- Your existing HTML code goes here -->
 <div class="dashboard-main-wrapper">
        
        <!-- navbar -->
        
       <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="#">Live Bakery Nepaltar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars mx-3
"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../uploads/default-image.png" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $admin_username;?></h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
         
        <!-- left sidebar -->
        
      <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                           <!--  <li class="nav-divider">
                                Menu
                            </li> -->
                            <li class="nav-item ">
                                <a class="nav-link" href="dashboard.php"><i class="fa fa-fw fa-rocket"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view_users.php"><i class="fa fa-fw fa-user-circle"></i>Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Category</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="view_category.php">View category</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="add_category.php">Add category</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-product-hunt
"></i>Products</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="view_product.php">View products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="add_product.php">Add products</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_add_coupon.php"><i class="fa fa-fw fa-user-circle"></i>Generate Coupon</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link active" href="delivery.php"><i class="fas fa-fw fa-truck"></i>Manage Delivery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="sales.php"><i class="fas fa-fw fa-chart-bar"></i>View Sales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="reports.php"><i class="fas fa-fw fa-exclamation-triangle"></i>Report/Refund</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        
        <!-- end left sidebar -->
        
        
        <!-- wrapper  -->
        
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                
                <!-- pageheader -->
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Manage Delivery </h2>
                            <p class="pageheader-text">.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Manage Delivery</a></li>
                                       
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
         
    
<div style="text-align: center;">
<?php
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

// Create the 'delivery_info' table if it doesn't exist
$createTableSql = "CREATE TABLE IF NOT EXISTS delivery_info (
                    id INT(11) UNSIGNED PRIMARY KEY,
                    username VARCHAR(255) NOT NULL,
                    product_name VARCHAR(255) NOT NULL,
                    quantity INT(11) NOT NULL,
                    weight DECIMAL(10,2) NOT NULL,
                    paid_price DECIMAL(10,2) NOT NULL,
                    delivery_message VARCHAR(255) NOT NULL,
                    delivery_date DATE NOT NULL,
                    delivery_address VARCHAR(255) NOT NULL,
                    phone_number VARCHAR(20) NOT NULL,
                    payment_amount DECIMAL(10,2) NOT NULL,
                    purchased_date DATE NOT NULL,
                    delivery_status TINYINT(1) NOT NULL
                )";
$conn->query($createTableSql);

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Loop through the POST data to update the 'delivery_status' and store data in 'delivery_info' table
    foreach ($_POST["delivery_status"] as $orderId => $status) {
        // Sanitize the values to prevent SQL injection (optional but recommended)
        $orderId = $conn->real_escape_string($orderId);
        $status = $conn->real_escape_string($status);

        // Convert the status value to the appropriate integer value
        switch ($status) {
            case "preparing":
                $statusValue = 0;
                break;
            case "dispatch":
                $statusValue = 1;
                break;
            case "delivered":
                $statusValue = 2;
                break;
            case "cancel":
                $statusValue = 3;
                break;
            default:
                $statusValue = 0;
        }

        // Get the corresponding information for the order ID from the 'bakery_order' table
        $infoQuery = "SELECT username, product_name, quantity, weight, paid_price, 
                      delivery_message, delivery_date, delivery_address, phone_number, 
                      payment_amount, purchased_date FROM bakery_order WHERE id = '$orderId'";
        $infoResult = $conn->query($infoQuery);
        if ($infoResult->num_rows > 0) {
            $infoRow = $infoResult->fetch_assoc();
            $username = $conn->real_escape_string($infoRow["username"]);
            $product_name = $conn->real_escape_string($infoRow["product_name"]);
            $quantity = $infoRow["quantity"];
            $weight = $infoRow["weight"];
            $paid_price = $infoRow["paid_price"];
            $delivery_message = $conn->real_escape_string($infoRow["delivery_message"]);
            $delivery_date = $infoRow["delivery_date"];
            $delivery_address = $conn->real_escape_string($infoRow["delivery_address"]);
            $phone_number = $conn->real_escape_string($infoRow["phone_number"]);
            $payment_amount = $infoRow["payment_amount"];
            $purchased_date = $infoRow["purchased_date"];

            // Insert or update the data in the 'delivery_info' table
            $insertUpdateSql = "INSERT INTO delivery_info (id, username, product_name, quantity, weight, 
                                paid_price, delivery_message, delivery_date, delivery_address, phone_number, 
                                payment_amount, purchased_date, delivery_status)
                                VALUES ('$orderId', '$username', '$product_name', '$quantity', '$weight',
                                '$paid_price', '$delivery_message', '$delivery_date', '$delivery_address',
                                '$phone_number', '$payment_amount', '$purchased_date', '$statusValue')
                                ON DUPLICATE KEY UPDATE 
                                username = VALUES(username),
                                product_name = VALUES(product_name),
                                quantity = VALUES(quantity),
                                weight = VALUES(weight),
                                paid_price = VALUES(paid_price),
                                delivery_message = VALUES(delivery_message),
                                delivery_date = VALUES(delivery_date),
                                delivery_address = VALUES(delivery_address),
                                phone_number = VALUES(phone_number),
                                payment_amount = VALUES(payment_amount),
                                purchased_date = VALUES(purchased_date),
                                delivery_status = VALUES(delivery_status)";
            $conn->query($insertUpdateSql);
        }
  

    // Redirect to the same page after updating to prevent form resubmission on refresh
  }
}

// SQL query to fetch data from the bakery_order table
$sql = "SELECT * FROM bakery_order WHERE 
        COALESCE(username, '') <> '' AND
        COALESCE(product_name, '') <> '' AND
        COALESCE(quantity, '') <> '' AND
        COALESCE(weight, '') <> '' AND
        COALESCE(paid_price, '') <> '' AND
        COALESCE(delivery_message, '') <> '' AND
        COALESCE(delivery_date, '') <> '' AND
        COALESCE(delivery_address, '') <> '' AND
        COALESCE(phone_number, '') <> '' AND
        COALESCE(payment_amount, '') <> '' AND
        COALESCE(purchased_date, '') <> ''";

// Execute the query
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Display the table and table headings
    echo "<form method='post'>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Username</th>";
    echo "<th>Product Name</th>";
    echo "<th>Quantity</th>";
    echo "<th>Weight</th>";
    echo "<th>Paid Price</th>";
    echo "<th>Delivery Message</th>";
    echo "<th>Delivery Date</th>";
    echo "<th>Delivery Address</th>";
    echo "<th>Phone Number</th>";
    // echo "<th>Payment ID</th>";
    echo "<th>Payment Amount</th>";
    echo "<th>Payment Success Date</th>";
    echo "<th>Purchased Date</th>";
    echo "<th>Delivery Status</th>"; // Added new column
    echo "</tr>";

    // Loop through the data and display it inside table rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["weight"] . "</td>";
        echo "<td>" . $row["paid_price"] . "</td>";
        echo "<td>" . $row["delivery_message"] . "</td>";
        echo "<td>" . $row["delivery_date"] . "</td>";
        echo "<td>" . $row["delivery_address"] . "</td>";
        echo "<td>" . $row["phone_number"] . "</td>";
        // echo "<td>" . $row["payment_id"] . "</td>";
        echo "<td>" . $row["payment_amount"] . "</td>";
        echo "<td>" . $row["payment_success_date"] . "</td>";
        echo "<td>" . $row["purchased_date"] . "</td>";
        echo "<td>";

        // Fetch the delivery status from the 'delivery_info' table
        $orderId = $row["id"];
        $statusQuery = "SELECT delivery_status FROM delivery_info WHERE id = '$orderId'";
        $statusResult = $conn->query($statusQuery);
        if ($statusResult->num_rows > 0) {
            $statusRow = $statusResult->fetch_assoc();
            $deliveryStatus = $statusRow["delivery_status"];
        } else {
            $deliveryStatus = 0; // Default value if not found
        }

        echo "<select name='delivery_status[" . $row["id"] . "]'>";
echo "<option value='preparing' " . ($deliveryStatus == 0 ? "selected" : "") . " style='background-color: #f0ad4e; color: white;'>Processing</option>";
echo "<option value='dispatch' " . ($deliveryStatus == 1 ? "selected" : "") . " style='background-color: #5bc0de; color: white;'>Dispatch</option>";
echo "<option value='delivered' " . ($deliveryStatus == 2 ? "selected" : "") . " style='background-color: #5cb85c; color: white;'>Delivered</option>";
echo "<option value='cancel' " . ($deliveryStatus == 3 ? "selected" : "") . " style='background-color: #d9534f; color: white;'>Cancel</option>";
echo "</select>";

        echo "</select>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
   echo "<style>
        .custom-button {
            background-color: skyblue;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .custom-button:hover {
            background-color: #007acc; /* Darker blue on hover */
        }
      </style>";

echo "<input type='submit' value='Update Delivery Status' class='custom-button'>";


    echo "</form>";
} else {
    echo "No data found in the bakery_order table.";
}

// Close the connection
$conn->close();
?>
</div>

<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/jquery.slimscroll.js"></script>
<script src="../js/main-js.js"></script>
    </div>
    </div>
    </div>
</body>
</html>

<?php
}
else {
    header("Location: index.php");
}
?>
