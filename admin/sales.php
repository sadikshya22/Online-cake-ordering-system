
<?php
session_start();
if (isset($_SESSION['user_admin_id']) && $_SESSION['user_admin_id'] != null) {
    $admin_username = $_SESSION['user_admin_username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <!-- Include Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007BFF;
            margin-top: 0;
            margin-bottom: 15px;
        }

        canvas {
            display: block;
            margin: 20px auto;
        }
    </style>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome-all.css">
</head>
<body>
    <h1>Sales Report</h1>
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
                                <a class="nav-link" href="delivery.php"><i class="fas fa-fw fa-truck"></i>Manage Delivery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="sales.php"><i class="fas fa-fw fa-chart-bar"></i>View Sales</a>
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
                            <h2 class="pageheader-title">Sales Report</h2>
                            <p class="pageheader-text">.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sales</a></li>
                                       
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
    <div class="container">
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

        // SQL query to fetch the sum of payment_amount from the bakery_order table
        $sumQuery = "SELECT SUM(payment_amount) AS total_sales FROM bakery_order WHERE payment_amount IS NOT NULL";
        $sumResult = $conn->query($sumQuery);

        // Calculate the total sales amount
        $totalSalesAmount = 0;
        if ($sumResult && $sumResult->num_rows > 0) {
            $sumRow = $sumResult->fetch_assoc();
            $totalSalesAmount = $sumRow["total_sales"];
        }

        // SQL query to find the most popular product (the product with the highest quantity sold)
        $popularProductQuery = "SELECT product_name, SUM(quantity) AS total_quantity FROM bakery_order 
                                WHERE product_name IS NOT NULL GROUP BY product_name ORDER BY total_quantity DESC LIMIT 1";
        $popularProductResult = $conn->query($popularProductQuery);

        // Get the most popular product name and quantity
        $popularProduct = "";
        $popularQuantity = 0;
        if ($popularProductResult && $popularProductResult->num_rows > 0) {
            $popularProductRow = $popularProductResult->fetch_assoc();
            $popularProduct = $popularProductRow["product_name"];
            $popularQuantity = $popularProductRow["total_quantity"];
        }

        // SQL query to fetch product names and sales quantities for the line chart
        $lineChartQuery = "SELECT product_name, SUM(quantity) AS total_quantity FROM bakery_order 
                           WHERE product_name IS NOT NULL GROUP BY product_name";
        $lineChartResult = $conn->query($lineChartQuery);

        // Initialize arrays to store product names and sales quantities for the line chart
        $productNames = array();
        $salesData = array();
        if ($lineChartResult && $lineChartResult->num_rows > 0) {
            while ($row = $lineChartResult->fetch_assoc()) {
                $productNames[] = $row["product_name"];
                $salesData[] = $row["total_quantity"];
            }
        }

        // Close the connection
        $conn->close();
        ?>

        <h2>Total Sales Amount: NPR <?php echo number_format($totalSalesAmount, 2); ?></h2>
        <h2>Most Popular Product: <?php echo $popularProduct . " (" . $popularQuantity . " sold)"; ?></h2>

        <!-- Add a canvas element for the line chart -->
        <canvas id="salesChart" style="width:100%;max-width:600px"></canvas>

        <script>
            const xValues = <?php echo json_encode($productNames); ?>;
            const yValues = <?php echo json_encode($salesData); ?>;

            new Chart("salesChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        data: yValues,
                        borderColor: "red",
                        fill: false
                    }]
                },
                options: {
                    legend: { display: false }
                }
            });
        </script>
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
