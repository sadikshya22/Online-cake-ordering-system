<?php
session_start();
if (isset($_SESSION['user_admin_id']) && $_SESSION['user_admin_id'] != null) {
    $admin_username = $_SESSION['user_admin_username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports - Online Cake Shop</title>
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
    </style>
     <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome-all.css">
</head>
<body>
    <h1>Reports - Online Cake Shop</h1>
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
                                <a class="nav-link " href="sales.php"><i class="fas fa-fw fa-chart-bar"></i>View Sales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="reports.php"><i class="fas fa-fw fa-exclamation-triangle"></i>Report/Refund</a>
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
                            <h2 class="pageheader-title">Report/Refund</h2>
                            <p class="pageheader-text">.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Report/Refund</a></li>
                                       
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

        // Function to sanitize the file name
        function sanitizeFileName($fileName) {
            return preg_replace("/[^a-zA-Z0-9-_.]/", "", $fileName);
        }

        // Check if the form has been submitted to update the status
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_status"])) {
            $report_id = $conn->real_escape_string($_POST["report_id"]);
            $status = $conn->real_escape_string($_POST["status"]);

            // Convert status to 0 for "Solved" and 1 for "Unsolved"
            if ($status === "Solved") {
                $status_value = 0;
            } else {
                $status_value = 1;
            }

            // Update the status in the 'report_order' table
            $updateSql = "UPDATE report_order SET status='$status_value' WHERE id='$report_id'";
            if ($conn->query($updateSql) === TRUE) {
                echo "<p>Status updated successfully!</p>";
            } else {
                echo "Error updating status: " . $conn->error;
            }
        }

        // SQL query to fetch all data from the report_order table
        $sql = "SELECT * FROM report_order";

        // Execute the query
        $result = $conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Start generating the HTML table
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Username</th>";
            echo "<th>Product ID</th>";
            echo "<th>Reason of Cancel</th>";
            echo "<th>Cancel Message</th>";
            echo "<th>Payment Proof</th>";
            echo "<th>Submitted Date</th>";
            echo "<th>Status</th>";
            echo "<th>Update Status</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Loop through the data and display it inside table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["product_id"] . "</td>";
                echo "<td>" . $row["reason_of_cancel"] . "</td>";
                echo "<td>" . $row["cancel_message"] . "</td>";
               // Inside the while loop where you display the payment proof image
               echo"<td>". $row["payment_id"]."</td>";
echo "</td>";

                echo "</td>";
                echo "<td>" . $row["submitted_date"] . "</td>";
                echo "<td>";
                // Display the status as "Solved" or "Unsolved" based on the value in the database
                if ($row["status"] === "0") {
                    echo "Solved";
                } else {
                    echo "Unsolved";
                }
                echo "</td>";
                echo "<td>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='report_id' value='" . $row["id"] . "'>";
                echo "<select name='status'>";
                echo "<option value='Solved' " . ($row["status"] === "0" ? "" : "selected") . ">Solved</option>";
                echo "<option value='Unsolved' " . ($row["status"] === "1" ? "selected" : "") . ">Unsolved</option>";
                echo "</select>";
                echo "<input type='submit' name='update_status' value='Update'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            // If no rows found, display a message
            echo "<p>No reports found in the database.</p>";
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
