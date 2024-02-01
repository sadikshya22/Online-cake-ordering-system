<?php 





// Connect to the database
$host = 'localhost'; // Update with your database host
$dbName = 'onlinecakeshop'; // Update with your database name
$username = 'root'; // Update with your database username
$password = ''; // Update with your database password

try {
    $db = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Create the "pushed_coupons" table if it doesn't exist
$query = "CREATE TABLE IF NOT EXISTS pushed_coupons (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            code VARCHAR(50) NOT NULL,
            percentage INT(3) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
$db->exec($query);

// Start the session
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code = $_POST["code"];
    $percentage = $_POST["percentage"];
    $active = isset($_POST["active"]) ? 1 : 0;

    // Insert the coupon into the database
    $query = "INSERT INTO coupons (code, percentage, active) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$code, $percentage, $active]);
}

// Push a coupon
if (isset($_POST["push"])) {
    $code = $_POST["code"];
    $percentage = $_POST["percentage"];

    // Insert the pushed coupon into the "pushed_coupons" table
    $query = "INSERT INTO pushed_coupons (code, percentage) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$code, $percentage]);

    // Store the pushed coupon information in the session
    $_SESSION["pushedCoupon"] = json_encode([
        "code" => $code,
        "percentage" => $percentage
    ]);
}

// Expire a coupon
if (isset($_GET["expire"])) {
    $couponId = $_GET["expire"];
    $query = "DELETE FROM coupons WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$couponId]);
}

// Delete a pushed coupon
if (isset($_GET["delete"])) {
    $couponId = $_GET["delete"];
    $query = "DELETE FROM pushed_coupons WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$couponId]);
}

// Fetch all coupons
$query = "SELECT * FROM coupons";
$stmt = $db->query($query);
$coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
// session_start();
if (isset($_SESSION['user_admin_id']) && $_SESSION['user_admin_id'] != null) {
    $admin_username = $_SESSION['user_admin_username'];
?>


<!DOCTYPE html>
<html>
<head>
    <title>Coupon Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f5f8;
            margin-top: 0px;
            
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            padding: 5px;
            width: 200px;
            border: 1px solid #ccc;
        }

        input[type="checkbox"] {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            text-align: center;
        }

        th, td {
            padding: 10px;
            text-align: center;
            color: #333;
        }

        th {
            color: #000000;
            margin-right: 10px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a, button {
            padding: 5px 10px;
            background-color: #0099cc;
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        button {
            background-color: #f44336;
        }

        a:hover, button:hover {
            background-color: #005580;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            float: right;


        }
           /* Adjust the width and position of the sidebar */
        .nav-left-sidebar.sidebar-dark {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            overflow-y: auto;
            z-index: 1;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .menu-list {
            padding: 20px;

        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome-all.css">
    <!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="../js/bootstrap.min.js"></script>
    <!-- <h1>Generate Coupon Code</h1> -->
</head>
<body>
    <!-- main wrapper -->
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
        <!-- end navbar -->

       <!-- ...existing HTML code... -->

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
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="dashboard.php"><i class="fa fa-fw fa-rocket"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_users.php"><i class="fa fa-fw fa-user-circle"></i>Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_category.php" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Category</a>
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
                        <a class="nav-link" href="add_product.php"><i class="fab fa-product-hunt"></i>Products</a>
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
                    <li class="nav-item ">
                        <a class="nav-link active" href="admin_add_coupon.php"><i class="fa fa-fw fa-rocket"></i>Generate Coupon</a>
                    </li>
                     <li class="nav-item">
                                <a class="nav-link" href="delivery.php"><i class="fas fa-fw fa-truck"></i>Manage Delivery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sales.php"><i class="fas fa-fw fa-chart-bar"></i>View Sales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="reports.php"><i class="fas fa-fw fa-exclamation-triangle"></i>Report/Refund</a>
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
                            <h2 class="pageheader-title">Coupon Code</h2>
                            <p class="pageheader-text"></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Generate Code</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- end pageheader -->



      

        <!-- wrapper  -->
        <div class="container">
            <!-- Coupon form -->
            <form method="post" action="">
                <label for="code">Coupon Code:</label>
                <input type="text" name="code" required><br>

                <label for="percentage">Discount Percentage:</label>
                <input type="number" name="percentage" min="10" max="60" required><br>

                <label for="active">Active:</label>
                <input type="checkbox" name="active"><br>

                <input type="submit" value="Generate Coupon">
            </form>

            <hr>

            <!-- Coupon history table -->
            <h2>Coupon Code History</h2>
            <table>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Code</th>
                    <th>Percentage</th>
                    <th>Active</th>
                    <th>Expired</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($coupons as $coupon): ?>
                    <tr>
                        <!-- <td><?php echo $coupon["id"]; ?></td> -->
                        <td><?php echo $coupon["code"]; ?></td>
                        <td><?php echo $coupon["percentage"]; ?></td>
                        <td><?php echo $coupon["active"] ? "Yes" : "No"; ?></td>
                        <td><?php echo $coupon["expired"] ? "Yes" : "No"; ?></td>
                        <td>
                            <?php if (!$coupon["expired"]): ?>
                                <a href="?expire=<?php echo $coupon["id"]; ?>">Expire</a>
                                <button onclick="pushCoupon('<?php echo $coupon["code"]; ?>', <?php echo $coupon["percentage"]; ?>)">Push</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <hr>

            <!-- Pushed coupon table -->
            <h2>Pushed Coupon Codes</h2>
            <table>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Code</th>
                    <th>Percentage</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                <?php
                $query = "SELECT * FROM pushed_coupons";
                $stmt = $db->query($query);
                $pushedCoupons = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($pushedCoupons as $pushedCoupon):
                ?>
                <tr>
                    <!-- <td><?php echo $pushedCoupon["id"]; ?></td> -->
                    <td><?php echo $pushedCoupon["code"]; ?></td>
                    <td><?php echo $pushedCoupon["percentage"]; ?></td>
                    <td><?php echo $pushedCoupon["created_at"]; ?></td>
                    <td>
                        <button onclick="deleteCoupon(<?php echo $pushedCoupon["id"]; ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <script>
            function pushCoupon(code, percentage) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Response from push_coupon.php
                        console.log(xhr.responseText);
                        alert('Coupon pushed successfully!');
                        location.reload(); // Refresh the page to display the pushed coupon in cart.php
                    }
                };
                xhr.send("push=1&code=" + code + "&percentage=" + percentage);
            }

            function deleteCoupon(id) {
                var confirmDelete = confirm("Are you sure you want to delete this coupon?");
                if (confirmDelete) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "?delete=" + id, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Response from delete_coupon.php
                            console.log(xhr.responseText);
                            alert('Coupon deleted successfully!');
                            location.reload(); // Refresh the page to update the coupon list
                        }
                    };
                    xhr.send();
                }
            }
        </script>
    </div>
    <!-- end wrapper -->

    <!-- Optional JavaScript -->
         <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
else {
    header("Location: index.php");
}
?>