<?php require 'config.php'; require 'session.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        $urlSegments = explode('/', $_SERVER['REQUEST_URI']);
        $slug = end($urlSegments);
        $sql = "SELECT * FROM products WHERE product_slug = '$slug'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content='<?php echo $row['product_details']; ?>'>
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo $row['product_name']; ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/plugins/owlcarousel/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="global-loader">
    <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

        <!--Header --->
        <?php include('header.php');?>
        <!--Header --->

        <!--Sidebar --->
        <?php include('sidebar.php');?>
        <!--Sidebar --->

        <div class="page-wrapper">
            <div class="content">
                <?php
                $urlSegments = explode('/', $_SERVER['REQUEST_URI']);
                $slug = end($urlSegments);
                $sql = "SELECT p.*,c.category_id,c.category_name,s.subcategory_id,s.subcategory_name,b.brand_id,b.brand_name
                FROM products p
                INNER JOIN categories c ON c.category_id = p.category_id
                INNER JOIN subcategories s ON s.subcategory_id = p.subcategory_id
                LEFT JOIN brands b ON p.brand_id = b.brand_id
                WHERE p.product_slug = '$slug'
                ";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                ?>
                    <div class="page-header">
                        <div class="page-title">
                            <h4>Product Details</h4>
                            <h6>Full details of a product</h6>
                        </div>
                        <a class="me-3" href="editproduct.php?id=<?php echo $row['product_id']; ?>">
                            <img src="assets/img/icons/edit.svg" alt="img">
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <div class="bar-code-view">
                                            <img src="assets/img/code-barre/<?php echo $row['barcode']; ?>" alt="barcode">
                                        </div>
                                        <div class="bar-code-view text-center">
                                            <img src="assets/img/qrcode/<?php echo $row['qrcode']; ?>" alt="qrcode">
                                        </div>
                                    </div>

                                    <div class="productdetails">
                                        <ul class="product-bar">
                                            <li class="details-list">
                                                <h4>Product</h4>
                                                <h6><?php echo $row['product_name']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Category</h4>
                                                <h6><?php echo $row['category_name']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Sub Category</h4>
                                                <h6><?php echo $row['subcategory_name']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Brand</h4>
                                                <h6><?php echo $row['brand_name']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Unit</h4>
                                                <h6>Piece</h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>SKU</h4>
                                                <h6><?php echo $row['sku']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Quantity</h4>
                                                <h6><?php echo $row['product_quantity']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Tax</h4>
                                                <h6>0.00 %</h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Discount Type</h4>
                                                <h6>Percentage</h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Price</h4>
                                                <h6><?php echo $row['product_price']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Status</h4>
                                                <h6><?php echo $row['product_status']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Description</h4>
                                                <h6><?php echo $row['product_details']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Created</h4>
                                                <h6><?php echo $row['created_at']; ?></h6>
                                            </li>
                                            <li class="details-list">
                                                <h4>Updated</h4>
                                                <h6><?php echo $row['updated_at']; ?></h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="slider-product-details">
                                        <div class="owl-carousel owl-theme product-slide">
                                            <div class="slider-product">
                                                <img src="assets/img/product/<?php echo $row['main_image']; ?>" alt="img">
                                                <h4><?php echo $row['main_image']; ?></h4>
                                                <h6>581kb</h6>
                                            </div>
                                            <div class="slider-product">
                                                <img src="assets/img/product/<?php echo $row['secondary_image_1']; ?>" alt="img">
                                                <h4><?php echo $row['secondary_image_1']; ?></h4>
                                                <h6>581kb</h6>
                                            </div>
                                            <div class="slider-product">
                                                <img src="assets/img/product/<?php echo $row['secondary_image_2']; ?>" alt="img">
                                                <h4><?php echo $row['secondary_image_2']; ?></h4>
                                                <h6>581kb</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }else {?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="error-box">
                            <h1>404</h1>
                            <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> Oops! Page not found!</h3>
                            <p class="h4 font-weight-normal">The page you requested was not found.</p>
                            <a href="./" class="btn btn-primary">Back to Home</a>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>