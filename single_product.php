

<!doctype html>
<html lang="en">
<head>

<?php
session_start();

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



?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product Details</title>
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
    
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <!-- navbar code continues... -->

            <!-- Rest of the code remains the same -->
<?php
// session_start();
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>OCS - Product Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    
    <div class="dashboard-main-wrapper">
         
        <!-- navbar -->
        <!-- ============================================================== -->
         <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.php">Live Bakery Nepaltar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars mx-3
"></i></span>
                </button>    <link rel="stylesheet" href="css/userpage.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
</head>

<body>
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
        
        <!-- end navbar -->
       
        <!-- wrapper  -->
        
        <!-- <div class="dashboard-wrapper"> -->
            <div class="container-fluid dashboard-content">    
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                         <!--   <h2 class="pageheader-title">Product</h2> -->
                            <p class="pageheader-text"></p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <!--  <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Product details</li>  -->
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-5">

                    <?php
                    require_once('config.php');
                    $product_id = $_GET['product_id'];
                    $select = "SELECT * FROM cake_shop_product where product_id = $product_id";
                    $query = mysqli_query($conn, $select);
                    $res = mysqli_fetch_assoc($query);
                    ?>
                    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pr-xl-0 pr-lg-0 pr-md-0 m-b-30">
                                <div class="product-slider p-4">
                                    <div id="carouselExampleIndicators" class="product-carousel carousel slide" data-ride="carousel">
                                        <?php
                                        $file_array = explode(', ', $res['product_image']);
                                        ?>
                                        <div class="carousel-inner">
                                            <?php
                                            for ($i = 0; $i < count($file_array); $i++) {
                                            ?>
                                            <div class="carousel-item <?php if($i == 0) {echo 'active';} ?>">
                                                <img class="d-block w-100" src="uploads/<?php echo $file_array[$i];?>" alt="slide<?php echo $i;?>">
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-xl-0 pl-lg-0 pl-md-0 border-left m-b-30 d-flex">
                                <div class="product-details p-4">
                                    <div class="border-bottom pb-3 mb-3">
                                        <h2 class="mb-3"><?php echo $res['product_name'];?></h2>
                                        <h3 class="mb-0 text-primary">Rs. <?php echo $res['product_price'];?></h3>
                                    </div>
                                    <div class="product-description">
                                        <h4 class="mb-1">Descriptions</h4>
                                        <p><?php echo $res['product_description'];?></p>
<form method="POST" action="cart.php">
    <div class="quantity-section">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" max="10" value="1">
    </div>
    <div class="weight-section">
        <label for="weight">Weight (kg):</label>
        <select id="weight" name="weight">
            <option value="1" data-price="<?php echo $res['product_price']; ?>">1 kg</option>
            <option value="2" data-price="<?php echo $res['product_price'] * 2; ?>">2 kg</option>
            <option value="3" data-price="<?php echo $res['product_price'] * 3; ?>">3 kg</option>
            <option value="4" data-price="<?php echo $res['product_price'] * 4; ?>">4 kg</option>
            <option value="5" data-price="<?php echo $res['product_price'] * 5; ?>">5 kg</option>
        </select>
    </div>
    <input type="hidden" name="product_id" value="<?php echo $res['product_id']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $res['product_name']; ?>">
    <input type="hidden" name="price" value="<?php echo $res['product_price']; ?>">
    <input type="checkbox" id="terms" name="terms">
    <label for="terms">I agree to the <a href="terms.php">terms and conditions</a></label>
    <br><br>
    <button id="add-to-cart" disabled class="btn btn-primary btn-block btn-lg">Add to Cart</button>
</form>



                      <!--                 <input type="checkbox" id="terms" name="terms">
        <label for="terms">I agree to the <a href="terms.php">terms and conditions</a></label>
        <br><br>
                                        <button id="add-to-cart" disabled onclick="add_cart(<?php echo $res['product_id'];?>)" class="btn btn-primary btn-block btn-lg">Add to Cart</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row m-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                        <h1>Our Categories</h1>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="owl-carousel owl-theme">
                            <?php
                            require_once('config.php');
                            $select = "SELECT * FROM cake_shop_category";
                            $query = mysqli_query($conn, $select);
                            while ($res = mysqli_fetch_assoc($query)) {
                            ?>
                            <div class="item">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $res['category_name'];?></h3>
                                        <a href="shop.php?category=<?php echo $res['category_id'];?>"><img class="card-img" src="uploads/<?php echo $res['category_image'];?>"></a>
                                    </div>
                                    
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- footer -->
            
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © 2023 Live bakery Nepaltar. All rights reserved. 
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- end footer -->
           
        <!-- </div> -->
    </div>
    
    <!-- end main wrapper -->
   
    <!-- Optional JavaScript -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/main-js.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true, margin: 10, dots: 0, autoplay: 4000, autoplayHoverPause: true, responsive:{
                    0:{items:1}, 600:{items:2}, 1000:{items:4}
                }
            })
        });
    function add_cart(product_id) {
    var quantity = $('#quantity').val();
    var weight = $('#weight').val();
    var price = $('#weight option:selected').data('price');

    var data = {
        id: product_id,
        quantity: quantity,
        weight: weight,
        price: price
    };

    $.ajax({
        url: 'fetch_cart.php',
        data: data,
        method: 'get',
        dataType: 'json',
        success: function (cart) {
            console.log(cart);
            $('.badge').html(cart.length);
        }
    });
}


    </script>
     <script>
        $(document).ready(function () {
            $('#terms').change(function () {
                if (this.checked) {
                    $('#add-to-cart').removeAttr('disabled');
                } else {
                    $('#add-to-cart').attr('disabled', 'disabled');
                }
            });
        });
    </script>
</body>
 
</html>