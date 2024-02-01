<!DOCTYPE html>
<html>
<head>
    <title>Order Information</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #0000cc;
        }

        table {
            background-color: #ffffff;
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        .status-select {
            width: 120px;
        }
    </style>
</head>
<body>
    <h2>Order Information</h2>
    <table>
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Size</th>
                <th>Paid Price</th>
                <th>Order Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database and retrieve order information
            require('config1.php');
             // Establish database connection
    $conn = mysqli_connect("localhost","root", "", "onlinecakeshop");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
            $selectOrders = "SELECT * FROM saved_order";
            $result = mysqli_query($conn, $selectOrders);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            $sn = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $productName = $row['product_name'];
                $description = $row['description'];
                $quantity = $row['quantity'];
                $size = $row['size'];
                $paidPrice = $row['paid_price'];
                $orderDate = $row['order_date'];
                $status = $row['status'];
            ?>
            <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $productName; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $quantity; ?></td>
                <td><?php echo $size; ?></td>
                <td><?php echo $paidPrice; ?></td>
                <td><?php echo $orderDate; ?></td>
                <td>
                    <select class="status-select">
                        <option value="processing" <?php if ($status == 'processing') echo 'selected'; ?>>Processing</option>
                        <option value="dispatched" <?php if ($status == 'dispatched') echo 'selected'; ?>>Dispatched</option>
                        <option value="delivered" <?php if ($status == 'delivered') echo 'selected'; ?>>Delivered</option>
                        <option value="cancel" <?php if ($status == 'cancel') echo 'selected'; ?>>Cancel</option>
                    </select>
                </td>
            </tr>
            <?php
                $sn++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>
