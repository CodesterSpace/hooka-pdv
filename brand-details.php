<?php require 'config.php'; require 'session.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        $urlSegments = explode('/', $_SERVER['REQUEST_URI']);
        $slug = end($urlSegments);
        $sql = "SELECT * FROM brands WHERE brand_slug = '$slug'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="<?php echo $row['description']; ?>">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo $row['brand_name']; ?></title>

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
                    $sql = "SELECT * FROM brands WHERE brand_slug = '$slug'
                    ";
                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                ?>
                <div class="page-header">
                    <div class="page-title">
                        <h4>Brand Details</h4>
                        <h6>Full details of a Brand</h6>
                    </div>
                    <a class="me-3" href="editbrand.php?id=<?php echo $row['brand_id']; ?>" >
                       <img src="assets/img/icons/edit.svg" alt="img">
                    </a>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="bar-code-view text-center">
                                    <img src="assets/img/barcode1.png" alt="barcode">
                                </div>
                                <div class="productdetails">
                                    <ul class="product-bar">
                                        <li>
                                            <h4>Brand</h4>
                                            <h6><?php echo $row['brand_name']; ?></h6>
                                        </li>
                                        <li>
                                            <h4>Brand Code</h4>
                                            <h6><?php echo $row['brand_code']; ?></h6>
                                        </li>
                                        <li>
                                            <h4>Description</h4>
                                            <h6><?php echo $row['description']; ?></h6>
                                        </li>

                                        <li>
                                            <h4>Created By</h4>
                                            <h6>Admin</h6>
                                        </li>

                                        <li>
                                            <h4>Created At</h4>
                                            <h6><?php echo $row['brand_created_at']; ?></h6>
                                        </li>
                                        <li>
                                            <h4>Updated At</h4>
                                            <h6><?php echo $row['brand_updated_at']; ?></h6>
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
                                            <img src="assets/img/brand/<?php echo $row['brand_img']; ?>" alt="img">
                                            <h4><?php echo $row['brand_img']; ?></h4>
                                            <h6>581kb</h6>
                                        </div>
                                        <div class="slider-product">
                                            <img src="assets/img/brand/<?php echo $row['brand_img']; ?>" alt="img">
                                            <h4><?php echo $row['brand_img']; ?></h4>
                                            <h6>581kb</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                else {?>
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